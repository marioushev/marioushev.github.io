<?php
/**
 * One-time setup: creates all required pages with correct templates.
 * Run once by visiting WP Admin → Tools → Setup VakInvest Pages.
 * After running, remove or disable the admin menu entry.
 */
defined('ABSPATH') || exit;

function vakinvest_setup_admin_menu() {
    add_management_page(
        'Setup VakInvest 86 Pages',
        'Setup VakInvest Pages',
        'manage_options',
        'vakinvest-setup',
        'vakinvest_setup_pages_page'
    );
}
add_action('admin_menu', 'vakinvest_setup_admin_menu');

function vakinvest_setup_pages_page() {
    ?>
    <div class="wrap">
        <h1>🏗️ ВАК ИНВЕСТ 86 — Начална конфигурация</h1>
        <?php
        if (isset($_POST['vi_run_setup']) && check_admin_referer('vi_setup')) {
            $results = vakinvest_create_all_pages();
            echo '<div class="notice notice-success"><p><strong>Готово!</strong> Страниците са създадени:</p><ul>';
            foreach ($results as $r) {
                echo '<li>' . esc_html($r) . '</li>';
            }
            echo '</ul></div>';

            // Set front page
            $home = get_page_by_path('/');
            $posts_page_id = get_page_by_title('Blog') ? get_page_by_title('Blog')->ID : 0;
            $home_page = get_posts(['post_type'=>'page','name'=>'nachalo','posts_per_page'=>1]);
            if ($home_page) {
                update_option('show_on_front', 'page');
                update_option('page_on_front', $home_page[0]->ID);
            }

            echo '<div class="notice notice-info"><p>✅ Следващи стъпки:<ol>
            <li>Отидете на <strong>Настройки → Четене</strong> и проверете дали началната страница е "Начало"</li>
            <li>Отидете на <strong>Външен вид → Менюта</strong> и създайте менютата</li>
            <li>Отидете на <strong>Настройки → Персонализиране → Данни на фирмата</strong> и попълнете данните</li>
            <li>Добавете проекти от <strong>Проекти → Добави нов</strong></li>
            <li>Качете лого от <strong>Персонализиране → Идентичност на сайта</strong></li>
            </ol></p></div>';
        }
        ?>
        <p>Натиснете бутона по-долу, за да се създадат автоматично всички необходими страници с правилните шаблони.</p>
        <p><strong>Важно:</strong> Страниците ще бъдат създадени само ако не съществуват вече. Безопасно е да се изпълни повторно.</p>
        <form method="POST">
            <?php wp_nonce_field('vi_setup'); ?>
            <input type="hidden" name="vi_run_setup" value="1">
            <button type="submit" class="button button-primary button-large">
                🚀 Създай всички страници
            </button>
        </form>
    </div>
    <?php
}

function vakinvest_create_all_pages() {
    $results = [];

    $pages = [
        /* [slug, title, template, parent_slug] */
        ['nachalo',                    'Начало',                             '',                                  ''],
        ['za-nas',                     'За нас',                             'templates/page-za-nas.php',          ''],
        ['uslugi',                     'Услуги',                             'templates/page-uslugi.php',          ''],
        ['uslugi/proektirane',         'Проектиране и строителство',         'templates/page-proektirane.php',    'uslugi'],
        ['uslugi/el-vik',              'Ел. и ВиК инсталации',              'templates/page-el-vik.php',          'uslugi'],
        ['uslugi/dovarshitelni',       'Довършителни работи',                'templates/page-dovarshitelni.php',  'uslugi'],
        ['uslugi/izolacii',            'Изолации',                           'templates/page-izolacii.php',        'uslugi'],
        ['uslugi/patno',               'Пътно строителство',                 'templates/page-patno.php',           'uslugi'],
        ['mehanizaciya',               'Механизация',                        'templates/page-mehanizaciya.php',   ''],
        ['proekti',                    'Изпълнени проекти',                  'templates/page-proekti.php',         ''],
        ['sertifikati',                'Сертификати',                        'templates/page-sertifikati.php',     ''],
        ['klienti',                    'Клиенти',                            'templates/page-klienti.php',         ''],
        ['kontakti',                   'Контакти',                           'templates/page-kontakti.php',        ''],
        ['obshti-uslovia',             'Общи условия',                       'templates/page-obshti-uslovia.php', ''],
        ['politika-za-poveritelnost',  'Политика за поверителност',          'templates/page-politika.php',        ''],
    ];

    $created_ids = [];

    foreach ($pages as [$slug, $title, $template, $parent_slug]) {
        $slug_parts = explode('/', $slug);
        $page_slug  = end($slug_parts);

        // Find parent
        $parent_id = 0;
        if ($parent_slug && isset($created_ids[$parent_slug])) {
            $parent_id = $created_ids[$parent_slug];
        }

        // Check if page exists
        $exists = get_posts([
            'post_type'   => 'page',
            'name'        => $page_slug,
            'post_parent' => $parent_id,
            'post_status' => 'any',
            'numberposts' => 1,
        ]);

        if ($exists) {
            $page_id = $exists[0]->ID;
            if ($template) update_post_meta($page_id, '_wp_page_template', $template);
            $created_ids[$slug] = $page_id;
            $results[]          = "✔ Вече съществува: {$title} (ID {$page_id})";
            continue;
        }

        // Create page
        $page_id = wp_insert_post([
            'post_title'  => $title,
            'post_name'   => $page_slug,
            'post_type'   => 'page',
            'post_status' => 'publish',
            'post_parent' => $parent_id,
        ]);

        if (is_wp_error($page_id)) {
            $results[] = "✗ Грешка при създаване на: {$title}";
            continue;
        }

        if ($template) update_post_meta($page_id, '_wp_page_template', $template);
        $created_ids[$slug] = $page_id;
        $results[]          = "✅ Създадена: {$title} (ID {$page_id})";
    }

    /* Default project categories */
    $cats = [
        'Жилищно строителство',
        'Промишлено строителство',
        'Пътно строителство',
        'Ремонтни дейности',
        'Инфраструктура',
    ];
    foreach ($cats as $cat) {
        if (!term_exists($cat, 'project_category')) {
            wp_insert_term($cat, 'project_category');
            $results[] = "✅ Категория: {$cat}";
        }
    }

    return $results;
}
