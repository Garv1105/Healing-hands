// Rebuilds the Material Symbols subset font from the icon names used in the theme.
// Run after adding a new icon: npm run icons
import { readFileSync, writeFileSync, readdirSync, statSync } from 'node:fs';
import { join } from 'node:path';

const theme = 'wp-theme/healing-hands';
const files = (dir) => readdirSync(dir).flatMap((f) => {
  const p = join(dir, f);
  return statSync(p).isDirectory() ? files(p) : p.endsWith('.php') ? [p] : [];
});

const names = new Set();
for (const f of files(theme)) {
  const src = readFileSync(f, 'utf8');
  for (const m of src.matchAll(/hh_icon\(\s*'([a-z_]+)'/g)) names.add(m[1]);
  for (const m of src.matchAll(/'icon'\s*=>\s*'([a-z_]+)'/g)) names.add(m[1]);
  for (const m of src.matchAll(/\[\s*'([a-z_]+)',\s*'[A-Z]/g)) names.add(m[1]); // [ 'icon', 'Title', ... ] rows
}
const list = [...names].sort().join(',');

const ua = 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 Chrome/130 Safari/537.36';
const css = await (await fetch(`https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=${list}&display=block`, { headers: { 'User-Agent': ua } })).text();
const url = css.match(/url\((https:[^)]+)\)/)?.[1];
if (!url) throw new Error('No font URL in response:\n' + css);
writeFileSync(`${theme}/assets/fonts/material-symbols-subset.woff2`, Buffer.from(await (await fetch(url)).arrayBuffer()));
writeFileSync(`${theme}/assets/fonts/material-symbols-subset.txt`, list + '\n');
console.log(`${names.size} icons → ${theme}/assets/fonts/material-symbols-subset.woff2`);
