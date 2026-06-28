<?php
/**
 * Template Name: Услуга — Довършителни работи
 */
get_header(); ?>

<div class="page-banner">
    <div class="container">
        <h1>ДОВЪРШИТЕЛНИ РАБОТИ</h1>
        <?php vakinvest_breadcrumb(); ?>
    </div>
</div>

<section class="service-page section">
    <div class="container">
        <div class="service-page-layout">

            <main class="service-page-main">
                <h2>Довършителни работи</h2>
                <p>Извършваме пълен комплекс от вътрешни и външни довършителни работи с висок стандарт на изпълнение. От мазилки и шпакловки до облицовки и настилки — работим прецизно с внимание към детайла.</p>
                <p>Използваме сертифицирани материали от водещи производители и спазваме технологичните срокове, за да гарантираме трайност и качество на изпълнение.</p>

                <ul class="service-page-bullets">
                    <li>Полагане на външна и вътрешна мазилка</li>
                    <li>Шпакловки</li>
                </ul>

                <div class="service-page-photos">
                    <?php
                    $photos = [
                        vi_opt('service_dovarshitelni_photo1'),
                        vi_opt('service_dovarshitelni_photo2'),
                    ];
                    foreach ($photos as $i => $photo) : ?>
                        <div class="service-page-photo">
                            <?php if ($photo) : ?>
                                <img src="<?php echo esc_url($photo); ?>" alt="Довършителни работи — снимка <?php echo $i + 1; ?>" loading="lazy">
                            <?php else : ?>
                                <div class="service-page-photo-placeholder"><?php echo vakinvest_icon('brush'); ?></div>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            </main>

            <?php vakinvest_services_sidebar('dovarshitelni'); ?>

        </div>
    </div>
</section>

<?php get_footer();
