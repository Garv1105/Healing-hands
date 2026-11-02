// Read-only crawl of the live hhphysio.com, saved as the reference copy of the ORIGINAL site.
// Plain HTTP GETs only (no browser), so no analytics/ads fire. Run: node scripts/crawl-original.mjs
//   original-site/urls.csv            one row per URL (status, redirect, title, meta, canonical, robots, H1s, words)
//   original-site/site-wide.md        header, menu, logo, footer (identical on every page)
//   original-site/pages/<path>.md     main content of each page as readable Markdown
//   original-site/images.csv          every image used: URL, alt text(s), pages using it
//   original-site/brand/              logo, favicons, app icons
//   original-site/assets/             every image the site uses, same folder layout as wp-content/
//   .local/original-html/<path>.html  raw HTML (git-ignored)
import { parse } from 'node-html-parser';
import { mkdirSync, writeFileSync } from 'node:fs';

const BASE = 'https://hhphysio.com';
const UA = 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0 Safari/537.36';
const OUT = 'original-site', RAW = '.local/original-html';
const EXTRA = ['/knee-pain-physiotherapy-bangalore/', '/back-neck-pain-physiotherapy-bangalore/', '/physiotherapist-near-me-bangalore/', '/post-surgery-physiotherapy-bangalore/', '/sports-injury-physiotherapy-bangalore/'];
const SKIP = /\/(wp-admin|wp-content|wp-includes|wp-json|feed|comments|xmlrpc)|\.(xml|php|jpe?g|png|webp|gif|pdf|svg|css|js)$|\/amp\/?$/i;

