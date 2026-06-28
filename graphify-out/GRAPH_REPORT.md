# Graph Report - .  (2026-06-22)

## Corpus Check
- 86 files · ~61,848 words
- Verdict: corpus is large enough that graph structure adds value.

## Summary
- 405 nodes · 461 edges · 58 communities (51 shown, 7 thin omitted)
- Extraction: 92% EXTRACTED · 8% INFERRED · 0% AMBIGUOUS · INFERRED: 36 edges (avg confidence: 0.8)
- Token cost: 150,265 input · 0 output

## Community Hubs (Navigation)
- [[_COMMUNITY_Makros-Psari Function Reference Doc|Makros-Psari Function Reference Doc]]
- [[_COMMUNITY_Makros Tech-Debt Audit & Secrets|Makros Tech-Debt Audit & Secrets]]
- [[_COMMUNITY_Makros WooCommerce Plugin Backend|Makros WooCommerce Plugin Backend]]
- [[_COMMUNITY_Portfolio Homepage & Project Cards|Portfolio Homepage & Project Cards]]
- [[_COMMUNITY_Makros React Components & i18n|Makros React Components & i18n]]
- [[_COMMUNITY_Notes App (Vanilla JS)|Notes App (Vanilla JS)]]
- [[_COMMUNITY_VakInvest Theme & Reference Pages|VakInvest Theme & Reference Pages]]
- [[_COMMUNITY_URL Shortener Package Config|URL Shortener Package Config]]
- [[_COMMUNITY_VakInvest Page Setup & Theme Init|VakInvest Page Setup & Theme Init]]
- [[_COMMUNITY_VakInvest Lightbox JS|VakInvest Lightbox JS]]
- [[_COMMUNITY_Makros PricingPlan Data|Makros Pricing/Plan Data]]
- [[_COMMUNITY_Stripe Homepage Clone|Stripe Homepage Clone]]
- [[_COMMUNITY_URL Shortener Mongo Routes|URL Shortener Mongo Routes]]
- [[_COMMUNITY_URL Shortener Server & Firebase|URL Shortener Server & Firebase]]
- [[_COMMUNITY_Weather App|Weather App]]
- [[_COMMUNITY_VakInvest Nav Walker|VakInvest Nav Walker]]
- [[_COMMUNITY_Audio Sync Core Logic|Audio Sync Core Logic]]
- [[_COMMUNITY_Makros Hours Settings|Makros Hours Settings]]
- [[_COMMUNITY_Audio Sync Font Tools|Audio Sync Font Tools]]
- [[_COMMUNITY_Color Flipper App|Color Flipper App]]
- [[_COMMUNITY_Color Flipper Hex Page|Color Flipper Hex Page]]
- [[_COMMUNITY_Dark Mode  Notes App Entry|Dark Mode / Notes App Entry]]
- [[_COMMUNITY_URL Shortener Public Client|URL Shortener Public Client]]
- [[_COMMUNITY_Dark Mode App Logic|Dark Mode App Logic]]
- [[_COMMUNITY_VakInvest Mobile Nav JS|VakInvest Mobile Nav JS]]
- [[_COMMUNITY_Audio Sync App Entry|Audio Sync App Entry]]
- [[_COMMUNITY_Audio Sync Package Deps|Audio Sync Package Deps]]
- [[_COMMUNITY_Color Flipper  Counter Pages|Color Flipper / Counter Pages]]
- [[_COMMUNITY_Counter App|Counter App]]
- [[_COMMUNITY_Makros App Root|Makros App Root]]
- [[_COMMUNITY_Dark Mode Article Data|Dark Mode Article Data]]

## God Nodes (most connected - your core abstractions)
1. `t()` - 15 edges
2. `Good Studio homepage (index.html)` - 15 edges
3. `VakInvest 86 WordPress theme project` - 12 edges
4. `makros_build_payload()` - 10 edges
5. `makros_wc_sync_plan()` - 9 edges
6. `Makros Tech Debt Audit` - 9 edges
7. `Makros frontend index.html` - 8 edges
8. `VakInvest Начало (Homepage) reference page` - 8 edges
9. `App` - 7 edges
10. `notesView` - 7 edges

## Surprising Connections (you probably didn't know these)
- `Front-end Developer role (gaming entertainment, React/TS/Redux)` --semantically_similar_to--> `Web Development service`  [INFERRED] [semantically similar]
  assets/docs/resume.pdf → README.md
