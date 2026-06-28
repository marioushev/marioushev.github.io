<?php
/**
 * Template Name: Услуги
 */
get_header();

$banner_img = vi_opt('uslugi_banner_image');

$services = [
    [
        'slug'  => 'proektirane',
        'num'   => '01',
        'title' => 'Проектиране и строителство',
        'items' => ['Изкопни работи', 'Груб строеж', 'Покривни конструкции'],
    ],
    [
        'slug'  => 'el-vik',
        'num'   => '02',
        'title' => 'Ел. и ВиК инсталации',
        'items' => ['Електрически инсталации', 'ВиК инсталации'],
    ],
    [
        'slug'  => 'dovarshitelni',
        'num'   => '03',
        'title' => 'Довършителни работи',
        'items' => ['Външна и вътрешна мазилка', 'Шпакловки'],
    ],
    [
        'slug'  => 'izolacii',
        'num'   => '04',
        'title' => 'Изолации',
        'items' => ['Топлоизолация', 'Хидроизолация'],
    ],
    [
        'slug'  => 'patno',
        'num'   => '05',
        'title' => 'Пътно строителство',
        'items' => ['Хидроизолация на мостове', 'Канавки и дерета'],
    ],
];
?>

<section class="page-banner">
    <div class="bg"<?php if ($banner_img) echo ' style="background-image:url(' . esc_url($banner_img) . ')"'; ?>></div>
    <div class="container">
        <nav class="crumb" aria-label="Breadcrumb">
            <a href="<?php echo esc_url(home_url('/')); ?>">Начало</a>
            <span class="sep">/</span>
            <span class="current">Услуги</span>
        </nav>
        <h1>Услуги.</h1>
        <div class="meta-row">
            <div><span class="v">/01</span> ПЪЛЕН ЦИКЪЛ</div>
            <div><span class="v">/02</span> 5 НАПРАВЛЕНИЯ</div>
            <div><span class="v">/03</span> ЕДИН ОТГОВОРНИК</div>
        </div>
    </div>
</section>

<section class="block">
    <div class="container">
        <div class="section-head">
            <div class="left">
                <div class="eyebrow">Какво правим / 01</div>
                <h2 class="section-title">Нашите услуги</h2>
            </div>
            <div class="right">
                Пълен цикъл строителство — от проектиране и груб строеж до инсталации, изолации и пътно строителство. Един изпълнител за целия Ви обект.
            </div>
        </div>

        <div class="services-grid">
            <?php foreach ($services as $s) :
                $img = vi_opt('home_service_' . $s['slug'] . '_image');
            ?>
            <a class="service-card" href="<?php echo esc_url(home_url('/uslugi/' . $s['slug'] . '/')); ?>">
                <div class="photo"<?php if ($img) echo ' style="background-image:url(' . esc_url($img) . ')"'; ?>>
                    <span class="num"><?php echo esc_html($s['num']); ?></span>
                </div>
                <div class="body">
                    <h3><?php echo esc_html($s['title']); ?></h3>
                    <ul>
                        <?php foreach ($s['items'] as $item) : ?>
                            <li><?php echo esc_html($item); ?></li>
                        <?php endforeach; ?>
                    </ul>
                    <span class="more">Напред <span class="arr">→</span></span>
                </div>
            </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="block dark">
    <div class="container">
        <div class="section-head">
            <div class="left">
                <div class="eyebrow">Имате обект? / 02</div>
                <h2 class="section-title">Един договор, един срок, един отговорник.</h2>
            </div>
            <div class="right">
                Пишете ни — отговор до 48 часа. Безплатен оглед и предварителна количествено-стойностна сметка преди да поемете ангажимент.
            </div>
        </div>
        <div style="display:flex; gap:14px; flex-wrap:wrap">
            <a href="<?php echo esc_url(home_url('/kontakti/')); ?>" class="btn">Поискай оферта →</a>
            <a href="<?php echo esc_url(home_url('/proekti/')); ?>" class="btn ghost">Виж проекти</a>
        </div>
    </div>
</section>

<?php get_footer();
