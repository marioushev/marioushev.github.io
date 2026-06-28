<?php
/**
 * Template Name: Услуга — Ел. и ВиК инсталации
 */
get_header(); ?>

<div class="page-banner">
    <div class="container">
        <h1>ЕЛ. И ВИК ИНСТАЛАЦИИ</h1>
        <?php vakinvest_breadcrumb(); ?>
    </div>
</div>

<section class="service-page section">
    <div class="container">
        <div class="service-page-layout">

            <main class="service-page-main">
                <h2>Ел. и ВиК инсталации</h2>
                <p>Извършваме проектиране и монтаж на вътрешни и външни електрически инсталации ниско напрежение, слаботокови системи, водопроводни мрежи и канализация.</p>
                <p>Нашите лицензирани електротехници и ВиК специалисти работят по одобрени проекти, гарантирайки безопасност, функционалност и съответствие с нормите. Работим на нови строежи, реконструкции и ремонти на жилищни, административни и промишлени обекти.</p>

                <ul class="service-page-bullets">
                    <li>Ел. инсталации</li>
                    <li>ВиК инсталации</li>
                </ul>

                <div class="service-page-photos">
                    <?php
                    $photos = [
                        vi_opt('service_el_vik_photo1'),
                        vi_opt('service_el_vik_photo2'),
                    ];
                    foreach ($photos as $i => $photo) : ?>
                        <div class="service-page-photo">
                            <?php if ($photo) : ?>
                                <img src="<?php echo esc_url($photo); ?>" alt="Ел. и ВиК инсталации — снимка <?php echo $i + 1; ?>" loading="lazy">
                            <?php else : ?>
                                <div class="service-page-photo-placeholder"><?php echo vakinvest_icon('bolt'); ?></div>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            </main>

            <?php vakinvest_services_sidebar('el-vik'); ?>

        </div>
    </div>
</section>

<?php get_footer();
