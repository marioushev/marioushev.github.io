<?php
/**
 * Template Name: Механизация
 */
get_header();

$banner_img = vi_opt('mehanizaciya_banner_image');

$equipment = [
    ['id' => 'M-01', 'title' => 'Багер товарач',                        'qty' => '3 БР.'],
    ['id' => 'M-02', 'title' => 'Самосвал',                             'qty' => '4 БР.'],
    ['id' => 'M-03', 'title' => 'Фугорез',                              'qty' => '2 БР.'],
    ['id' => 'M-04', 'title' => 'Бобкат',                               'qty' => '2 БР.'],
    ['id' => 'M-05', 'title' => 'Заваръчен апарат за PE / PPR / PVC',   'qty' => '1 БР.'],
    ['id' => 'M-06', 'title' => 'Ел. генератор',                        'qty' => '3 БР.'],
    ['id' => 'M-07', 'title' => 'Валяк',                                'qty' => '2 БР.'],
    ['id' => 'M-08', 'title' => 'Пневматична трамбовка',                'qty' => '2 БР.'],
    ['id' => 'M-09', 'title' => 'Помпа БИБО',                           'qty' => '2 БР.'],
    ['id' => 'M-10', 'title' => 'Товарен камион',                       'qty' => '1 БР.'],
    ['id' => 'M-11', 'title' => 'Лебедка',                              'qty' => '1 БР.'],
    ['id' => 'M-12', 'title' => 'Газови горелки',                       'qty' => '6 БР.'],
    ['id' => 'M-13', 'title' => 'Пътнически бус',                       'qty' => '4 БР.'],
    ['id' => 'M-14', 'title' => 'Ударно пробивна машина',               'qty' => '8 БР.'],
    ['id' => 'M-15', 'title' => 'Къртачи',                              'qty' => '6 БР.'],
    ['id' => 'M-16', 'title' => 'Подвижно скеле',                       'qty' => '300 М²'],
    ['id' => 'M-17', 'title' => 'Скеле',                                'qty' => '6000 М²'],
];
?>

<section class="page-banner">
    <div class="bg"<?php if ($banner_img) echo ' style="background-image:url(' . esc_url($banner_img) . ')"'; ?>></div>
    <div class="container">
        <nav class="crumb" aria-label="Breadcrumb">
            <a href="<?php echo esc_url(home_url('/')); ?>">Начало</a>
            <span class="sep">/</span>
            <span class="current">Механизация</span>
        </nav>
        <h1>Механизация.</h1>
        <div class="meta-row">
            <div><span class="v">/01</span> 17 МАШИНИ</div>
            <div><span class="v">/02</span> СОБСТВЕН ПАРК</div>
            <div><span class="v">/03</span> БЕЗ ПОДИЗПЪЛНИТЕЛИ</div>
        </div>
    </div>
</section>

<section class="block dark">
    <div class="container">
        <div class="section-head">
            <div class="left">
                <div class="eyebrow">Парк / 01</div>
                <h2 class="section-title">Налична механизация</h2>
            </div>
            <div class="right">
                Собствен парк от <?php echo count($equipment); ?> машини и съоръжения. Без подизпълнители за основната тежка механизация — гарантирани срокове и пълен контрол на обекта.
            </div>
        </div>

        <div class="machinery-grid">
            <?php foreach ($equipment as $eq) : ?>
            <div class="machine">
                <div class="photo placeholder-img">снимка / <?php echo esc_html(mb_strtolower($eq['title'], 'UTF-8')); ?></div>
                <div class="body">
                    <div class="id"><?php echo esc_html($eq['id']); ?></div>
                    <h4><?php echo esc_html($eq['title']); ?></h4>
                    <span class="qty"><?php echo esc_html($eq['qty']); ?></span>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="block">
    <div class="container">
        <div class="section-head">
            <div class="left">
                <div class="eyebrow">Защо собствен парк / 02</div>
                <h2 class="section-title">Графикът не зависи от подизпълнители.</h2>
            </div>
            <div class="right">
                Собствените ни машини са на разположение всеки ден — без чакане, без надбавки за наем, без изненади.
            </div>
        </div>
        <div style="display:flex; gap:14px; flex-wrap:wrap">
            <a href="<?php echo esc_url(home_url('/kontakti/')); ?>" class="btn">Поискай оферта →</a>
            <a href="<?php echo esc_url(home_url('/proekti/')); ?>" class="btn dark">Виж проекти</a>
        </div>
    </div>
</section>

<?php get_footer();