mkdirSync(`${OUT}/pages`, { recursive: true });
mkdirSync(RAW, { recursive: true });
const sleep = (ms) => new Promise((r) => setTimeout(r, ms));
const get = (url) => fetch(url, { headers: { 'User-Agent': UA }, redirect: 'manual' });
const norm = (href) => {
  try {
    const u = new URL(href, BASE);
    if (u.hostname.replace(/^www\./, '') !== 'hhphysio.com') return null;
    u.hash = ''; u.search = ''; u.protocol = 'https:'; u.hostname = 'hhphysio.com';
    if (SKIP.test(u.pathname)) return null;
    if (!u.pathname.endsWith('/')) u.pathname += '/';
    return u.href;
  } catch { return null; }
};
const slug = (url) => (new URL(url).pathname.replace(/^\/|\/$/g, '').replace(/\//g, '__') || 'home');
const clean = (s) => s.replace(/\s+/g, ' ').trim();
const abs = (u) => (u ? u.replace(/^\/\//, 'https://').replace(/^\//, `${BASE}/`) : '');

// DOM → readable Markdown (keeps headings, paragraphs, lists, images with alt, links, embeds).
const imageUse = new Map(); // url -> { alts:Set, pages:Set }
const useImage = (url, alt, page) => {
  if (!url || url.startsWith('data:')) return;
  const u = new URL(url, BASE);
  if (u.hostname.replace(/^www\./, '') !== 'hhphysio.com') return;
  const e = imageUse.get(u.href) || { alts: new Set(), pages: new Set() };
  if (alt) e.alts.add(alt);
  if (page) e.pages.add(page);
  imageUse.set(u.href, e);
};
let currentPage = '';

function md(node) {
  let out = '';
  const walk = (n) => {
    if (n.nodeType === 3) { out += n.text.replace(/\s+/g, ' '); return; }
    if (n.nodeType !== 1) return;
    const tag = n.rawTagName?.toLowerCase();
    if (['script', 'style', 'noscript', 'svg', 'form', 'button', 'select'].includes(tag)) return;
    if (/^h[1-6]$/.test(tag)) { out += `\n\n${'#'.repeat(+tag[1])} ${clean(n.text)}\n\n`; return; }
    if (tag === 'img') { const src = abs(n.getAttribute('data-src') || n.getAttribute('src')); if (src && !src.startsWith('data:')) { out += ` ![${n.getAttribute('alt') || ''}](${src}) `; useImage(src, n.getAttribute('alt'), currentPage); } return; }
    if (tag === 'iframe') { out += `\n\n[embed: ${abs(n.getAttribute('src') || n.getAttribute('data-src') || '')}]\n\n`; return; }
    if (tag === 'a') { const t = clean(n.text); const h = n.getAttribute('href'); if (n.querySelector('img')) { n.childNodes.forEach(walk); } else if (t) out += h ? ` [${t}](${abs(h)}) ` : t; return; }
    if (tag === 'br') { out += '\n'; return; }
    if (tag === 'li') { out += '\n- '; n.childNodes.forEach(walk); return; }
    const block = ['p', 'div', 'section', 'ul', 'ol', 'table', 'tr', 'blockquote', 'figure', 'article', 'header', 'footer', 'nav'].includes(tag);
    if (block) out += '\n\n';
    if (tag === 'blockquote') out += '> ';
    n.childNodes.forEach(walk);
    if (tag === 'td' || tag === 'th') out += ' | ';
    if (block) out += '\n\n';
  };
  walk(node);
  return out.split('\n').map((l) => l.replace(/[ \t]+/g, ' ').trim()).join('\n').replace(/\n{3,}/g, '\n\n').trim();
}

const meta = (doc, sel, attr = 'content') => doc.querySelector(sel)?.getAttribute(attr) || '';
const rows = [], seen = new Set(), queue = [];
const add = (u) => { if (u && !seen.has(u)) { seen.add(u); queue.push(u); } };

// Seeds: every sitemap URL + the unlisted ad landing pages.
add(`${BASE}/`);
const index = await (await get(`${BASE}/sitemap_index.xml`)).text();
for (const sm of index.match(/<loc>[^<]+/g).map((s) => s.slice(5))) {
  for (const loc of (await (await get(sm)).text()).match(/<loc>[^<]+/g) || []) add(norm(loc.slice(5)));
}
EXTRA.forEach((p) => add(norm(BASE + p)));
console.log(`${queue.length} seed URLs`);

let siteWide = false;
const brand = [];
const work = async () => {
  while (queue.length) {
    const url = queue.shift();
    const res = await get(url).catch((e) => ({ status: 'ERR ' + e.message, headers: new Headers() }));
    const row = { url, status: res.status, redirect: '', title: '', description: '', canonical: '', robots: '', h1: '', words: 0 };
    if (res.status >= 300 && res.status < 400) {
      row.redirect = new URL(res.headers.get('location'), url).href;
      add(norm(row.redirect));
    } else if (res.status === 200) {
      const html = await res.text();
      writeFileSync(`${RAW}/${slug(url)}.html`, html);
      const doc = parse(html);
      const main = doc.querySelector('main#main') || doc.querySelector('main') || doc.querySelector('body') || doc;
      row.title = clean(doc.querySelector('title')?.text || '');
      row.description = meta(doc, 'meta[name="description"]');
      row.canonical = meta(doc, 'link[rel="canonical"]', 'href');
      row.robots = meta(doc, 'meta[name="robots"]');
      const h1s = doc.querySelectorAll('h1').map((h) => clean(h.text));
      row.h1 = h1s.join(' || ');
      currentPage = url;
      const body = md(main);
      // Page-builder background images live in inline CSS, not <img> tags.
      const bgs = [...new Set([...html.matchAll(/url\(\s*['"]?((?:https?:)?\/\/(?:www\.)?hhphysio\.com\/wp-content\/[^'")\s]+|\/wp-content\/[^'")\s]+)/g)].map((m) => abs(m[1])))];
      bgs.forEach((b) => useImage(b, '', url));
      useImage(meta(doc, 'meta[property="og:image"]'), '', url);
      const jsonld = doc.querySelectorAll('script[type="application/ld+json"]').map((x) => { try { return JSON.stringify(JSON.parse(x.text), null, 2); } catch { return x.text.trim(); } });
      const forms = doc.querySelectorAll('form').filter((fm) => !fm.closest('header')).map((fm) => {
        const fields = fm.querySelectorAll('input, select, textarea').filter((i) => !['hidden', 'submit'].includes(i.getAttribute('type')))
          .map((i) => i.getAttribute('name') + (i.getAttribute('placeholder') ? ` ("${i.getAttribute('placeholder')}")` : ''));
        const btn = fm.querySelector('[type=submit]');
        return `- ${fm.getAttribute('class') || 'form'} → fields: ${fields.join(', ')}${btn ? ` → button "${btn.getAttribute('value') || clean(btn.text)}"` : ''}`;
      });
      row.words = body.replace(/!\[[^\]]*\]\([^)]*\)|\]\([^)]*\)/g, '').split(/\s+/).filter(Boolean).length;
      const pageHeader = doc.querySelector('.page-header');
      const crumbs = doc.querySelector('.breadcrumbs, .breadcrumb, #breadcrumbs');
      writeFileSync(`${OUT}/pages/${slug(url)}.md`, [
        `# ${row.title}`, '',
        `- URL: ${url}`, `- Meta description: ${row.description || '(none)'}`, `- Canonical: ${row.canonical}`, `- Robots: ${row.robots}`,
        `- H1: ${row.h1 || '(none)'}`, `- Published: ${meta(doc, 'meta[property="article:published_time"]') || '-'}`,
        `- Featured image: ${meta(doc, 'meta[property="og:image"]') || '-'}`, '',
        pageHeader ? `Page header: ${clean(pageHeader.text)}` : '', crumbs ? `Breadcrumbs: ${clean(crumbs.text)}` : '', '',
        '---', '', body, '',
        bgs.length ? `## Background images (from page CSS)\n\n${bgs.map((b) => '- ' + b).join('\n')}\n` : '',
        forms.length ? `## Forms\n\n${forms.join('\n')}\n` : '',
        jsonld.length ? `## Structured data (JSON-LD)\n\n${jsonld.map((j) => '```json\n' + j + '\n```').join('\n\n')}\n` : '',
      ].join('\n'));
      doc.querySelectorAll('main a[href], header a[href], footer a[href]').forEach((a) => add(norm(a.getAttribute('href'))));

      if (!siteWide) {
        siteWide = true;
        const logo = doc.querySelector('.header-logo img');
        currentPage = '(site-wide)';
        brand.push(
          ...doc.querySelectorAll('.header-logo img, footer img').flatMap((i) => [i.getAttribute('src'), ...(i.getAttribute('srcset') || '').split(',').map((x) => x.trim().split(' ')[0])]),
          ...doc.querySelectorAll('link[rel*="icon"]').map((l) => l.getAttribute('href')),
        );
        writeFileSync(`${OUT}/site-wide.md`, [
          '# Site-wide elements of the original hhphysio.com (header, menu, footer)', '',
          `Captured from ${url}.`, '',
          `## Logo`, '', `- Image: ${abs(logo?.getAttribute('src'))}`, `- Alt: "${logo?.getAttribute('alt') || ''}"`,
          `- Favicon: ${abs(meta(doc, 'link[rel="icon"]', 'href'))}`, '',
          '## Header', '', md(doc.querySelector('header') || parse('')), '',
          '## Footer', '', md(doc.querySelector('footer') || parse('')), '',
          '## Other site-wide markup (outside header/main/footer)', '',
          md(parse((doc.querySelector('body') || doc).childNodes.filter((n) => !['header', 'main', 'footer', 'script', 'style'].includes(n.rawTagName?.toLowerCase()) && !n.querySelector?.('main')).map((n) => n.toString()).join(''))), '',
        ].join('\n'));
      }
    }
    rows.push(row);
    if (rows.length % 25 === 0) console.log(`${rows.length} done, ${queue.length} queued`);
    await sleep(300); // be gentle with the live server
  }
};
await Promise.all([work(), work()]);

