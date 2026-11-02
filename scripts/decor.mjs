// Generates the theme's decorative background SVGs (topographic lines + botanical silhouettes).
// Run: node scripts/decor.mjs  → wp-theme/healing-hands/assets/img/*.svg
// Tweak shapes/colours here, then re-run. All artwork is decorative (aria-hidden in templates).
import { writeFileSync, mkdirSync } from 'node:fs';

const OUT = 'wp-theme/healing-hands/assets/img';
mkdirSync(OUT, { recursive: true });
const r1 = (n) => Math.round(n * 10) / 10;
const pts = (a) => a.map(([x, y]) => `${r1(x)} ${r1(y)}`).join(' L');
const svg = (w, h, body) => `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 ${w} ${h}">${body}</svg>\n`;
const rot = ([x, y], a) => [x * Math.cos(a) - y * Math.sin(a), x * Math.sin(a) + y * Math.cos(a)];

// 1. Topographic contour lines: concentric, gently distorted rings around two centres.
{
  const rings = (cx, cy, n, seed) => Array.from({ length: n }, (_, i) => {
    const r0 = 70 + i * 46;
    const p = Array.from({ length: 72 }, (_, k) => {
      const t = (k / 72) * Math.PI * 2;
      const r = r0 + 18 * Math.sin(3 * t + seed + i * 0.35) + 11 * Math.sin(5 * t - seed * 1.7 + i * 0.2) + 6 * Math.sin(9 * t + i);
      return [cx + r * Math.cos(t), cy + r * 0.72 * Math.sin(t)];
    });
    return `<path d="M${pts(p)}Z"/>`;
  }).join('');
  writeFileSync(`${OUT}/topo.svg`, svg(1600, 1000,
    `<g fill="none" stroke="#5E8B71" stroke-opacity=".16" stroke-width="1.1">${rings(260, 180, 14, 0.4)}${rings(1380, 860, 13, 2.1)}</g>`));
}

// 2. Monstera leaf: heart-shaped outline with slits cut in from the edge, plus small holes.
{
  // Ovate leaf (stem notch at t=0, tip at t=π) with wedge slits running from the edge almost to the midrib.
  const S = 13, slits = [1.15, 1.45, 1.75, 2.05, 2.38], W = 0.07;
  const shape = (t) => [S * 15 * Math.sign(Math.sin(t)) * Math.abs(Math.sin(t)) ** 1.6, -S * 1.25 * (13 * Math.cos(t) - 4 * Math.cos(2 * t) - 2 * Math.cos(3 * t) - Math.cos(4 * t))];
  const outline = [];
  for (let k = 0; k <= 600; k++) {
    const t = (k / 600) * Math.PI * 2;
    const tt = t > Math.PI ? 2 * Math.PI - t : t; // mirror slits on both sides
    const s = slits.find((v) => Math.abs(tt - v) < W);
    const [x, y] = shape(t);
    if (s === undefined) { outline.push([x, y]); continue; }
    const [ex, ey] = shape(t > Math.PI ? 2 * Math.PI - s : s);
    const f = Math.abs(tt - s) / W;                    // 0 at slit centre → 1 at slit edge
    const inner = [ex * 0.14, ey * 0.86 + 18];         // slit ends just short of the midrib
    const g = Math.max(f * 1.6 - 0.6, 0);              // narrow, deep slit that opens up near the edge
    outline.push([inner[0] + (x - inner[0]) * g, inner[1] + (y - inner[1]) * g]);
  }
  const holes = slits.slice(0, 4).flatMap((v) => [1, -1].map((side) => {
    const [x, y] = shape(v + 0.15);
    const hx = side * Math.abs(x) * 0.5, hy = y * 0.88 + 12;
    return `M${r1(hx + 8)} ${r1(hy)}a8 4.5 ${side * 30} 1 0-16 0a8 4.5 ${side * 30} 1 0 16 0Z`;
  })).join('');
  // Rotated so the stem points down-left and the tip up-right, like a growing leaf.
  const body = `<g transform="translate(260 300) rotate(200)"><path fill="#204B35" fill-rule="evenodd" d="M${pts(outline)}Z${holes}"/>` +
    `<path d="M0 -90 C 4 -160, 14 -220, 30 -270" fill="none" stroke="#204B35" stroke-width="7" stroke-linecap="round"/></g>`;
  writeFileSync(`${OUT}/leaf-monstera.svg`, svg(520, 620, body));
}

