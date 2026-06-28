<?php
/**
 * Template Name: Клиенти
 */
get_header();

$banner_img = vi_opt('klienti_banner_image');

$clients = [
    'Община Шумен',
    'Община Варна',
    'Главболгарстрой',
    'Планекс Холдинг',
    'Артекс Инженеринг',
    'Мостстрой АД',
    'ПИМК',
    'Линднер България',
    'Софстрой',
    'Геострой',
    'Холдинг Пътища',
    'Гарант Инженеринг',
];

$initials_for = function ($name) {
    $parts = preg_split('/\s+/u', trim($name));
    $out = '';
    foreach (array_slice($parts, 0, 2) as $p) {
        $out .= mb_substr($p, 0, 1, 'UTF-8');
    }
    return mb_strtoupper($out, 'UTF-8');
};

$testimonials = [
    [
        'text' => 'Работихме с ВАК ИНВЕСТ 86 за изграждането на нашата производствена база. Доволни сме от качеството на изпълнение и спазените срокове. Ще ги препоръчаме без колебание.',
        'author' => 'Управител',
        'role' => 'Производствено предприятие',
    ],
    [
        'text' => 'Фирмата се отличава с коректност, прозрачност и висок стандарт на работа. Нашият жилищен комплекс беше завършен в срок и с отлично качество.',
        'author' => 'Инвеститор',
        'role' => 'Жилищно строителство',
    ],
];
?>

<section class="page-banner">
    <div class="bg" <?php if ($banner_img)
        echo ' style="background-image:url(' . esc_url($banner_img) . ')"'; ?>></div>
    <div class="container">
        <nav class="crumb" aria-label="Breadcrumb">
            <a href="<?php echo esc_url(home_url('/')); ?>">Начало</a>
            <span class="sep">/</span>
            <span class="current">Клиенти</span>
        </nav>
        <h1>Клиенти.</h1>
        <div class="meta-row">
            <div><span class="v">/01</span> ИНВЕСТИТОРИ</div>
            <div><span class="v">/02</span> ОБЩИНИ</div>
            <div><span class="v">/03</span> ЧАСТНИ КЛИЕНТИ</div>
        </div>
    </div>
</section>

<section class="block">
    <div class="container">

        <div class="section-head">
            <div class="left">
                <div class="eyebrow">Нашите партньори / 01</div>
                <h2 class="section-title">Клиенти, на които се доверяват</h2>
            </div>
            <div class="right">
                Гордеем се с дългосрочните отношения, изградени с инвеститори, общини, строителни предприемачи и частни
                клиенти от цялата страна.
            </div>
        </div>

        <div class="clients-grid">
            <?php foreach ($clients as $name): ?>
                <div class="client-logo">
                    <div class="client-logo-placeholder">
                        <span class="client-monogram"><?php echo esc_html($initials_for($name)); ?></span>
                        <span class="client-name"><?php echo esc_html($name); ?></span>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <section class="testimonials-block">
            <div class="section-head">
                <div class="left">
                    <div class="eyebrow">Отзиви / 02</div>
                    <h2 class="section-title">Какво казват нашите клиенти</h2>
                </div>
                <div class="right">
                    Подбрани отзиви от инвеститори и възложители, с които сме работили през последните години.
                </div>
            </div>
            <div class="testimonials-grid">
                <?php foreach ($testimonials as $t): ?>
                    <article class="testimonial-card">
                        <div class="testimonial-quote">&ldquo;</div>
                        <p class="testimonial-text"><?php echo esc_html($t['text']); ?></p>
                        <footer class="testimonial-author">
                            <span class="ta-avatar"><?php echo vakinvest_icon('handshake'); ?></span>
                            <div>
                                <strong><?php echo esc_html($t['author']); ?></strong>
                                <small><?php echo esc_html($t['role']); ?></small>
                            </div>
                        </footer>
                    </article>
                <?php endforeach; ?>
            </div>
        </section>

        <div class="clients-cta">
            <div class="copy">
                <div class="eyebrow">Запитване / 03</div>
                <h3>Станете следващият доволен клиент.</h3>
                <p>Свържете се с нас за консултация и оферта за вашия проект — отговор до 48 часа, безплатен оглед и
                    предварителна КСС.</p>
            </div>
            <a href="<?php echo esc_url(home_url('/kontakti/')); ?>" class="btn">Свържете се с нас →</a>
        </div>

    </div>
</section>

<?php get_footer();
