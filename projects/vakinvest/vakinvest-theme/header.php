<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>

    <?php
    $phone = vi_opt('company_phone', '+359 87 631 3061');
    $addr = vi_opt('company_address', 'гр. София, р-н Лозенец, Черни връх, 27');
    ?>

    <!-- Top bar -->
    <div class="topbar">
        <div class="container">
            <div class="topbar-left">
                <a
                    href="tel:<?php echo esc_attr(preg_replace('/\s+/', '', $phone)); ?>"><?php echo esc_html($phone); ?></a>
                <span class="sep">/</span>
                <span class="addr"><?php echo esc_html($addr); ?></span>
            </div>
            <a href="<?php echo esc_url(home_url('/kontakti/')); ?>" class="topbar-cta">Изпрати запитване →</a>
        </div>
    </div>

    <!-- Header -->
    <header class="site-header" id="site-header" role="banner">
        <div class="container">
            <a href="<?php echo esc_url(home_url('/')); ?>" class="site-logo"
                aria-label="<?php bloginfo('name'); ?> — начална страница">
                <?php if (has_custom_logo()):
                    the_custom_logo();
                else: ?>
                    <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/logo.png'); ?>"
                        alt="ВАК ИНВЕСТ 86">
                    <!-- <div class="logo-mark">V</div> -->
                    <div class="logo-text">
                        <div class="name">VAK INVEST 86</div>
                        <div class="tag">Строителство · Инженерство</div>
                    </div>
                <?php endif; ?>
            </a>

            <nav class="primary-nav" role="navigation" aria-label="Главно меню">
                <?php wp_nav_menu([
                    'theme_location' => 'primary',
                    'menu_class' => 'nav-menu',
                    'container' => false,
                    'fallback_cb' => 'vakinvest_fallback_nav',
                    'walker' => new VakInvest_Walker_Nav(),
                ]); ?>
            </nav>

            <button class="hamburger" id="hamburger" aria-label="Отвори менюто" aria-expanded="false"
                aria-controls="mobile-nav">
                <span></span>
                <span></span>
                <span></span>
            </button>
        </div>
    </header><!-- .site-header -->

    <!-- Mobile Nav -->
    <div class="mobile-nav" id="mobile-nav" aria-hidden="true">
        <?php vakinvest_mobile_nav(); ?>
    </div>

    <?php
    function vakinvest_fallback_nav()
    {
        $items = [
            ['Начало', home_url('/'), []],
            ['За нас', home_url('/za-nas/'), []],
            [
                'Услуги',
                home_url('/uslugi/'),
                [
                    'Проектиране и строителство' => home_url('/uslugi/proektirane/'),
                    'Ел. и ВиК инсталации' => home_url('/uslugi/el-vik/'),
                    'Довършителни работи' => home_url('/uslugi/dovarshitelni/'),
                    'Изолации' => home_url('/uslugi/izolacii/'),
                    'Пътно строителство' => home_url('/uslugi/patno/'),
                ]
            ],
            ['Механизация', home_url('/mehanizaciya/'), []],
            ['Изпълнени проекти', home_url('/proekti/'), []],
            ['Сертификати', home_url('/sertifikati/'), []],
            ['Клиенти', home_url('/klienti/'), []],
            ['Контакти', home_url('/kontakti/'), []],
        ];

        echo '<ul class="nav-menu">';
        foreach ($items as [$label, $url, $children]) {
            $has = !empty($children);
            $cls = $has ? ' class="has-drop"' : '';
            echo '<li' . $cls . '>';
            echo '<a href="' . esc_url($url) . '">' . esc_html($label);
            if ($has)
                echo ' <span class="caret" aria-hidden="true">▾</span>';
            echo '</a>';
            if ($has) {
                echo '<ul class="dropdown-menu">';
                foreach ($children as $clabel => $curl) {
                    echo '<li><a href="' . esc_url($curl) . '">' . esc_html($clabel) . '</a></li>';
                }
                echo '</ul>';
            }
            echo '</li>';
        }
        echo '</ul>';
    }

    function vakinvest_mobile_nav()
    {
        $items = [
            ['Начало', home_url('/'), []],
            ['За нас', home_url('/za-nas/'), []],
            [
                'Услуги',
                home_url('/uslugi/'),
                [
                    'Проектиране и строителство' => home_url('/uslugi/proektirane/'),
                    'Ел. и ВиК инсталации' => home_url('/uslugi/el-vik/'),
                    'Довършителни работи' => home_url('/uslugi/dovarshitelni/'),
                    'Изолации' => home_url('/uslugi/izolacii/'),
                    'Пътно строителство' => home_url('/uslugi/patno/'),
                ]
            ],
            ['Механизация', home_url('/mehanizaciya/'), []],
            ['Изпълнени проекти', home_url('/proekti/'), []],
            ['Сертификати', home_url('/sertifikati/'), []],
            ['Клиенти', home_url('/klienti/'), []],
            ['Контакти', home_url('/kontakti/'), []],
        ];

        echo '<ul class="mobile-nav-menu">';
        foreach ($items as $i => [$label, $url, $children]) {
            $has = !empty($children);
            echo '<li' . ($has ? ' class="has-dropdown"' : '') . '>';
            echo '<a href="' . esc_url($url) . '">';
            echo esc_html($label);
            if ($has)
                echo ' <span class="mobile-toggle-arrow">▾</span>';
            echo '</a>';
            if ($has) {
                echo '<ul class="mobile-dropdown">';
                foreach ($children as $clabel => $curl) {
                    echo '<li><a href="' . esc_url($curl) . '">' . esc_html($clabel) . '</a></li>';
                }
                echo '</ul>';
            }
            echo '</li>';
        }
        echo '</ul>';
    }
    ?>