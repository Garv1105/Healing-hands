# Healing Hands: redesign diary

The story of the hhphysio.com redesign, from beginning to end, with an exact record of what changed compared with the original site.

**How to use this file**
- **Rule:** the original content (text) and logo stay the same. Only the design changes. Anything added, removed, replaced or moved is logged here with the reason, so it can be reviewed or undone later.
- **Where the original lives:** `original-site/` is a full scrape of the live site taken on 2 Nov 2026, and is the reference for "what it said before":
  - `pages/*.md`: the text of every page
  - `site-wide.md`: header, menu and footer
  - `urls.csv` and `images.csv`
  - `brand/`: logo and favicons
  - `assets/`: all images
- **Labels used below:**

  | Label | Meaning |
  |---|---|
  | **KEPT** | Same wording as the original. |
  | **MOVED** | Same wording, shown somewhere else. |
  | **ADDED** | New on that page. Says where the wording came from. |
  | **REPLACED** | Different from the original. Says why. |
  | **REMOVED** | Gone, with the reason. |
  | **FLAG** | An existing problem on the original that we kept unchanged and that needs your decision. |

---

## Part 1: The story

### 1 Nov 2026: the crash and the audit
- **Updates broke the site.** Several outdated plugins and the PHP version (7.2) were updated, and the site crashed with a PHP error and login problems. By the time Claude looked, the site was loading again on PHP 8.0, and WordPress core was 7.1.4.
- **A restore was rejected.** Restoring an old backup would have brought back old plugins that crash on newer PHP, so it wasn't done.
- **A full read-only audit was done.** It found:
  - Old plugins with known security holes, mainly WPBakery 6.4.2 and Contact Form 7 5.4.2.
  - Slow uncached pages: about 1.3s before the first byte, and 1.6s for real visitors.
  - A 3.8 MB homepage carrying AdSense, an autoplaying YouTube video, and Kivihealth's old jQuery 2.2.4 and Bootstrap 3.
  - SEO issues: 27 pages without a main heading (H1), 68 page titles too long for Google, thin tag pages indexed, and duplicate posts competing for the same keywords.
  - Broken local business data (schema): Kivihealth's markup had a malformed image URL and covered only the JP Nagar branch.
- **The only change made on live: PHP went from 8.0 to 8.2.** It was checked first by scanning the plugin code, then all 127 public pages were re-tested with no errors. Switching back to 8.0 is one click in hPanel.
  - Note: after the switch, PHP's "display errors" setting was found turned ON. Recommendation: switch it off in hPanel.
- **Plugins changed in between without Claude:** Yoast, LiteSpeed, SiteOrigin, Click to Chat, Site Kit, Duplicate Post and Redirection were updated, either by you or by Hostinger's auto-updates. WPBakery and Contact Form 7 are still old.

### 1 Nov 2026: references and plan
- **Design references:**
  - A Figma file (`p2yQZFOi7lkAyzl7eltnKm`) and a Google Stitch project (`15595339657585637225`), both shared by you.
  - Decision: **Stitch is the main design reference and Figma is the backup.**
- **Platform decision: stay on WordPress and build a new lightweight theme. No move to Next.js/React.** Reasons:
  - The Hostinger Starter plan can't run Node.js.
  - Keeping WordPress keeps all existing URLs and the SEO data in the database.
  - The slowness comes from the theme, page builders and scripts, not from WordPress itself.
- **Workspace decision: the work happens only on a local copy on your PC, made from an hPanel backup.**
  - No staging site and no new domain.
  - The live site is untouched until launch.

### 2 Nov 2026: local copy
- **The local copy:**
  - You downloaded the hPanel backup (files + database, dated 1 Nov 2026 18:47 UTC) into `backup/`.
  - It runs on portable PHP 8.2 and MariaDB 11.8 inside `.local/` at `http://localhost:8080`. Nothing was installed on Windows.
- **Switched off on the local copy only:**
  - Outgoing email and outgoing internet calls.
  - LiteSpeed Cache, Site Kit, and WPCode (which holds AdSense and Google Tag Manager).
  - Hostinger's auto-updater.
  - Search engines are blocked.