- `Stripe homepage clone` --semantically_similar_to--> `Good Studio homepage (index.html)`  [INFERRED] [semantically similar]
  projects/stripe/index.html → index.html
- `Makros project card` --references--> `Makros frontend index.html`  [EXTRACTED]
  index.html → projects/makros/index.html
- `VakInvest 86 project card` --references--> `VakInvest Начало (Homepage) reference page`  [EXTRACTED]
  index.html → projects/vakinvest/reference/Homepage.html
- `makros_seed()` --calls--> `makros_flush_cache()`  [INFERRED]
  projects/makros/backend/makros-core/includes/seed.php → projects/makros/backend/makros-core/makros-core.php

## Import Cycles
- None detected.

## Hyperedges (group relationships)
- **Makros no-build script load order chain (i18n -> data -> components -> app)** — tech_debt_audit_i18n_jsx, tech_debt_audit_data_jsx, tech_debt_audit_components_jsx, tech_debt_audit_app_jsx [EXTRACTED 1.00]
- **VakInvest reference pages sharing one brand/CSS design system** — homepage_html_homepage_page, about_html_about_page, contacts_html_contacts_page, vakinvest_project_brand_tokens [INFERRED 0.85]
- **Good Studio portfolio toy-app demos sharing the same single-page vanilla JS pattern** — color_flipper_index_simple_page, counter_index_counter_app, dark_mode_index_dark_mode_app, weather_app_index_weather_dashboard [INFERRED 0.75]

## Communities (58 total, 7 thin omitted)

### Community 0 - "Makros-Psari Function Reference Doc"
Cohesion: 0.07
Nodes (25): psari_build_notification_message(), psari_checkout_quarter_js(), psari_customize_checkout_fields(), psari_display_quarter_admin(), psari_distance_based_shipping(), psari_format_scheduled_date(), psari_get_notification_config(), psari_get_restaurant_coords() (+17 more)

### Community 1 - "Makros Tech-Debt Audit & Secrets"
Cohesion: 0.08
Nodes (32): Advanced Custom Fields PRO, Deep-link checkout contract (makros_subscribe), window.MAKROS_API global, Makros Core WordPress plugin, meal_plan custom post type, GET /wp-json/makros/v1/plans REST endpoint, One-click seeder (wp makros seed), WooCommerce variable product + Subscriptions sync (+24 more)

### Community 2 - "Makros WooCommerce Plugin Backend"
Cohesion: 0.14
Nodes (25): makros_find_plan_by_track(), makros_seed(), makros_seed_data(), makros_handle_subscribe(), makros_plan_weekly_price(), makros_variation_price(), makros_wc_active(), makros_wc_attributes() (+17 more)

### Community 3 - "Portfolio Homepage & Project Cards"
Cohesion: 0.08
Nodes (27): Customer Experience Associate role at Crypto.com, Mario Ushev CV (PDF), Service Data Analyst role at LDC - Louis Dreyfus Company, Software Analyst role at C3i Solutions, Front-end Developer role (gaming entertainment, React/TS/Redux), Mario Ushev Resume (PDF, frontend-focused), Service Data Analyst role at LDC - Louis Dreyfus Company (resume), mclimate / HClimate Dashboard app shell (+19 more)

### Community 4 - "Makros React Components & i18n"
Cohesion: 0.14
Nodes (20): About(), CartDrawer(), DeliveryBlock(), Footer(), Hero(), HowItWorks(), Icons, Location() (+12 more)

### Community 5 - "Notes App (Vanilla JS)"
Cohesion: 0.14
Nodes (5): App, app, root, notesAPI, notesView

### Community 6 - "VakInvest Theme & Reference Pages"
Cohesion: 0.12
Nodes (21): VakInvest За нас (About) reference page, Team section (Екип/Администрация/Специалисти), Company history timeline (1994-2024), Contact form client-side validation logic, VakInvest Контакти (Contacts) reference page, Math captcha anti-spam check, SVG fake-map widget with zoom/pin, Certificates/Сертификати section (ISO seals) (+13 more)

### Community 7 - "URL Shortener Package Config"
Cohesion: 0.11
Nodes (17): author, dependencies, body-parser, concurrently, express, firebase, json-server, mongodb (+9 more)

### Community 8 - "VakInvest Page Setup & Theme Init"
Cohesion: 0.15
Nodes (3): vakinvest_create_all_pages(), vakinvest_setup_pages_page(), vakinvest_auto_bootstrap()

### Community 9 - "VakInvest Lightbox JS"
Cohesion: 0.18
Nodes (3): restart(), show(), stop()

