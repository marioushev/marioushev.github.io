<?php
defined('ABSPATH') || exit;

function vakinvest_setup()
{
    load_theme_textdomain('vakinvest', get_template_directory() . '/languages');

    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('automatic-feed-links');
    add_theme_support('html5', [
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ]);
    add_theme_support('custom-logo', [
        'height' => 60,
        'width' => 220,
        'flex-height' => true,
        'flex-width' => true,
    ]);
    add_theme_support('customize-selective-refresh-widgets');

    add_image_size('project-thumb', 600, 400, true);
    add_image_size('project-large', 1200, 800, false);
    add_image_size('hero-full', 1920, 900, true);
    add_image_size('teaser-card', 800, 520, true);

    register_nav_menus([
        'primary' => __('Главно меню', 'vakinvest'),
        'footer-services' => __('Footer — Услуги', 'vakinvest'),
        'footer-about' => __('Footer — За нас', 'vakinvest'),
    ]);
}
add_action('after_setup_theme', 'vakinvest_setup');

/* ── Customizer ────────────────────────────────────── */
function vakinvest_customize_register($wp_customize)
{
    /* Company info */
    $wp_customize->add_section('vakinvest_company', [
        'title' => 'Данни на фирмата',
        'priority' => 30,
    ]);

    $fields = [
        'company_phone' => ['label' => 'Телефон', 'default' => '+359 888 000 000'],
        'company_phone2' => ['label' => 'Телефон 2', 'default' => ''],
        'company_email' => ['label' => 'E-mail', 'default' => 'vak-invest86@abv.bg'],
        'company_address' => ['label' => 'Адрес', 'default' => 'гр. София, бул. „Пример" №1'],
        'company_hours' => ['label' => 'Работно време', 'default' => 'Пон – Пет: 09:00 – 18:00'],
        'company_map' => ['label' => 'Google Maps URL (embed)', 'default' => ''],
        'company_facebook' => ['label' => 'Facebook URL', 'default' => ''],
    ];

    foreach ($fields as $id => $args) {
        $wp_customize->add_setting($id, [
            'default' => $args['default'],
            'sanitize_callback' => 'sanitize_text_field',
        ]);
        $wp_customize->add_control($id, [
            'label' => $args['label'],
            'section' => 'vakinvest_company',
            'type' => 'text',
        ]);
    }

    /* Hero */
    $wp_customize->add_section('vakinvest_hero', [
        'title' => 'Начало — Hero секция',
        'priority' => 31,
    ]);
    $wp_customize->add_setting('hero_title', [
        'default' => 'ВАК ИНВЕСТ 86',
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control('hero_title', [
        'label' => 'Заглавие в Hero',
        'section' => 'vakinvest_hero',
        'type' => 'text',
    ]);
    $wp_customize->add_setting('hero_subtitle', [
        'default' => 'дизайн & строителство',
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control('hero_subtitle', [
        'label' => 'Подзаглавие',
        'section' => 'vakinvest_hero',
        'type' => 'text',
    ]);
    $wp_customize->add_setting('hero_image', [
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ]);
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'hero_image', [
        'label' => 'Hero изображение',
        'section' => 'vakinvest_hero',
    ]));
    $wp_customize->add_setting('hero_btn1_text', ['default' => 'Нашите проекти', 'sanitize_callback' => 'sanitize_text_field']);
    $wp_customize->add_control('hero_btn1_text', ['label' => 'Бутон 1 — текст', 'section' => 'vakinvest_hero', 'type' => 'text']);
    $wp_customize->add_setting('hero_btn1_url', ['default' => '/proekti/', 'sanitize_callback' => 'esc_url_raw']);
    $wp_customize->add_control('hero_btn1_url', ['label' => 'Бутон 1 — URL', 'section' => 'vakinvest_hero', 'type' => 'text']);
    $wp_customize->add_setting('hero_btn2_text', ['default' => 'Поискайте оферта', 'sanitize_callback' => 'sanitize_text_field']);
    $wp_customize->add_control('hero_btn2_text', ['label' => 'Бутон 2 — текст', 'section' => 'vakinvest_hero', 'type' => 'text']);
    $wp_customize->add_setting('hero_btn2_url', ['default' => '/kontakti/', 'sanitize_callback' => 'esc_url_raw']);
    $wp_customize->add_control('hero_btn2_url', ['label' => 'Бутон 2 — URL', 'section' => 'vakinvest_hero', 'type' => 'text']);
}
add_action('customize_register', 'vakinvest_customize_register');

/* ── Helper: get customizer option with fallback ───── */
function vi_opt($key, $fallback = '')
{
    return get_theme_mod($key, $fallback);
}

/* ── One-time bootstrap: pretty permalinks + create all pages + set front page.
 * Runs once on first request after the theme is activated. Idempotent.
 * ───────────────────────────────────────────────────── */
function vakinvest_auto_bootstrap()
{
    if (wp_doing_ajax() || wp_doing_cron() || (defined('REST_REQUEST') && REST_REQUEST))
        return;
    if (get_option('vi_bootstrap_done') === '1')
        return;

    /* Pretty permalinks so /uslugi/, /za-nas/ etc. resolve */
    if (get_option('permalink_structure') !== '/%postname%/') {
        update_option('permalink_structure', '/%postname%/');
    }

    /* Create all pages with their page templates */
    if (function_exists('vakinvest_create_all_pages')) {
        vakinvest_create_all_pages();
    }

    /* Set front page to "Начало" */
    $home = get_posts([
        'post_type' => 'page',
        'name' => 'nachalo',
        'post_parent' => 0,
        'posts_per_page' => 1,
    ]);
    if ($home) {
        update_option('show_on_front', 'page');
        update_option('page_on_front', $home[0]->ID);
    }

    flush_rewrite_rules(false);
    update_option('vi_bootstrap_done', '1');
}
add_action('init', 'vakinvest_auto_bootstrap', 99);

/* Re-run bootstrap whenever the theme is (re)activated */
function vakinvest_after_switch_theme()
{
    delete_option('vi_bootstrap_done');
}
add_action('after_switch_theme', 'vakinvest_after_switch_theme');

/* ── Helper: breadcrumb ─────────────────────────────── */
function vakinvest_breadcrumb()
{
    $separator = '<span class="sep">›</span>';
    echo '<nav class="breadcrumb" aria-label="Breadcrumb">';
    echo '<a href="' . esc_url(home_url('/')) . '">Начало</a>';
    echo $separator;

    if (is_singular('vi_project')) {
        echo '<a href="' . esc_url(get_post_type_archive_link('vi_project')) . '">Проекти</a>';
        echo $separator;
        echo '<span class="current">' . esc_html(get_the_title()) . '</span>';
    } elseif (is_post_type_archive('vi_project')) {
        echo '<span class="current">Изпълнени проекти</span>';
    } elseif (is_page()) {
        if ($parent = wp_get_post_parent_id(get_the_ID())) {
            echo '<a href="' . esc_url(get_permalink($parent)) . '">' . esc_html(get_the_title($parent)) . '</a>';
            echo $separator;
        }
        echo '<span class="current">' . esc_html(get_the_title()) . '</span>';
    } else {
        echo '<span class="current">' . esc_html(get_the_title()) . '</span>';
    }
    echo '</nav>';
}

/* ── Helper: services sidebar widget (used on all service pages) ── */
function vakinvest_services_sidebar($current_slug = '')
{
    $services = [
        'proektirane' => 'Проектиране и строителство',
        'el-vik' => 'Ел. и ВиК инсталации',
        'dovarshitelni' => 'Довършителни работи',
        'izolacii' => 'Изолации',
        'patno' => 'Пътно строителство',
    ];
    echo '<aside class="services-sidebar" aria-label="Услуги">';
    echo '<div class="services-sidebar-box">';
    echo '<h3 class="services-sidebar-title">Услуги</h3>';
    echo '<ul class="services-sidebar-list">';
    foreach ($services as $slug => $label) {
        $is_current = ($slug === $current_slug);
        echo '<li' . ($is_current ? ' class="is-current"' : '') . '>';
        echo '<a href="' . esc_url(home_url('/uslugi/' . $slug . '/')) . '">';
        echo esc_html($label);
        echo '<span aria-hidden="true">›</span>';
        echo '</a>';
        echo '</li>';
    }
    echo '</ul>';
    echo '<div class="services-sidebar-cta">';
    echo '<a href="' . esc_url(home_url('/kontakti/')) . '" class="btn btn-primary">Поискайте оферта</a>';
    echo '</div>';
    echo '</div>';
    echo '</aside>';
}

/* ── Flush rewrite rules on theme switch ────────────── */
function vakinvest_flush_rewrites()
{
    flush_rewrite_rules();
}
add_action('after_switch_theme', 'vakinvest_flush_rewrites');

/* ── Helper: inline SVG icon set ─────────────────────── */
function vakinvest_icon($name, $class = '')
{
    $icons = [
        'building' => '<path d="M3 21V5a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v16M13 21V9a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v12M3 21h18M7 7h2M7 11h2M7 15h2M16 11h2M16 15h2"/>',
        'bolt' => '<path d="M13 2 4 14h7l-1 8 9-12h-7l1-8z"/>',
        'brush' => '<path d="M9 11l-6 10h7l3-5M14 4l6 6-9 9-6-6 9-9zM12 6l6 6"/>',
        'shield' => '<path d="M12 2 4 6v6c0 5 3.5 9 8 10 4.5-1 8-5 8-10V6l-8-4zM9 12l2 2 4-4"/>',
        'road' => '<path d="M4 22 8 2h8l4 20M12 2v4M12 10v4M12 18v4"/>',
        'gear' => '<path d="M12 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6zM19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 1 1-2.83 2.83l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-4 0v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 1 1-2.83-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1 0-4h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 1 1 2.83-2.83l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 4 0v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 1 1 2.83 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 0 4h-.09a1.65 1.65 0 0 0-1.51 1z"/>',
        'truck' => '<path d="M1 3h15v13H1zM16 8h4l3 3v5h-7M5.5 21a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5zM18.5 21a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5z"/>',
        'crane' => '<path d="M2 20h20M5 20V8L20 4M20 4v6M5 8h15M9 20v-6h6v6"/>',
        'excavator' => '<path d="M3 18h18M5 18v-4h6l4-5 4 1v8M9 18v-4M15 9V5h4M3 14a2 2 0 0 1 2-2"/>',
        'roller' => '<path d="M2 17a4 4 0 1 0 8 0 4 4 0 0 0-8 0zM10 13l4-2 6 4M14 11V7h6v4M20 17h-6"/>',
        'mixer' => '<path d="M2 12h6l-2 8H4l-2-8zM10 4l4 8-4 8M14 4h8l-2 8h-4M14 4l-4 8"/>',
        'wrench' => '<path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/>',
        'helmet' => '<path d="M2 18h20v3H2zM4 18v-4a8 8 0 0 1 16 0v4M9 6V3h6v3"/>',
        'compass' => '<circle cx="12" cy="12" r="10"/><path d="M16 8l-2 6-6 2 2-6 6-2z"/>',
        'leaf' => '<path d="M3 21c0-9 6-15 18-15-1 8-7 14-15 15-1 0-2-1-3-2zM3 21c4-7 9-12 16-13"/>',
        'safety-vest' => '<path d="M8 4h8l-1 4 5 3v9H4v-9l5-3-1-4zM12 8v13"/>',
        'document' => '<path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8l-6-6zM14 2v6h6M9 13h6M9 17h6"/>',
        'trophy' => '<path d="M6 9H4a2 2 0 1 1 0-4h2M18 9h2a2 2 0 0 0 0-4h-2M6 5h12v4a6 6 0 1 1-12 0V5zM10 17h4M9 21h6M12 17v4"/>',
        'clock' => '<circle cx="12" cy="12" r="10"/><path d="M12 7v5l3 2"/>',
        'handshake' => '<path d="M11 17l2 2 4-4M2 12l4-4 4 4-4 4-4-4zM14 12l4-4 4 4-4 4-4-4zM10 8l4-4M14 16l-4 4"/>',
        'spark' => '<path d="M12 3v3M12 18v3M3 12h3M18 12h3M5.6 5.6l2.1 2.1M16.3 16.3l2.1 2.1M5.6 18.4l2.1-2.1M16.3 7.7l2.1-2.1M12 8a4 4 0 1 1 0 8 4 4 0 0 1 0-8z"/>',
        'phone' => '<path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/>',
        'mail' => '<path d="M4 4h16a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2zM22 6l-10 7L2 6"/>',
        'pin' => '<path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 1 1 18 0z"/><circle cx="12" cy="10" r="3"/>',
        'check' => '<path d="M20 6 9 17l-5-5"/>',
        'arrow-right' => '<path d="M5 12h14M12 5l7 7-7 7"/>',
        'calendar' => '<rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/>',
        'ruler' => '<path d="M2 12 12 2l10 10-10 10L2 12zM6 12l2 2M10 8l2 2M14 4l2 2"/>',
    ];

    if (!isset($icons[$name]))
        return '';
    $cls = $class ? ' class="' . esc_attr($class) . '"' : '';
    return '<svg' . $cls . ' viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">' . $icons[$name] . '</svg>';
}