- **The git repo was set up:**
  - Remote: `github.com/Garv1105/Healing-hands`.
  - `backup/` and `.local/` are git-ignored, because they contain patient leads and passwords.

### 2 Nov 2026: homepage, first version (superseded)
- **What it was:** a homepage built from the Stitch design. Stitch's own content was mostly invented:
  - doctors, addresses and phone numbers
  - "4.9★ / 1,400 reviews", "15,200 patients", "NABH certified", valet parking
  - patient stories
- **Fixes made at the time:**
  - All the invented content was swapped for real clinic facts.
  - Several sections were still newly written: a symptom explorer with 6 areas, a three-step approach, a mission statement, a "Why Healing Hands" grid, an FAQ and a call-to-action band.
  - The logo was a text wordmark.
- **Problems found while building it:**
  - **Online booking (Kivihealth) can't be shown inside a popup on hhphysio.com.** Kivihealth only allows itself and stavyadental.com to embed it. This means the "Appointment Details" popup on the live site shows a blocked page.
  - On phones, the header was 48px too wide, and the header shrinking on scroll made the page jump. Both were fixed.
- **Measured** (with caching set up like the live LiteSpeed): mobile performance 88–91, desktop 100, accessibility 100.

### 2 Nov 2026: your instruction, scrape and second version
- **Your instruction:** *the content should not change, the logo should not change; log every change in a diary.*
- **The live site was scraped** with `scripts/crawl-original.mjs`:
  - Plain page requests only, so no analytics or ads were triggered.
  - 494 URLs (436 pages, 10 redirects, 48 "page not found") and 213 images.
  - Saved to `original-site/`.
- **The homepage was rebuilt** with the original sections, order and wording, the original logo, and the Stitch look. See Part 2.
- **New finding: 48 broken blog links (FLAG).** Blog posts used to live at `/blog/<category>/<post>/` and now live at `/<post>/`.
  - The old addresses show "page not found" (404), and **71 pages still link to them**.
  - Fix at launch: one redirect rule (see Part 4).

### 2 Nov 2026: calmer, botanical background (design only)
- **References:** your reference mockup `design/Reference Images/Gemini_Generated_Image_wum4m7wum4m7wum4.png` and the AI Studio draft (`github.com/Garv1105/Healing-Hands-Draft`, cloned to `design/ai-studio/`). Their text is placeholder or invented, so **only the look was used. No wording was taken from them.**
- **Background:**
  - Faint topographic contour lines.
  - Large see-through monstera, palm and eucalyptus silhouettes at section edges, slowly swaying.
  - A soft paper texture on the ivory background.
  - Hand-drawn leaf dividers that draw themselves on scroll.
  - Sections fade up gently as they come into view.
  - **All motion stops for visitors who turn off animations in their device settings.**
- **Cards:**
  - Services became full-photo cards with a dark-green fade, serif title, leaf icon and a thin gold line, like the reference.
  - "Why Us" and testimonial cards became frosted-glass cards with leaf-shaped (asymmetric) corners.
  - The hero photo and the About panel got the same leaf-shaped corners.
- **New colour:** a muted gold (`#A88F4E`), used only for small accent lines.
- **How it's built:** all artwork is SVG generated by `scripts/decor.mjs` into `assets/img/` (about 35 KB in total, ~12 KB compressed). It's placed with `hh_leaf()` and `hh_divider()` in `functions.php`, and the styles are in `src/main.css` (the "Calm background decor" block).
- **Content: no changes.**

### 2 Nov 2026: scroll story and body map (design + interaction)
- **Source:** two sections from the AI Studio draft, adapted into **existing** sections so nothing repeats. None of the draft's wording or claims were used.
- **"We Provide Top Quality Physiotherapy Treatment" became a scroll story:**
  - The 3 original paragraphs are 3 steps with a vertical line that fills as you scroll.
  - A pinned photo panel cross-fades between real clinic photos, with a progress ring and step pills.
