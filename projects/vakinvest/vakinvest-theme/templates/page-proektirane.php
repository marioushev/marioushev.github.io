<?php
/**
 * Template Name: Услуга — Проектиране и строителство
 */
get_header(); ?>

<div class="page-banner">
    <div class="container">
        <h1>ПРОЕКТИРАНЕ И СТРОИТЕЛСТВО</h1>
        <?php vakinvest_breadcrumb(); ?>
    </div>
</div>

<section class="service-page section">
    <div class="container">
        <div class="service-page-layout">

            <main class="service-page-main">
                <h2>Проектиране и строителство</h2>
                <p>ВАК ИНВЕСТ 86 разполага с богат опит в изграждането на нови жилищни, административни и промишлени сгради. Работим по пълния цикъл на строително-монтажни работи — от подготовката на терена до предаването на конструктивно завършения обект.</p>
                <p>Разполагаме с квалифициран технически персонал и строителна механизация за всеки вид изкопни, земни и конструктивни работи. Спазваме стриктно проектната документация, техническите стандарти и правилата за безопасност.</p>

                <ul class="service-page-bullets">
                    <li>Изкопни работи</li>
                    <li>Груб строеж</li>
                    <li>Изграждане и основен ремонт на покриви и покривни конструкции</li>
                </ul>

                <div class="service-page-photos">
                    <?php
                    $photos = [
                        vi_opt('service_proektirane_photo1'),
                        vi_opt('service_proektirane_photo2'),
                    ];
                    foreach ($photos as $i => $photo) : ?>
                        <div class="service-page-photo">
                            <?php if ($photo) : ?>
                                <img src="<?php echo esc_url($photo); ?>" alt="Проектиране и строителство — снимка <?php echo $i + 1; ?>" loading="lazy">
                            <?php else : ?>
                                <div class="service-page-photo-placeholder"><?php echo vakinvest_icon('building'); ?></div>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            </main>

            <?php vakinvest_services_sidebar('proektirane'); ?>

        </div>
    </div>
</section>

<?php get_footer();
