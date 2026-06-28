# VakInvest 86 — WordPress Theme

Custom WordPress theme for **ВАК ИНВЕСТ 86 ЕООД**, a Bulgarian construction company. Located at `vakinvest-theme/`.

## Stack

- WordPress (classic theme, no block editor dependency)
- PHP 7.4+
- Vanilla CSS (no preprocessor) and vanilla JS (no framework)
- Inter + Montserrat from Google Fonts
- Custom Post Type `vi_project` for the portfolio (taxonomy `project_category`)
- Customizer fields for company data, hero slides, service photos, certificates

## Brand

| Token | Value |
|---|---|
| White | `#FEFFFF` |
| Navy | `#0F2748` |
| Teal | `#1F7E98` |
| Heading font | Montserrat |
| Body font | Inter |

Buttons: teal background, white text, slight border-radius.
Section headings: navy, uppercase, letter-spaced, with teal underline.

## Page map

| URL | Template | Status |
|---|---|---|
| `/` | `front-page.php` | done — 8 sections per spec |
| `/za-nas/` | `templates/page-za-nas.php` | done — sidebar + Екип/Администрация/Специалисти |
| `/uslugi/` | `templates/page-uslugi.php` | done — 5-card grid |
| `/uslugi/proektirane/` | `templates/page-proektirane.php` | done — 2-col + sidebar |
| `/uslugi/el-vik/` | `templates/page-el-vik.php` | done — 2-col + sidebar |
| `/uslugi/dovarshitelni/` | `templates/page-dovarshitelni.php` | done — 2-col + sidebar |
| `/uslugi/izolacii/` | `templates/page-izolacii.php` | done — 2-col + sidebar |
| `/uslugi/patno/` | `templates/page-patno.php` | done — 2-col + sidebar |
| `/mehanizaciya/` | `templates/page-mehanizaciya.php` | done — all 17 items |
| `/proekti/` | `archive-project.php` + `templates/page-proekti.php` | done (CPT archive) |
| project single | `single-project.php` | done — gallery + lightbox |
| `/sertifikati/` | `templates/page-sertifikati.php` | done — Сертификати + Удостоверения split |
| `/klienti/` | `templates/page-klienti.php` | done — logo grid (testimonials extra) |
| `/kontakti/` | `templates/page-kontakti.php` | done — form + Maps + GDPR + math captcha |
| `/obshti-uslovia/` | `templates/page-obshti-uslovia.php` | done — placeholder legal text |
| `/politika-za-poveritelnost/` | `templates/page-politika.php` | done — placeholder privacy text |

## Global elements

- **Top bar** (navy): phone(s) + address (left) · email + "Изпрати запитване" CTA (right). Mobile hides email.
- **Main nav** (sticky): logo + 8-item menu with УСЛУГИ dropdown (5 sub-items). Hamburger on mobile.
- **Footer** (navy): logo + 3 columns (Услуги / За нас / Контакти) + bottom copyright.
- **Cookie consent banner**: bottom-fixed, navy. Dismiss via "Разбрах". Persists in `localStorage` (`vi_cookie_accepted`), with `document.cookie` fallback.
- **Back-to-top** button.
- **Lightbox overlay** (re-used by single-project gallery and certificate pages).

## Key files

```
vakinvest-theme/
├── functions.php                # loads inc/* files
├── header.php                   # top bar + nav + mobile nav
├── footer.php                   # 3-col footer + cookie banner + lightbox
├── front-page.php               # homepage (8 sections, hero slider)
├── archive-project.php          # /proekti/ portfolio grid
├── single-project.php           # individual project page
├── page.php / index.php / 404.php
├── style.css                    # ~2700 lines, all CSS
├── inc/
│   ├── theme-setup.php          # supports, customizer, breadcrumb, services-sidebar helper, vakinvest_icon()
│   ├── enqueue.php              # fonts, styles, scripts
│   ├── cpt-projects.php         # vi_project CPT + taxonomy + meta boxes (year/location/area/gallery)
│   ├── walker-nav.php           # custom nav walker (dropdown arrows)
│   ├── contact-form-handler.php # POST handler, nonce, GDPR, math captcha, mail()
│   └── setup-pages.php          # auto-creates pages on theme activation
├── templates/
│   └── page-*.php               # one per spec page (15 total)
└── assets/
    └── js/
        ├── main.js              # nav, hamburger, sticky, hero-slider, cookie, lightbox
        └── portfolio-filter.js  # CPT archive filter
```

## Reusable helpers

- `vi_opt($key, $fallback)` — Customizer value with fallback. Used everywhere for company data, hero, photos.
- `vakinvest_icon($name)` — inline SVG icon set (~30 icons: building, bolt, brush, shield, road, gear, truck, crane, excavator, roller, mixer, wrench, helmet, compass, leaf, safety-vest, document, trophy, clock, handshake, spark, phone, mail, pin, check, arrow-right, calendar, ruler).
- `vakinvest_breadcrumb()` — automatic breadcrumb in page-banner.
- `vakinvest_services_sidebar($current_slug)` — renders the navy services sidebar widget on service pages and About.

## Customizer fields (Appearance → Customize)

**Данни на фирмата**: `company_phone`, `company_phone2`, `company_email`, `company_address`, `company_hours`, `company_map`, `company_facebook`.