- **"Treatment by Symptoms" got the Anatomical Region Selector:** a body diagram whose glowing hotspots match the original 4 symptoms.
- **Built with** about 60 lines of plain JavaScript in `assets/js/main.js`. No libraries were added.
- **Checks:** everything works without JavaScript, respects the reduced-motion setting, and was tested in a real browser on desktop and phone.

---

## Part 2: Homepage compared with the original

Original: `original-site/pages/home.md`. New: `wp-theme/healing-hands/front-page.php` → `template-parts/home/*.php`, with the wording in `inc/data.php`.

### Header (every page)
| What | Status | Details |
|---|---|---|
| Logo | **KEPT** | Same file `2021/01/logo-straight-min-e1626264330426.png`, same alt text. |
| Menu | **KEPT** | Same WordPress menu. The About Us dropdown keeps the same 7 links. |
| Phone `888-444-7808` | **KEPT** | Shown in the top bar and the header. |
| "JP Nagar · Jayanagar · BTM Layout" in the top bar | **ADDED** | The branch names from the original footer. |
| "Book Now" button in the header | **ADDED** | Label and target (`/book-appointment/`) copied from the original footer's "Book Now" button. |

### Hero (top of the homepage)
| What | Status | Details |
|---|---|---|
| Full-width banner `2023/02/Best-physiotherapy-clinic-in-Bengaluru.webp` (text "EXPERIENCE WORLD CLASS PHYSIOTHERAPY" baked into the image) | **REPLACED** | The banner's text is now real text in a pill label, "Experience World Class Physiotherapy". The image is now the original Jayanagar exercise-area photo, with its original alt text, from the Jayanagar branch page. **Why:** text inside an image can't be read by Google or screen readers, and the banner's blue graphic doesn't fit the new design. **To undo:** use the banner in `hero.php`. |
| Main heading (H1) "Best Physiotherapy Clinic in Bangalore" | **MOVED** | It was further down the original page (above Latest News). It's now the main hero heading. Same wording, and still one H1 on the page. |
| Paragraph "Healing Hands Advanced Physiotherapy Clinic is one of the best…" | **MOVED** | Copied from the original footer's About Us text, which also stays in the footer. |
| "Get a Call Back" form (Name, Email, Phone) | **ADDED** | It's the site's existing Contact Form 7 form "Physiotherapy Near Me" (ID 12654), already used on the "near me" landing pages. Same fields, same button, same emails, and the same redirect to the thank-you page. |
| Links under the form: "Book Now", phone, "WhatsApp Us" | **ADDED** | All original labels. "WhatsApp Us" was the floating WhatsApp button's label. |
| Two floating cards on the photo: "Physiotherapy in Bangalore" (JP Nagar · Jayanagar · BTM Layout) and "Physiotherapy At Home" | **ADDED** | Original headings, linking to the original pages `/bangalore/` and `/services/physiotherapy-at-home/`. |

### "We Provide Top Quality Physiotherapy Treatment"
| What | Status | Details |
|---|---|---|
| Heading and all 3 paragraphs | **KEPT** | Word for word. |
| "Expert Physiotherapists" and its YouTube video (`l7ARrWEA1jM`) | **KEPT** (behaviour **REPLACED**) | The original video autoplayed muted, adding about 1 MB to every visit. It now shows a thumbnail and plays only when tapped, via youtube-nocookie.com. It sits in a dark card right after the 3 steps. |
| Layout of the 3 paragraphs | **REPLACED** (design) | Shown as a scroll story with 3 numbered steps. |
| Step titles | **ADDED** (quoted) | Phrases quoted from each paragraph itself: "World–class Physiotherapy services at an affordable cost", "The treatment plan as per the patient needs", "Treat the entire root cause of your problem". |
| Step numbers "01 / 02 / 03" | **ADDED** | Design labels. |
| Step photos | **ADDED** | Original uploads with their original alt text: BTM Layout interior, Manual Therapy, Therapeutic Exercise. |

