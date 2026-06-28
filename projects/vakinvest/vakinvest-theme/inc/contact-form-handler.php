<?php
defined('ABSPATH') || exit;

function vakinvest_handle_contact() {
    if (empty($_POST['vi_contact_submit'])) return;

    // Nonce
    if (empty($_POST['vi_nonce']) || !wp_verify_nonce($_POST['vi_nonce'], 'vi_contact_form')) {
        wp_safe_redirect(add_query_arg('contact', 'security', wp_get_referer() ?: home_url('/')));
        exit;
    }

    // Math captcha — verify without storing in session
    $answer   = (int) ($_POST['vi_captcha'] ?? -9999);
    $token    = sanitize_text_field($_POST['vi_captcha_token'] ?? '');
    $ok_now   = wp_hash($answer . 'vi_cap' . AUTH_KEY . date('YmdH'));
    $ok_prev  = wp_hash($answer . 'vi_cap' . AUTH_KEY . date('YmdH', strtotime('-1 hour')));
    if ($token !== $ok_now && $token !== $ok_prev) {
        wp_safe_redirect(add_query_arg('contact', 'captcha', wp_get_referer() ?: home_url('/')));
        exit;
    }

    // GDPR
    if (empty($_POST['vi_gdpr'])) {
        wp_safe_redirect(add_query_arg('contact', 'gdpr', wp_get_referer() ?: home_url('/')));
        exit;
    }

    $name    = sanitize_text_field($_POST['vi_name']    ?? '');
    $phone   = sanitize_text_field($_POST['vi_phone']   ?? '');
    $email   = sanitize_email($_POST['vi_email']        ?? '');
    $city    = sanitize_text_field($_POST['vi_city']    ?? '');
    $message = sanitize_textarea_field($_POST['vi_message'] ?? '');

    if (!$name || !$email || !$message) {
        wp_safe_redirect(add_query_arg('contact', 'missing', wp_get_referer() ?: home_url('/')));
        exit;
    }
    if (!is_email($email)) {
        wp_safe_redirect(add_query_arg('contact', 'bademail', wp_get_referer() ?: home_url('/')));
        exit;
    }

    $to      = get_option('admin_email');
    $subject = '[ВАК ИНВЕСТ 86] Ново запитване от ' . $name;
    $body    = "Получено ново запитване от сайта на ВАК ИНВЕСТ 86\n";
    $body   .= str_repeat('─', 50) . "\n\n";
    $body   .= "Име:              {$name}\n";
    $body   .= "Телефон:          " . ($phone ?: '—') . "\n";
    $body   .= "E-mail:           {$email}\n";
    $body   .= "Населено място:   " . ($city ?: '—') . "\n\n";
    $body   .= "Съобщение:\n{$message}\n";
    $body   .= "\n" . str_repeat('─', 50) . "\n";
    $body   .= "Изпратено от: " . get_site_url() . "\n";
    $body   .= "Дата: " . wp_date('d.m.Y H:i') . "\n";

    $headers = [
        'Content-Type: text/plain; charset=UTF-8',
        "Reply-To: {$name} <{$email}>",
    ];

    $sent = wp_mail($to, $subject, $body, $headers);

    wp_safe_redirect(add_query_arg('contact', $sent ? 'ok' : 'fail', wp_get_referer() ?: home_url('/')));
    exit;
}
add_action('init', 'vakinvest_handle_contact', 1);

/* ── Render form notice ─────────────────────────────── */
function vakinvest_form_notice() {
    $status = $_GET['contact'] ?? '';
    if (!$status) return;

    $messages = [
        'ok'       => ['success', 'Благодарим! Вашето съобщение беше изпратено успешно. Ще се свържем с вас скоро.'],
        'fail'     => ['error',   'Грешка при изпращане. Моля, свържете се с нас директно по телефон.'],
        'missing'  => ['error',   'Моля, попълнете всички задължителни полета (Ime, E-mail, Съобщение).'],
        'bademail' => ['error',   'Невалиден e-mail адрес. Моля, проверете и опитайте отново.'],
        'captcha'  => ['error',   'Грешен отговор на математическия въпрос. Моля, опитайте отново.'],
        'gdpr'     => ['error',   'Необходимо е да се съгласите с обработката на личните данни.'],
        'security' => ['error',   'Грешка в сигурността. Моля, опреснете страницата и опитайте отново.'],
    ];

    if (!isset($messages[$status])) return;
    [$type, $text] = $messages[$status];
    echo '<div class="form-notice ' . esc_attr($type) . '">' . esc_html($text) . '</div>';
}

/* ── Generate captcha token ─────────────────────────── */
function vakinvest_captcha_token($answer) {
    return wp_hash((int)$answer . 'vi_cap' . AUTH_KEY . date('YmdH'));
}