const csv = (v) => `"${String(v).replace(/"/g, '""')}"`;
rows.sort((a, b) => a.url.localeCompare(b.url));
writeFileSync(`${OUT}/urls.csv`, ['url,status,redirect,title,description,canonical,robots,h1,words', ...rows.map((r) => Object.values(r).map(csv).join(','))].join('\n') + '\n');

// Images: index, then download with the same folder layout as wp-content/.
writeFileSync(`${OUT}/images.csv`, ['url,alt,pages', ...[...imageUse].sort().map(([u, e]) => [u, [...e.alts].join(' | '), [...e.pages].join(' ')].map(csv).join(','))].join('\n') + '\n');
const save = async (url, file) => {
  const r = await fetch(url, { headers: { 'User-Agent': UA } }).catch(() => null);
  if (!r?.ok) return console.log('  image failed', r?.status, url);
  mkdirSync(file.replace(/\/[^/]*$/, ''), { recursive: true });
  writeFileSync(file, Buffer.from(await r.arrayBuffer()));
};
const imgs = [...imageUse.keys()];
for (let i = 0; i < imgs.length; i += 4) {
  await Promise.all(imgs.slice(i, i + 4).map((u) => save(u, `${OUT}/assets/${decodeURIComponent(new URL(u).pathname).replace(/^\/(wp-content\/)?/, '')}`)));
}
for (const b of new Set(brand.filter(Boolean).map(abs))) await save(b, `${OUT}/brand/${decodeURIComponent(new URL(b).pathname.split('/').pop())}`);
console.log(`Crawled ${rows.length} URLs and ${imgs.length} images → ${OUT}/`);