**Начало — Hero**: `hero_title`, `hero_subtitle`, `hero_image`, `hero_btn1_text/url`, `hero_btn2_text/url`, plus `hero_slide2_*` and `hero_slide3_*` (currently fall back to slide 1 if not set).

**Service photos** (referenced in templates, add Customizer controls when client provides images):
`service_proektirane_photo1/2`, `service_el_vik_photo1/2`, `service_dovarshitelni_photo1/2`, `service_izolacii_photo1/2`, `service_patno_photo1/2`, `home_service_<slug>_image`, `about_hero_photo`.

**Certificate images**:
`cert_iso9001_image`, `cert_iso14001_image`, `cert_iso45001_image`, `udost_grupa1_image` … `udost_grupa5_image`.

**Home about copy**: `home_about_p1`, `home_about_p2`.

> All these read via `vi_opt()` — they don't need Customizer controls registered to function (they fall back to defaults), but adding controls in `inc/theme-setup.php` would let the client edit them in the UI.

## Activation / setup

1. Upload `vakinvest-theme/` to `wp-content/themes/`.
2. Activate in **Appearance → Themes** — `vakinvest_flush_rewrites()` runs (CPT permalinks).
3. `inc/setup-pages.php` auto-creates the 15 pages on activation and assigns each its template.
4. **Settings → Reading**: set "Front page displays" to a static page → choose `Начало`.
5. **Appearance → Menus**: create a menu with all 8 top-level items, assign to "Главно меню" location. Optionally create separate menus for "Footer — Услуги" and "Footer — За нас".
6. **Appearance → Customize**: fill in company data, upload hero images, etc.
7. **Проекти** custom post type appears in the WP Admin sidebar — add projects there.

## Change log

### 2026-05-03 — Spec alignment pass

Audited theme against the full client spec. Implemented gaps and divergences:

- **Header**: added "Изпрати запитване" CTA to top-bar right side.
- **Footer**: added cookie consent banner ("Този сайт използва бисквитки." + Научи повече link + Разбрах button).
- **Homepage**: rewritten to spec's 8-section structure — hero slider (was static), 5-service grid (was 6, with Mehanizatsia incorrectly included), NEW Four Value Icons row, centered ПОВЕЧЕ ЗА НАС, NEW Сертификати teaser row, NEW Механизация teaser row, optional Новини (shows only if posts exist), two stacked CTA banners (was a single CTA).
- **Услуги (overview)**: changed from alternating 2-col list to 5-card grid, no sidebar.
- **All 5 service pages**: converted single-column to 2-col with sticky right sidebar (Услуги widget, current-page highlight, "Поискайте оферта" CTA). Spec'd bullet lists. Added `vakinvest_services_sidebar()` helper.
- **За нас**: added Екип / Администрация / Специалисти subsections with team-card grid (silhouette placeholders) + right sidebar + specialist bullet list + asterisk notes.
- **Механизация**: expanded from 12 to all 17 spec'd items.
- **Сертификати**: split into "Сертификати" (portrait grid, ISO 9001/14001/45001) and "Удостоверения" (landscape grid, Камара 1–5) with lightbox.
- **CSS**: appended ~770 lines covering all new components.
- **JS**: hero slider (autoplay/arrows/dots/keyboard/swipe), cookie banner (localStorage), certificate lightbox (grouped).

### 2026-05-02

- Project portfolio styling implemented (memory ID 212).
- Restyle of project pages with provided color scheme (memory ID 194).
- Page templates created for all spec pages.

### 2026-05-01

- Initial WordPress theme structure created — `header.php`, `footer.php`, `front-page.php`, all `templates/page-*.php`, `inc/cpt-projects.php`, `inc/contact-form-handler.php`, `inc/walker-nav.php`, `inc/enqueue.php`, `inc/theme-setup.php`, `inc/setup-pages.php`, `archive-project.php`, `single-project.php`, `404.php`, `page.php`, `index.php`.
- JavaScript: `assets/js/main.js`, `assets/js/portfolio-filter.js`.
- Color scheme and typography applied.

## Outstanding / future work

- **Real assets**: hero slide photos, service page photos, certificate scans, team member photos, client logos (currently placeholders / silhouettes / monograms).
- **Page-banner background photos**: non-homepage banners currently use a CSS gradient. Add Customizer image controls per page or a single shared banner image when assets are available.
- **Customizer controls** for the new fields used by templates (`service_*_photo*`, `cert_*_image`, `udost_grupa*_image`, `home_service_<slug>_image`, `home_about_p1/2`, `hero_slide2/3_*`, `about_hero_photo`) — values fall back to defaults today, but the client can't edit them from the admin UI yet.
- **Real client copy** for: home about paragraphs, За нас body, team member names + roles, legal pages (Общи условия, Политика за поверителност).
- **Real client list**: `templates/page-klienti.php` currently uses placeholder names with monograms.
- **Real management photos** for the Екип / Администрация / Специалисти cards.
- **Cookie compliance plugin**: spec mentions Complianz or CookieYes for full GDPR compliance (the in-theme banner is a basic notice, not category-granular consent management).
- **Smoke test in WP**: PHP isn't installed locally, so syntax was only verified via brace/paren balance. Worth running through `php -l` or activating in a local WP install.
- **News (Section 7)**: currently auto-hidden if no posts exist; if the client wants this section gone permanently, remove the block from `front-page.php`.
