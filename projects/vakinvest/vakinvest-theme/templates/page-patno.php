<?php
/**
 * Template Name: Услуга — Пътно строителство
 */
get_header(); ?>

<div class="page-banner">
    <div class="container">
        <h1>ПЪТНО СТРОИТЕЛСТВО</h1>
        <?php vakinvest_breadcrumb(); ?>
    </div>
</div>

<section class="service-page section">
    <div class="container">
        <div class="service-page-layout">

            <main class="service-page-main">
                <h2>Пътно строителство</h2>
                <p>Изграждане и ремонт на пътни настилки, мостови съоръжения, водостоци и дренажни системи. Разполагаме с необходимата техника и опит за реализация на малки и мащабни пътни проекти.</p>
                <p>Работим за общини, държавни инвеститори и частни клиенти — от участъци от градската пътна мрежа до селскостопански пътища и индустриални площадки.</p>

                <ul class="service-page-bullets">
                    <li>Хидроизолация на мостове</li>
                    <li>Почистване на канавки и дерета</li>
                </ul>

                <div class="service-page-photos">
                    <?php
                    $photos = [
                        vi_opt('service_patno_photo1'),
                        vi_opt('service_patno_photo2'),
                    ];
                    foreach ($photos as $i => $photo) : ?>
                        <div class="service-page-photo">
                            <?php if ($photo) : ?>
                                <img src="<?php echo esc_url($photo); ?>" alt="Пътно строителство — снимка <?php echo $i + 1; ?>" loading="lazy">
                            <?php else : ?>
                                <div class="service-page-photo-placeholder"><?php echo vakinvest_icon('road'); ?></div>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            </main>

            <?php vakinvest_services_sidebar('patno'); ?>

        </div>
    </div>
</section>

<?php get_footer();
