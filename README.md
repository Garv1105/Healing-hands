# Healing Hands: hhphysio.com redesign

A new lightweight WordPress theme for [hhphysio.com](https://hhphysio.com), replacing Physio-qt, WPBakery and SiteOrigin.

- `wp-theme/healing-hands/` — the theme (this is what gets uploaded at launch)
- `design/stitch/` — Stitch homepage export (primary design reference)
- Figma `p2yQZFOi7lkAyzl7eltnKm` — secondary reference
- `design/ai-studio/` — AI Studio draft ([Healing-Hands-Draft](https://github.com/Garv1105/Healing-Hands-Draft)), used for look and interactions only; its text is placeholder
- `REDESIGN-DIARY.md` — every change, plus the launch checklist

The live site isn't touched during development. Work happens on a local copy built from an hPanel backup (`backup/` and `.local/`, both git-ignored). See `CLAUDE.md` for details.

## Preview on Vercel

Vercel can't run WordPress (PHP + MySQL), so the real site launches on Hostinger. https://healing-hands-psi.vercel.app is a static, `noindex` snapshot of the local site for sharing: the homepage plus the pages it links to. The form doesn't submit there. The snapshot is exported to `.local/preview/` and deployed from that folder.

Don't run `vercel` from `design/ai-studio/`: it's linked to the same Vercel project and would replace the preview with the draft.
