<?php
defined('ABSPATH') || exit;

function vakinvest_enqueue() {
    /* Google Fonts */
    wp_enqueue_style(
        'vakinvest-fonts',
        'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=JetBrains+Mono:wght@400;500&display=swap',
        [],
        null
    );

    /* Main stylesheet */
    wp_enqueue_style(
        'vakinvest-style',
        get_stylesheet_uri(),
        ['vakinvest-fonts'],
        '1.0.0'
    );

    /* Main JS */
    wp_enqueue_script(
        'vakinvest-main',
        get_template_directory_uri() . '/assets/js/main.js',
        [],
        '1.0.0',
        true
    );

    /* Portfolio filter (archive + portfolio template) */
    if (is_post_type_archive('vi_project') || is_page_template('templates/page-proekti.php')) {
        wp_enqueue_script(
            'vakinvest-portfolio',
            get_template_directory_uri() . '/assets/js/portfolio-filter.js',
            ['vakinvest-main'],
            '1.0.0',
            true
        );
    }

    /* Pass data to JS */
    wp_localize_script('vakinvest-main', 'VI', [
        'ajaxUrl' => admin_url('admin-ajax.php'),
        'nonce'   => wp_create_nonce('vi_nonce'),
        'siteUrl' => get_site_url(),
    ]);
}
add_action('wp_enqueue_scripts', 'vakinvest_enqueue');

/* Admin: load media library on project edit screens */
function vakinvest_admin_enqueue($hook) {
    $screen = get_current_screen();
    if ($screen && $screen->post_type === 'vi_project' && in_array($hook, ['post.php', 'post-new.php'])) {
        wp_enqueue_media();
    }
}
add_action('admin_enqueue_scripts', 'vakinvest_admin_enqueue');