### Services
| What | Status | Details |
|---|---|---|
| Heading, 6 services (titles, descriptions, images, alt texts, links, order), "See all Services" | **KEPT** | |
| **"Chiropractor Treatment" description** | **FLAG** | The original text talks about *Pediatric Physiotherapy*, which looks like a copy-paste mistake. It's kept unchanged for now. Tell us the correct text, or approve: "Chiropractic adjustments to relieve joint and spine pain…" |
| "Physiotherapy At Home" link `/services/physiotherapy-at-home/` | **KEPT** (**FLAG**) | Same link as the original. It redirects to `/services/physiotherapy-at-home-near-you-bangalore/`. |

### Therapies
| What | Status | Details |
|---|---|---|
| Heading, 2 paragraphs, "See all Therapies", the 6 therapy names and photos | **KEPT** | Shown as a photo grid instead of a carousel. Not linked, as on the original. |

### Treatment by Symptoms
| What | Status | Details |
|---|---|---|
| Heading, 4 symptoms with their texts, "Know More" links, "Explore all", the "Conditions Treated" image | **KEPT** | Now shown as tabs, with one symptom's text visible at a time. All 4 texts are still in the page for Google. |
| Body diagram with 4 clickable hotspots | **ADDED** (design) | Neck, back, knee, and upper arm for Muscle Stiffness. The hotspots switch the same tabs as the pills. |
| Labels "Anatomical Region Selector" and "4 Clinical Zones" | **ADDED** | New design labels taken from the AI Studio draft. Remove them in `symptoms.php` if you'd rather not have them. |

### Why Us
| What | Status | Details |
|---|---|---|
| Heading and all 6 items | **KEPT** | Word for word. Icons are new design elements. |

### Our Team
| What | Status | Details |
|---|---|---|
| All 11 team members (order, names, roles, photos, alt texts) | **KEPT** | Scrollable row with arrow buttons. |

### Physiotherapy in Bangalore
| What | Status | Details |
|---|---|---|
| Heading, 3 branches (names, photos, alt texts, links) | **KEPT** | Shown as tabs. |
| Address, phone and email under each branch | **ADDED** | Copied word for word from the original branch pages (`/contact-us/btm-branch/` etc.). |
| "Book Now" and "Map" buttons per branch | **ADDED** | "Book Now" goes to `/book-appointment/`. "Map" opens a Google Maps search for the branch address. |

### Latest News and Blogs
| What | Status | Details |
|---|---|---|
| Heading, both paragraphs, "Read all News", the 3 latest posts (date dd/mm/yyyy, title, short excerpt, "Read Post") | **KEPT** | Posts load automatically. |

### Client Testimonials
| What | Status | Details |
|---|---|---|
| The 3 testimonial graphics (PNG images with text inside) | **REPLACED** | Now text cards with the **exact words from each image's alt text**: Sheub Adnan, Jyoti, Latha. Same people, same wording, same order. **Why:** text inside images can't be read by Google or screen readers. The original images are in `original-site/assets/uploads/2024/02/`. |

### Footer (every page)
| What | Status | Details |
|---|---|---|
| About Us text + "Book Now"; Find Us (4 links); Our Branches (3 links); Give us a Call `+ (91) 888 - 444 -7808`; Send us a Message `HealingHandsBLR@gmail.com`; Follow Us (Facebook, Instagram, X/Twitter, LinkedIn, YouTube); "Copyright © 2023. All rights reserved to Healing Hands Advanced Physiotherapy Clinic"; `888-444-7808` | **KEPT** | |
| "Non Surgical Knee Pain Treatment in Bangalore" → thejointpro.com | **KEPT** (**FLAG**) | An external link to another website. If it isn't yours, it sends visitors and SEO value away. |
| Our Branches links | **KEPT** (**FLAG**) | They use old URLs that redirect to `/bangalore/best-physiotherapy-clinic-in-…/`. |
| "© 2023" | **KEPT** (**FLAG**) | Out of date. Should it show the current year automatically? |
| Background pattern `2021/06/footer_pattern.png` | **REMOVED** | The file no longer exists on live (404). |
| Scroll-to-top arrow | **REMOVED** | Not part of the new design. Can be added back. |

