# Healing Hands: hhphysio.com redesign

Full redesign of **hhphysio.com**, a physiotherapy clinic in Bengaluru with branches in BTM Layout, Jayanagar and JP Nagar. The site runs WordPress on Hostinger's **Starter** plan (user `u604647181`; no Node.js).

## Hard rules
- **Never change the live site** (files, database, plugins, settings) until the user explicitly says it's launch time.
- Work only on the **local copy** built from the hPanel backup in `backup/`. Don't create a staging site, subdomain or new domain.
- **Protect SEO**: keep every existing URL (269 in the sitemap), Yoast titles and descriptions, and canonicals. Don't rename slugs.
- At launch, move **only the theme and the rebuilt pages**. Never upload the local database to live, because that would wipe new posts and leads.
- On the local copy, keep email, analytics, AdSense, Site Kit and LiteSpeed/CDN switched off.
- **Original content and logo stay unchanged.** Take wording from `original-site/pages/*.md` (a scrape of the live site) and use the original logo. Every addition, removal, replacement or move gets logged in **`REDESIGN-DIARY.md`** (story + section-by-section log + launch checklist).

## Local copy
- Built from the 2026-11-01 hPanel backup in `backup/`. It runs from `.local/` (portable PHP 8.2 + MariaDB 11.8; nothing is installed system-wide).
- Start it: double-click `.local\start.cmd` → http://localhost:8080 (database at 127.0.0.1:3307, db `hhphysio`, user/password `wp`/`wp`).
- WP-CLI: `.local/php/php.exe -c .local/php/php.ini .local/wp-cli.phar --path=.local/site <cmd>`
- What's disabled on the local copy only:
  - outgoing email (`mu-plugins/local-safety.php`)
  - outgoing HTTP calls (`WP_HTTP_BLOCK_EXTERNAL`)
  - LiteSpeed Cache, Site Kit and WPCode (AdSense/GTM)
  - the cache drop-ins and Hostinger's auto-updater (moved to `.local/disabled/`)
- `backup/` and `.local/` contain patient leads (CF7) and credentials. **Never commit, upload or share them.**

## Approach
Stay on WordPress and replace the theme. **No migration to Next.js/React.**
The new custom theme lives in `wp-theme/healing-hands/` (junction-linked into `.local/site/wp-content/themes/`, so edits show up locally right away):
- classic PHP templates
- compiled Tailwind CSS (not the CDN script)
- self-hosted fonts
- small vanilla JS only

It drops WPBakery, SiteOrigin, jQuery and AdSense. YouTube loads only when clicked.

### Theme layout & commands
- `npm run build` / `npm run watch`: Tailwind v3 (`tailwind.config.js` holds the Stitch tokens) compiles `src/main.css` → `assets/css/main.css`. **Commit the built CSS**; it's what gets uploaded.
- `npm run icons`: rebuilds the Material Symbols subset font after you add an icon via `hh_icon()`.
- All site wording lives in `inc/data.php`, copied word for word from the original.
- Homepage sections: `front-page.php` → `template-parts/home/*.php`.
- The hero form is the site's existing CF7 form **"Physiotherapy Near Me"** ("Get a Call Back"), restyled via `html_class="hh-form"`. It keeps its thank-you-page redirect (wpcf7-redirect).
- "Book Now" buttons go to `/book-appointment/`, the original target. Kivihealth can't be iframed on hhphysio.com (CSP `frame-ancestors`).
- `npm i` then `node scripts/crawl-original.mjs` re-scrapes the live site into `original-site/` (read-only; raw HTML goes to `.local/original-html/`).
- Content rule: never invent clinic claims (ratings, patient counts, certifications, hours, doctor bios). Testimonials are quoted verbatim.

### Launch checklist
Kept in `REDESIGN-DIARY.md` (Part 4).

Full plan: `C:\Users\garva\.claude\plans\ok-see-i-ll-tell-elegant-feigenbaum.md`

## Design references
1. **Primary: Stitch** project `15595339657585637225`, desktop homepage screen `c981f213966e418c892c2b5dc912faef`. It's exported to `design/stitch/index.html` + `images/`.
   - Layout, components, interactions, colors, type and spacing follow Stitch.
   - Design tokens are in the project's `designMd`: Playfair Display + Plus Jakarta Sans, forest `#1B3B2B`, ivory `#FBF9F5`, and so on.
2. **Secondary: Figma** file `p2yQZFOi7lkAyzl7eltnKm`, homepage node `2:13616`, plus a spec board.
   - Use it for anything Stitch lacks: real doctor and clinic photos, the articles section, the body-map idea, "Life beyond the clinic", inner-page patterns, states and accessibility notes.
3. Stitch's doctor names and photos are placeholders. Always use real content from the live site.

## Targets
Mobile Lighthouse 90+, LCP < 2.5s, CLS < 0.1, one H1 per page, MedicalClinic schema per branch.