### Community 10 - "Makros Pricing/Plan Data"
Cohesion: 0.15
Nodes (9): BILLING, DELIVERY_ZONES, DURATIONS, GENDERS, HOURS, MENUS, PRICING, TESTIMONIALS (+1 more)

### Community 11 - "Stripe Homepage Clone"
Cohesion: 0.20
Nodes (9): closeBtn, hero, linkBtns, nav, sidebar, sidebarWrapper, submenu, toggleBtn (+1 more)

### Community 12 - "URL Shortener Mongo Routes"
Cohesion: 0.22
Nodes (6): mongoose, Url, urlSchema, express, router, Url

### Community 13 - "URL Shortener Server & Firebase"
Cohesion: 0.22
Nodes (7): app, db, express, shortid, db, firebase, firebaseConfig

### Community 15 - "Weather App"
Cohesion: 0.29
Nodes (5): card, cityInput, displayWeatherInfo(), getWeatherEmoji(), weatherForm

### Community 18 - "Makros Hours Settings"
Cohesion: 0.53
Nodes (4): makros_default_hours(), makros_get_hours(), makros_render_hours_page(), makros_save_hours()

### Community 19 - "Audio Sync Font Tools"
Cohesion: 0.60
Nodes (4): checkFontSimilarity(), compareFonts(), scrapeFonts(), urlsToCheck

### Community 20 - "Color Flipper App"
Cohesion: 0.40
Nodes (3): btn, color, colors

### Community 21 - "Color Flipper Hex Page"
Cohesion: 0.40
Nodes (3): btn, color, hex

### Community 22 - "Dark Mode / Notes App Entry"
Cohesion: 0.50
Nodes (5): Dark Mode app page, moment.js (CDN), Dark Mode build plan, Dark mode toggle pattern (html class toggle), Notes App (Personal Workspace)

### Community 23 - "URL Shortener Public Client"
Cohesion: 0.50
Nodes (4): db, firebaseConfig, getRandomString(), shortenUrl()

### Community 24 - "Dark Mode App Logic"
Cohesion: 0.50
Nodes (3): articlesContainer, articlesData, toggleBtn

### Community 27 - "Audio Sync App Entry"
Cohesion: 0.67
Nodes (3): Audio Sync app page, Lucide icon library, Web Audio API

### Community 29 - "Color Flipper / Counter Pages"
Cohesion: 0.67
Nodes (3): Color Flipper hex page, Color Flipper simple page, Counter app page

## Knowledge Gaps
- **117 isolated node(s):** `hamburger`, `navMenu`, `style`, `urlsToCheck`, `@radix-ui/react-slot` (+112 more)
  These have ≤1 connection - possible missing edges or undocumented components.
- **7 thin communities (<3 nodes) omitted from report** — run `graphify query` to explore isolated nodes.

## Suggested Questions
_Questions this graph is uniquely positioned to answer:_

- **Why does `Good Studio homepage (index.html)` connect `Portfolio Homepage & Project Cards` to `Makros Tech-Debt Audit & Secrets`, `VakInvest Theme & Reference Pages`?**
  _High betweenness centrality (0.028) - this node is a cross-community bridge._
- **Why does `Makros project card` connect `Makros Tech-Debt Audit & Secrets` to `Portfolio Homepage & Project Cards`?**
  _High betweenness centrality (0.018) - this node is a cross-community bridge._
- **Are the 14 inferred relationships involving `t()` (e.g. with `About()` and `CartDrawer()`) actually correct?**
  _`t()` has 14 INFERRED edges - model-reasoned connections that need verification._
- **Are the 2 inferred relationships involving `VakInvest 86 WordPress theme project` (e.g. with `Contact form client-side validation logic` and `Certificates/Сертификати section (ISO seals)`) actually correct?**
  _`VakInvest 86 WordPress theme project` has 2 INFERRED edges - model-reasoned connections that need verification._
- **Are the 2 inferred relationships involving `makros_wc_sync_plan()` (e.g. with `makros_seed()` and `makros_field()`) actually correct?**
  _`makros_wc_sync_plan()` has 2 INFERRED edges - model-reasoned connections that need verification._
- **What connects `hamburger`, `navMenu`, `style` to the rest of the system?**
  _118 weakly-connected nodes found - possible documentation gaps or missing edges._
- **Should `Makros-Psari Function Reference Doc` be split into smaller, more focused modules?**
  _Cohesion score 0.06767676767676768 - nodes in this community are weakly interconnected._