### Site-wide extras
| What | Status | Details |
|---|---|---|
| Click to Chat floating WhatsApp button | **REPLACED** | Now a theme button: "Book Now" + "WhatsApp Us", same number (918884447808). The plugin gets deactivated at launch; it also had security holes. |
| Kivihealth "Appointment Details" popup | **REMOVED** | It's broken on live, because Kivihealth blocks being shown inside hhphysio.com. All "Book Now" buttons go to `/book-appointment/`, the original target. |
| Kivihealth scripts in the header (jQuery 2.2.4, Bootstrap 3, widget CSS, JP Nagar schema) | **REMOVED** | Old, insecure and slow. The schema had a malformed image URL. It will be replaced by correct clinic data (schema) for each of the 3 branches. |
| AdSense / Google Tag Manager | Unchanged | Loaded by the WPCode plugin, not the theme, so they stay on live unless you decide otherwise. Turned off only on the local copy. |
| Fonts and colours | **REPLACED** | Stitch design: Playfair Display + Plus Jakarta Sans, forest green and ivory. This is design, not content. |

---

## Part 3: Open decisions (need your answer)
1. **Chiropractor Treatment description:** fix the copy-paste mistake? (Services FLAG)
2. **© 2023:** keep it, or show the current year?
3. **thejointpro.com footer link:** keep or remove?
4. **Hero image:** keep the clinic photo, or bring back the original banner?
5. **Opening hours and Google rating:** not on the original site. Add them only if you provide them.
6. **AdSense on a clinic site:** keep or remove? It slows pages and can show competitors' ads.

---

## Part 4: Launch checklist (grows as work continues)
- [ ] Fresh hPanel backup.
- [ ] Upload `wp-theme/healing-hands/` and activate it.
- [ ] Deactivate Click to Chat. The theme has its own WhatsApp button.
- [ ] Fix the old blog links. In **Redirection → Add new**, Regex ON:
  - Source: `^/blog/(?!page/)(?:[^/]+/)+([^/]+)/?$`
  - Target: `/$1/`
  - Type: 301
- [ ] Update Contact Form 7 (5.4.2 has security holes) and WPBakery.
- [ ] Check Appearance → Menus → Primary.
- [ ] Purge LiteSpeed.
- [ ] Re-crawl with `node scripts/crawl-original.mjs` and compare against `original-site/`.
- [ ] Submit the sitemap in Search Console.

---

## Part 5: Change log (newest last)
| Date | Change | Files |
|---|---|---|
| 2026-11-01 | Live: PHP 8.0 → 8.2 (only change ever made on live so far) | hPanel |
| 2026-11-02 | Local copy of the site from the hPanel backup | `.local/` (private) |
| 2026-11-02 | Repo set up; Stitch export saved | `design/stitch/`, `CLAUDE.md`, `README.md` |
| 2026-11-02 | Homepage v1 (Stitch content + real facts) | `wp-theme/healing-hands/` |
| 2026-11-02 | Full scrape of the live site | `original-site/`, `scripts/crawl-original.mjs` |
| 2026-11-02 | Homepage v2: original content, logo, order and the original "Get a Call Back" form. v1's newly written sections removed: three-step approach, mission, "Why Healing Hands" grid, FAQ, call-to-action band, 6-area symptom explorer, custom call-back form | `wp-theme/healing-hands/`, `inc/data.php` |
| 2026-11-02 | Calm botanical background and card restyle (design only, no content changes) | `scripts/decor.mjs`, `assets/img/`, `src/main.css`, `template-parts/home/*`, `functions.php` |
| 2026-11-02 | Scroll story (About) and Anatomical Region Selector (Treatment by Symptoms), adapted from the AI Studio draft | `about.php`, `symptoms.php`, `assets/js/main.js`, `src/main.css`, `inc/data.php` |
