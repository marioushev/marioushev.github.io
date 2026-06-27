# Design Audit — Lessons from kickflip.design

> **Purpose:** A prioritized, actionable audit for improving this portfolio site, based on a teardown of [kickflip.design](https://kickflip.design) (a Strategy + Design + AI agency built on Framer).
> **How to use:** Work top to bottom. Each move has *Why → Current state → Target → Steps → Done when*. Check items off as you go.
> **Date:** 2026-06-28
> **Branch:** `mac/new-layout`

---

## Reference snapshot — what kickflip.design actually does

These numbers were pulled from the live source, not estimated.

### Fonts
- **Inter** — all UI, body, and headings (variable weights). The workhorse.
- **Fragment Mono** — used *only as an accent*: small-caps labels, section numbers, stat tickers, and the `»` / `→` glyphs. Never for paragraphs.
- **Total: 2 families.** One clean sans + one mono for flavor.
- *Our equivalent:* `DM Sans` (sans) + `Space Mono` (mono) — same philosophy, already in place.

### Colors
Structure = **near-neutral base + ONE loud signature color + a small "spice rack" of accents.**
- Base: black `#000000` / `#070707`, white `#ffffff`, light grey `#e8e8e8`, mid-grey text `#696969`
- **Signature accent: electric blue `rgb(0,153,255)`** — 300+ uses (links, hovers, highlights). The only cool note in a neutral field, which is *why it pops*.
- Spice rack (used sparingly on tags/case-study chips): lime `#bcfd4c`, coral `#ff6a3d`, lilac `#d6a3fb`, yellow `#fffe6f`, pink `#ffb8b9`, green `#4ecb4a`

### Type scale (real px values, large → small)
- Display: `200 / 160 / 92 / 80 / 74 / 60`
- Headings: `52 / 42 / 32 / 30`
- Sub / lead: `24 / 22 / 20`
- Body: `17 / 16`
- Labels / mono / captions: `13 / 12`
- **Lesson:** A dramatic jump between body (16–17px) and display (80–200px). The *contrast itself* is the design.

### Page flow (top to bottom)
1. Hero — one-line value prop + tagline
2. Short studio intro
3. **Recent Projects** (6 case studies → real `/work/...` sub-pages)
4. Services (4 pillars)
5. Reputation / social proof (stats: "1M+", Clutch)
6. Testimonials (heavy rotation / marquee)
7. Footer = full nav + "Get in touch" + social links

Nav: `Work · Services · Pricing · About · AI Strategy` — note **Work before Services**, and **Pricing is public**.

### Services framing
Four named pillars, each a scannable keyword list (not a flat bullet list):
- **STRATEGY** — Discovery, Workshops, Pitch Decks, AI Strategy, AI Agents
- **BRAND** — Brand Strategy, Logo, Visual Identity, Motion, Messaging
- **WEB** — Storytelling, Web Architecture, Design, SEO/CRO, Ecommerce, No-Code
- **PRODUCT** — UX, Prototyping, Mobile Apps, SaaS Growth, MVP, "Vibe Coding"
- Outcome-led copy: *"launch brands in weeks, not months."*

### Copy / tone
- Confident, founder-facing, slightly contrarian.
- Hero: **"Strategy, Design & AI for ambitious founders"**
- Tagline: **"We elevate businesses from 0 to 1, infinity and beyond"**
- Proof line: **"Reputation is everything. Ours is flawless."**
- Soft CTA: **"Get in touch"** (invitational, not "Buy now").
- Uses `»` / `→` as typographic punctuation for energy.

### Notable interactions / visual style
- Giant editorial type as the main visual (less reliance on imagery).
- Looping testimonial marquee.
- Colored case-study chips/tags.
- Stat counters for credibility.

---

## THE 6 HIGHEST-LEVERAGE MOVES

Ordered by impact. Do them top to bottom.

---

### ✅ Move 1 — Reorder the page: Work → Services → Proof → Contact

**Why:** Kickflip shows *proof before pitch*. Visitors trust what you've shipped more than a list of what you claim to do. Their nav literally puts **Work before Services**.

**Current state:** Section order is roughly Hero → Services → Projects → Contact (services pitch comes before evidence).

**Target order:**
1. Hero (sharp value prop — see Move 6)
2. Selected Work (lead with 3–6 best case studies — see Move 2)
3. Services (3–4 pillars — see Move 5)
4. Proof (testimonials + one hard stat — see Move 5)
5. Contact (soft CTA — see Move 6)

**Steps:**
- [ ] In `index.html`, move the Projects/Work `<section>` so it sits immediately after the hero, before Services.
- [ ] Update the header nav links + anchor order to match: `Work · Services · About · Contact` (consider adding `Pricing` later — see notes).
- [ ] Verify in-page anchor links (`#work`, `#services`, etc.) still scroll to the right sections.
- [ ] Re-check scroll-reveal / animation triggers still fire in the new order.

**Done when:** A first-time visitor sees real work within one scroll of the hero, and nav order reads Work → Services → About → Contact.

---

### ✅ Move 2 — Turn projects into real case-study pages (not just thumbnails)

**Why:** Kickflip's projects link to full `/work/<project>` sub-pages with problem → role → outcome. This is the single biggest credibility multiplier — especially for a *team* framing. A thumbnail says "we made a thing"; a case study says "we solved a problem and here's the result."

**Current state:** Projects are image tiles (VakInvest, Shar, makros, psari, etc.) with little/no narrative or measurable outcome.

**Target:** A reusable case-study page template. Each case study answers:
1. **Client / project** + one-line summary
2. **The challenge** (problem in plain language)
3. **Our role** (what the team did — design, build, etc.)
4. **The work** (2–4 visuals, before/after if possible)
5. **The outcome** (a result — ideally a number: traffic, conversions, launch time, etc.)
6. **Tech/stack tags** (colored chips, like kickflip)

**Steps:**
- [ ] Create a template at `work/_template/index.html` (or a single `work.html` pattern) with the 6-block structure above.
- [ ] Build the first real case study for the strongest project (suggest **VakInvest** — most recent, has assets).
- [ ] Make each project tile on the homepage link to its case-study page.
- [ ] Add a result line/metric to each tile so the homepage itself previews the outcome.
- [ ] Backfill 2 more case studies (Shar, makros) using the same template.

**Done when:** At least 3 projects have clickable, structured case-study pages, each ending with a concrete outcome, and homepage tiles link to them.

---

### ✅ Move 3 — Commit to ONE signature accent color

**Why:** Kickflip's electric blue works because it's the *only* loud, cool note in a neutral field — so the eye goes straight to links and CTAs. Our current theme spreads the "loud" job across three sibling warm tones (rust `#c4622e`, amber `#e0913f`, gold `#d8a94b`), so nothing truly pops and CTAs don't stand out.

**Current state (`assets/css/style-code.css` `:root`):**
```
--rust: #c4622e;  --amber: #e0913f;  --gold: #d8a94b;
--accent: #d9d2b4;   /* sand — same family as text, no contrast */
--prompt: #c4622e;
```

**Target:** Keep the warm dark-desert base, but elect **one** high-contrast signature accent reserved for interactive/important elements (links, primary CTA, active states, key highlights). Demote the others to rare decorative use only.

**Recommendation:** Promote **rust `#c4622e`** to *the* signature (it already reads as the "prompt" color and has the most contrast against the dark bg). Keep amber/gold only for hover states or tiny decorative touches. Consider brightening rust slightly for AA contrast on `#0a0705` if needed.

**Steps:**
- [ ] Add a single clear `--signature` (or repurpose `--accent`) variable and point it at the chosen accent.
- [ ] Audit every use of rust/amber/gold; route links, CTA buttons, and active/hover states through `--signature`.
- [ ] Reduce amber/gold to ≤2 decorative uses total.
- [ ] Check contrast ratio of accent-on-bg and accent-on-surface hits WCAG AA (≥4.5:1 for text).

**Done when:** There is exactly one color the user associates with "clickable/important," and it passes contrast checks.

---

### ✅ Move 4 — Go bigger on type; exploit the scale gap

**Why:** Kickflip's design *is* the type contrast — body at 16–17px, display blasting to 80–200px. Most amateur sites cap headings at 36–48px and feel timid. A big jump reads as confident and editorial.

**Current state:** Headings are modest; the dramatic body-to-display gap isn't being used.

**Target scale (adapt to taste):**
- Hero / display: `72–120px` (clamp for responsive)
- Section headings (H2): `40–56px`
- Sub-headings (H3): `24–32px`
- Lead paragraph: `20–22px`
- Body: `16–18px`
- Mono labels / captions / tags: `12–13px` (use `Space Mono`, uppercase, letter-spaced)

**Steps:**
- [ ] Define a type scale with `clamp()` in `:root` (e.g. `--fs-hero: clamp(2.5rem, 8vw, 7.5rem)`).
- [ ] Apply `--fs-hero` to the hero headline; set H2/H3/body/label sizes from the scale.
- [ ] Use `Space Mono` 12–13px uppercase + letter-spacing for section eyebrow labels and tags.
- [ ] Test on mobile (375px) and desktop (1440px) — hero must not overflow or wrap badly.

**Done when:** The hero headline is dramatically larger than body text, the scale is consistent across sections, and mono labels mark each section.

---

### ✅ Move 5 — Add social proof (testimonials + one hard stat) + pillar-based services

**Why:** Kickflip drowns the page in proof (Clutch, stats like "1M+", repeating testimonials) and frames services as 3–4 *owned domains*, not a task list. Both are essential when presenting as a **team/studio** rather than one person — proof substitutes for the trust a known name would carry.

**Current state:** No testimonials or stats; services likely a flat list.

**Target — Proof section:**
- 2–3 short client testimonials (name, role, company, quote).
- One headline stat or a small stat row (e.g. "X projects shipped", "Y years", "Z% faster launches"). Even 2–3 numbers work.
- Optional: client logos / platform badges.

**Target — Services as pillars:** Group into 3–4 named pillars, each with a scannable keyword list and outcome-led copy.
Suggested pillars for this studio (adjust to reality):
- **WEB** — Web Design, Web Architecture, WordPress/Theme Dev, SEO, Performance, No-Code
- **PRODUCT** — UX, Prototyping, Web Apps, MVPs, Integrations
- **BRAND** — Visual Identity, Logo, Messaging *(only if true)*
- Lead each with an outcome line (e.g. *"From idea to live site in weeks, not months."*)

**Steps:**
- [ ] Collect 2–3 real testimonials (ask past clients if needed; never fabricate).
- [ ] Decide on 2–3 honest, defensible stats.
- [ ] Build a Proof `<section>` placed after Services (before Contact).
- [ ] Refactor Services into 3–4 pillar cards with keyword lists + outcome lines.
- [ ] Optional: add a testimonial marquee or simple grid.

**Done when:** The page contains real testimonials, at least one stat, and services read as owned domains rather than a flat bullet list. **No fabricated proof.**

---

### ✅ Move 6 — Sharpen the hero into one opinionated line + a soft CTA

**Why:** Kickflip leads with a sharp, founder-facing point of view ("Strategy, Design & AI for ambitious founders") and a soft, invitational CTA ("Get in touch") — not "We build websites." A clear POV in the first 3 seconds is what makes a studio memorable.

**Current state:** Hero copy is generic / not a single sharp statement; CTA may be weak or absent.

**Target:**
- **One** opinionated headline that states who it's for + what you deliver.
- A supporting tagline (one line).
- A **soft CTA** button: "Get in touch" / "Start a project".
- Optional: `»` / `→` glyphs (in `Space Mono`) as energetic punctuation.
- Lean on the giant type (Move 4) rather than a busy background image.

**Draft directions (pick/refine one — keep the team framing, no headcount):**
- "Websites & products for businesses that mean it."
- "We design and build the web — fast, sharp, and built to last."
- "Strategy, design & code for ambitious brands."

**Steps:**
- [ ] Write/choose one headline + one tagline.
- [ ] Replace hero copy in `index.html`.
- [ ] Add/restyle a single primary CTA button → links to Contact (`#contact`).
- [ ] Apply the hero display size from Move 4; ensure the background doesn't fight the text.
- [ ] Add a secondary subtle CTA in the header (optional).

**Done when:** A visitor knows who you are and who you're for within 3 seconds, and there's one obvious, friendly way to start a conversation.

---

## Notes / parking lot (not in the top 6)
- **Pricing transparency:** Kickflip puts Pricing in the nav — radical transparency builds trust. Consider a "packages / starting at" page once case studies exist.
- **Mono accent discipline:** Use `Space Mono` deliberately (eyebrow labels, section numbers, stat tickers, tags) — not for body text.
- **Editorial-first visuals:** Favor big type over heavy imagery; it scales better and loads faster.
- **Deep linking / case-study SEO:** Real `/work/...` pages give you indexable content and shareable links per project.

## Suggested working order
Moves are already in priority order. A practical sequence:
**1 (reorder) → 6 (hero) → 4 (type) → 3 (color) → 5 (services + proof) → 2 (case studies, largest effort, do last/ongoing).**
Or strictly top-to-bottom as listed. Your call.

---

# 🧪 APPENDIX: The Becker Layer — REFERENCE ONLY, DO NOT APPLY YET

> **STATUS: NOT ACTIVE.** This layer is parked for a *later* experimentation phase.
> **Decision (2026-06-28):** Build the site with the 6 moves above *as written first*, ship it, and live with how it looks and feels. **Only after that** will we selectively trial individual Becker tactics to see which we like and which we reject. Nothing in this appendix should be implemented during the first pass.
>
> Think of this as an A/B fork we may explore later — not part of the current build.

## What it is
The **Becker Psychological UX & Copywriting Methodology** — a direct-response *sales funnel* framework (adapted from Alex Becker's ad/landing-page conversion strategy). It optimizes for a cold, skeptical, impulse visitor arriving from a paid ad who must convert in one session.

## Why it's separate from the main plan
The 6 moves above follow the **kickflip model**: a high-status agency brand for a *considered* B2B buyer (a founder choosing a studio) who converts over days via a conversation. Becker assumes the opposite visitor. The two optimize for different people, so we test them sequentially, not at once.

**How kickflip itself scored against Becker (~2.5 / 7):** strong on Proof Avalanche and Simplicity; deliberately skips segmentation, risk-reversal, urgency, and objection-sequencing because hard-funnel tactics would read as desperate for their audience.

## The 7 Becker tactics, mapped to our 6 moves (for the LATER phase)

1. **One-Idea Rule** → *upgrade to Move 6 (Hero).* Instead of stating 3 services, lead with the single most painful client problem (e.g. "Stuck with a site that doesn't convert?"). **Trial later.**
2. **15-Second Anticipatory Dialogue** → *new structural overlay.* Sequence every bold claim as claim → likely doubt → immediate proof. Restructures the whole scroll into an objection-handling rhythm. **Trial later.**
3. **Proof Avalanche (multi-format)** → *upgrade to Move 5 (Proof).* Don't just add testimonials; stack proof in ≥3 formats (aggregate stat + peer quote + case-study link) and consider a dedicated, bottomless Results page. **Trial later.**
4. **Fourth-Grade Simplicity + Rule of Threes** → *upgrade to Move 5 (Services).* Force services into exactly **3 pillars** with short lists (kickflip's 4 pillars × 8 keywords violates this). Chunky bold copy, optional 5-sec result GIF instead of hero video. **Trial later.**
5. **Sniper Segmentation (Avatar Routing)** → *new section.* Add "Are you E-commerce? / SaaS? / B2B?" pathways that route to bespoke copy + case studies. High effort. **Trial later, maybe skip for our context.**
6. **Remove the Catch & Friction** → *new element.* Soft risk-reversal that stays classy (e.g. "Free 30-min consult, no obligation"); minimize contact-form fields. **Trial later — keep tasteful.**
7. **Cost-of-Inaction Close (loss aversion)** → *new element.* Frame the close around the pain of waiting, NOT fake countdown timers. **Trial later — optional, only if it stays classy.**

## Explicitly NOT doing (in any phase, per our brand)
- ❌ Fake countdown timers / false scarcity (Becker himself forbids this too).
- ❌ Aggressive/sleazy guarantee language ("double-your-money-back").
- ❌ Anything that makes the studio read as a desperate funnel rather than a confident team.

## Becker self-check (for the later experimentation phase only)
- [ ] Is there only ONE main idea in the hero?
- [ ] Is there proof immediately following every bold claim?
- [ ] Is proof presented in ≥3 formats?
- [ ] Are features grouped in threes?
- [ ] Is the language fourth-grade simple?
- [ ] Is there a self-segmentation pathway per avatar?
- [ ] Is fake scarcity avoided in favor of Cost-of-Inaction framing?

> **Reminder:** None of the above is part of the first build. Finish the 6 moves, evaluate look & feel, then return here to cherry-pick.