// 3. Palm frond: curved spine with tapering leaflets on both sides.
{
  const P = (t) => [60 + 520 * t, 560 - 430 * t - 160 * Math.sin(Math.PI * t) * 0.6]; // spine
  let leaflets = '';
  for (let i = 0; i < 26; i++) {
    const t = 0.06 + (i / 26) * 0.92;
    const [x, y] = P(t);
    const [x2, y2] = P(t + 0.01);
    const ang = Math.atan2(y2 - y, x2 - x);
    const L = 190 * (1 - t * 0.75), w = 13 * (1 - t * 0.5);
    for (const side of [1, -1]) {
      const a = ang + side * 1.05;
      const tip = [x + L * Math.cos(a), y + L * Math.sin(a)];
      const c1 = rot([L * 0.5, -w * side], a), c2 = rot([L * 0.5, w * side * 0.4], a);
      leaflets += `M${r1(x)} ${r1(y)}Q${r1(x + c1[0])} ${r1(y + c1[1])} ${r1(tip[0])} ${r1(tip[1])}Q${r1(x + c2[0])} ${r1(y + c2[1])} ${r1(x)} ${r1(y)}Z`;
    }
  }
  const spine = Array.from({ length: 40 }, (_, k) => P(k / 39));
  writeFileSync(`${OUT}/leaf-palm.svg`, svg(720, 620,
    `<path fill="#204B35" d="${leaflets}"/><path d="M${pts(spine)}" fill="none" stroke="#204B35" stroke-width="5" stroke-linecap="round"/>`));
}

// 4. Eucalyptus sprig: wavy stem with alternating round leaves.
{
  const P = (t) => [40 + 340 * t + 30 * Math.sin(t * 6), 560 - 520 * t];
  let leaves = '';
  for (let i = 0; i < 14; i++) {
    const t = 0.08 + i * 0.065;
    const [x, y] = P(t), side = i % 2 ? 1 : -1, rx = 34 - i * 1.4, ry = 26 - i * 1.1;
    leaves += `<ellipse cx="${r1(x + side * (rx + 6))}" cy="${r1(y - 4)}" rx="${r1(rx)}" ry="${r1(ry)}" transform="rotate(${side * 25} ${r1(x)} ${r1(y)})"/>`;
  }
  const stem = Array.from({ length: 40 }, (_, k) => P(k / 39));
  writeFileSync(`${OUT}/leaf-eucalyptus.svg`, svg(460, 600,
    `<g fill="#3B674F">${leaves}</g><path d="M${pts(stem)}" fill="none" stroke="#3B674F" stroke-width="4" stroke-linecap="round"/>`));
}

// 5. Line-art leaf (outline, midrib, veins) for large faint decoration.
{
  const veins = [0.25, 0.4, 0.55, 0.7].map((t) => {
    const y = 470 - 400 * t;
    return `M150 ${y}q${-55 + t * 30} -30 ${-80 + t * 40} -70M150 ${y}q${55 - t * 30} -30 ${80 - t * 40} -70`;
  }).join('');
  writeFileSync(`${OUT}/leaf-line.svg`, svg(300, 520,
    `<g fill="none" stroke="#5E8B71" stroke-width="2.2" stroke-linecap="round"><path d="M150 500 C 20 380, 20 170, 150 30 C 280 170, 280 380, 150 500Z"/><path d="M150 510 L150 50${veins}"/></g>`));
}

console.log('decor SVGs →', OUT);
