<?php
/**
 * Template Name: Услуга — Изолации
 */
get_header(); ?>

<div class="page-banner">
    <div class="container">
        <h1>ИЗОЛАЦИИ</h1>
        <?php vakinvest_breadcrumb(); ?>
    </div>
</div>

<section class="service-page section">
    <div class="container">
        <div class="service-page-layout">

            <main class="service-page-main">
                <h2>Изолации</h2>
                <p>Монтаж на всички видове изолационни системи — от топлоизолация на фасади и покриви до хидроизолация на основи, мазета и покривни конструкции. Използваме доказани материали от водещи производители.</p>
                <p>Изпълняваме изолационни решения за нови строежи, при реконструкция и санация на съществуващи сгради. Гарантираме енергийна ефективност и дълъг експлоатационен живот.</p>

                <ul class="service-page-bullets">
                    <li>Топлоизолация</li>
                    <li>Хидроизолация</li>
                </ul>

                <div class="service-page-photos">
                    <?php
                    $photos = [
                        vi_opt('service_izolacii_photo1'),
                        vi_opt('service_izolacii_photo2'),
                    ];
                    foreach ($photos as $i => $photo) : ?>
                        <div class="service-page-photo">
                            <?php if ($photo) : ?>
                                <img src="<?php echo esc_url($photo); ?>" alt="Изолации — снимка <?php echo $i + 1; ?>" loading="lazy">
                            <?php else : ?>
                                <div class="service-page-photo-placeholder"><?php echo vakinvest_icon('shield'); ?></div>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            </main>

            <?php vakinvest_services_sidebar('izolacii'); ?>

        </div>
    </div>
</section>

<?php get_footer();
