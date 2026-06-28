<?php
/**
 * Template Name: За нас
 */
get_header();

$banner_img = vi_opt('about_banner_image', vi_opt('about_hero_photo'));
$wide_img = vi_opt('about_wide_image', vi_opt('about_hero_photo'));
$active_label = vi_opt('about_active_label', 'Активен обект');
$active_text = vi_opt('about_active_text', 'Многофамилна жилищна сграда — Шумен, фаза груб строеж');

/* Services list (used by sidebar) */
$services = [
    'proektirane' => 'Проектиране и строителство',
    'el-vik' => 'Ел. и ВиК инсталации',
    'dovarshitelni' => 'Довършителни работи',
    'izolacii' => 'Изолации',
    'patno' => 'Пътно строителство',
];

/* Specialties (numbered list) */
$specialties = [
    'Специалисти хидро и топлоизолации',
    'Специалисти вътрешни и външни мазилки и шпакловки',
    'Специалисти бояджии',
    'Специалисти тенекеджии',
    'Специалисти покривни майстори',
    'Специалисти фаянс и теракот',
    'Електро- и ВиК инсталатори',
    'Оператори тежка механизация',
];

/* Timeline */
$timeline = [
    ['year' => '2016', 'title' => 'Основаване', 'text' => 'ВАК ИНВЕСТ 86 ЕООД стартира дейност в Самоков с фокус върху груб строеж и инсталации.'],
    ['year' => '2008', 'title' => 'Първи ISO', 'text' => 'Внедрена система за управление на качеството ISO 9001 и регистрация в Камарата на строителите.'],
    ['year' => '2016', 'title' => 'Разширяване', 'text' => 'Собствен парк от 17 машини; екип от 50+ специалисти. Първа група строежи.'],
    ['year' => '2024', 'title' => 'Третото десетилетие', 'text' => '240+ завършени обекта. Активни жилищни и инфраструктурни проекти в региона.'],
];

/* Mission cards */
$missions = [
    ['title' => 'Срокът е дума, не пожелание.', 'text' => 'Договорираният срок е въведен в експлоатация — без изключения. Собственият ни парк гарантира, че графикът не зависи от подизпълнители.'],
    ['title' => 'Един отговорник на обект.', 'text' => 'Технически ръководител, който знае всеки детайл — от арматурата до фугата. Без размяна на топката.'],
    ['title' => 'Материалите си казват името.', 'text' => 'Сертифицирани доставчици, документиран произход, проверка на партида. Никаква импровизация при изолациите и бетоните.'],
    ['title' => 'Безопасността не е разход.', 'text' => 'ISO 45001 не е стикер — лични предпазни средства, инструктаж и строг контрол на скелетата на всеки обект.'],
];

/* Helper to extract Bulgarian initials from a name */
$initials = function ($name) {
    $parts = preg_split('/\s+/u', trim($name));
    $out = '';
    foreach (array_slice($parts, 0, 2) as $p) {
        $out .= mb_substr($p, 0, 1, 'UTF-8');
    }
    return mb_strtoupper($out, 'UTF-8');
};

/* Team — Management */
$management = [
    ['name' => 'инж. Антоанета Огнянова', 'role' => 'Управител · 01', 'title' => 'Управител и съосновател — над 25 години опит в проектирането и управлението на строителни обекти.', 'extra' => 'Специалност: Промишлено и гражданско строителство'],
];
/* Team — Administration */
$administration = [
    ['name' => 'Емилия Константинова', 'role' => 'Администрация', 'title' => 'Счетоводител'],
    ['name' => 'Наталия Сергеевна Супрунова', 'role' => 'Администрация', 'title' => 'Технически организатор'],
    ['name' => 'Катерина Стоянова Пунзарова', 'role' => 'Администрация', 'title' => 'Технически изпълнител'],
];
/* Team — Specialists */
$specialists = [
    ['name' => 'Силвия Симеонова Иванова', 'role' => 'Инженер', 'title' => 'Управител за Р. България на Транспасифик Сертификейшън България ЕООД', 'extra' => 'www.tclbg.com'],
    ['name' => 'Зия Рефкъ Мехмед', 'role' => 'Инженер', 'title' => 'Инженер промишлено и гражданско строителство'],
    ['name' => 'Христо Янков', 'role' => 'Инженер', 'title' => 'Инженер хидромелиоративно строителство'],
    ['name' => 'Николай Любенов Рачински', 'role' => 'Инженер', 'title' => 'ВиК инженер'],
    ['name' => 'Петко Тодоров Иванов', 'role' => 'Технически', 'title' => 'Технически ръководител'],
    ['name' => 'Радко Костадинов Радков', 'role' => 'Технически', 'title' => 'Технически ръководител'],
];
?>

<!-- Page banner -->
<section class="page-banner tall">
    <div class="bg" <?php if ($banner_img)
        echo ' style="background-image:url(' . esc_url($banner_img) . ')"'; ?>></div>
    <div class="container">
        <nav class="crumb" aria-label="Breadcrumb">
            <a href="<?php echo esc_url(home_url('/')); ?>">Начало</a>
            <span class="sep">/</span>
            <span class="current">За нас</span>
        </nav>
        <h1>За нас.</h1>
        <div class="meta-row">
            <div><span class="v">/01</span> ОСНОВАНА 2016</div>
            <div><span class="v">/02</span> САМОКОВ, БЪЛГАРИЯ</div>
            <div><span class="v">/03</span> ISO 9001 / 14001 / 45001</div>
        </div>
    </div>
</section>

<!-- Main content + sidebar -->
<section class="block about-page">
    <div class="container">
        <div class="with-aside">

            <div class="main-col">

                <div class="intro">
                    <div class="eyebrow">Кои сме ние / 01</div>
                    <h2><?php echo esc_html(vi_opt('about_intro_headline', 'Дългогодишен опит в строителството в Североизточна България без прекъсване, без подизпълнители за основното.')); ?>
                    </h2>
                    <p><?php echo wp_kses(vi_opt('about_intro_p1', 'Ние специализираме в областта на <strong>проектирането и строителството</strong>. Нашият стремеж е постигането на високо качество в реални срокове чрез прилагане на най-съвременни технологии.'), ['strong' => [], 'b' => []]); ?>
                    </p>
                    <p><?php echo wp_kses(vi_opt('about_intro_p2', 'Гарантираме <strong>професионално и отговорно отношение</strong> към работата и нашите клиенти, висококвалифициран екип от специалисти, оригинални проекти, висококачествени материали и отлично изпълнение.'), ['strong' => [], 'b' => []]); ?>
                    </p>
                </div>

                <div class="wide-image" <?php if ($wide_img)
                    echo ' style="background-image:url(' . esc_url($wide_img) . ')"'; ?>>
                    <div class="frame-tag">
                        <div class="label"><?php echo esc_html($active_label); ?></div>
                        <div class="val"><?php echo esc_html($active_text); ?></div>
                    </div>
                </div>

                <div class="body-copy">
                    <p><?php echo wp_kses(vi_opt('about_body_p1', 'Основана през <strong>2016 г.</strong>, ВАК ИНВЕСТ 86 ЕООД специализира в проектиране и строителство на административни, жилищни и промишлени сгради; ремонт и саниране на съществуващи промишлени сгради; монтаж на сглобяеми метални и стоманобетонови конструкции; направа на специални промишлени подове от бетон; инсталационни оборудвания.'), ['strong' => [], 'b' => []]); ?>
                    </p>
                    <p><?php echo wp_kses(vi_opt('about_body_p2', 'Фирмата е регистрирана в „<strong>Камара на строителите в България</strong>" и сертифицирана по ISO 9001:2015, ISO 14001:2015 и ISO 45001:2018.'), ['strong' => [], 'b' => []]); ?>
                    </p>
                    <p><?php echo wp_kses(vi_opt('about_body_p3', 'Екипът на ВАК ИНВЕСТ 86 ЕООД се състои от <strong>50+ човека</strong>, специализирани в следните области:'), ['strong' => [], 'b' => []]); ?>
                    </p>

                    <div class="specialty-list">
                        <?php foreach ($specialties as $i => $s): ?>
                            <div class="item">
                                <div class="num">/ <?php echo str_pad($i + 1, 2, '0', STR_PAD_LEFT); ?></div>
                                <div class="name"><?php echo esc_html($s); ?></div>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <div class="notes">
                        <p><span class="star">*</span>
                            <?php echo wp_kses(vi_opt('about_note_1', 'Всички обекти са възложени на <strong>конкурсни начала</strong> по Закона за обществените поръчки и са въведени в експлоатация в договорирания срок.'), ['strong' => []]); ?>
                        </p>
                        <p><span class="star">*</span>
                            <?php echo wp_kses(vi_opt('about_note_2', 'Инвеститорите и Строителните надзори, и инвеститорските контроли оценяват като <strong>много добро качеството</strong> на изпълнените от фирмата обекти.'), ['strong' => []]); ?>
                        </p>
                    </div>

                    <div class="timeline-wrap">
                        <div class="timeline-head">
                            <div class="eyebrow">Хронология</div>
                            <h3>Нашите три десетилетия.</h3>
                        </div>
                        <div class="timeline">
                            <?php foreach ($timeline as $tl): ?>
                                <div class="tl-item">
                                    <div class="year"><?php echo esc_html($tl['year']); ?></div>
                                    <h5><?php echo esc_html($tl['title']); ?></h5>
                                    <p><?php echo esc_html($tl['text']); ?></p>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>

            <aside class="services-aside" aria-label="Услуги">
                <div class="panel">
                    <div class="panel-head">
                        <h5>Услуги</h5>
                        <span class="count"><?php echo str_pad(count($services), 2, '0', STR_PAD_LEFT); ?> /
                            <?php echo str_pad(count($services), 2, '0', STR_PAD_LEFT); ?></span>
                    </div>
                    <?php $i = 0;
                    foreach ($services as $slug => $label):
                        $i++; ?>
                        <a href="<?php echo esc_url(home_url('/uslugi/' . $slug . '/')); ?>">
                            <span><span class="num">/
                                    <?php echo str_pad($i, 2, '0', STR_PAD_LEFT); ?></span><?php echo esc_html($label); ?></span>
                            <span class="arr">→</span>
                        </a>
                    <?php endforeach; ?>
                </div>

                <div class="info-card">
                    <div class="eyebrow">Запитване</div>
                    <h4>Имате нужда от оферта за вашия обект?</h4>
                    <p>Изпратете ни запитване — отговор до 48 часа, безплатен оглед и предварителна
                        количествено-стойностна сметка.</p>
                    <a href="<?php echo esc_url(home_url('/kontakti/')); ?>" class="btn ghost">Контакти →</a>
                </div>
            </aside>

        </div>
    </div>
</section>

<!-- Mission band -->
<section class="mission-band">
    <div class="container">
        <div class="mission-grid">
            <div>
                <div class="eyebrow">Нашите принципи / 02</div>
                <h2>Това, в което вярваме на обекта.</h2>
            </div>
            <div class="mission-cards">
                <?php foreach ($missions as $i => $m): ?>
                    <div class="mission-card">
                        <div class="num">/ <?php echo str_pad($i + 1, 2, '0', STR_PAD_LEFT); ?></div>
                        <h4><?php echo esc_html($m['title']); ?></h4>
                        <p><?php echo esc_html($m['text']); ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>

<!-- Team — Management -->
<section class="team-block">
    <div class="container">
        <div class="team-head">
            <div>
                <div class="eyebrow">Екип / 03</div>
                <h2>Мениджърски екип</h2>
            </div>
            <div class="right">Мениджърският екип на ВАК ИНВЕСТ 86 ЕООД, гр. Самоков, се състои от висококвалифицирани
                специалисти с богат опит в областта на строителството.</div>
        </div>
        <div class="team-grid cols-1">
            <?php foreach ($management as $m): ?>
                <div class="person" style="max-width: 720px;">
                    <div class="avatar">
                        <span class="initials"><?php echo esc_html($initials($m['name'])); ?></span>
                        <span class="badge"></span>
                    </div>
                    <div class="info">
                        <div class="role-tag"><?php echo esc_html($m['role']); ?></div>
                        <h4><?php echo esc_html($m['name']); ?></h4>
                        <div class="title"><?php echo esc_html($m['title']); ?></div>
                        <?php if (!empty($m['extra'])): ?>
                            <span class="extra"><?php echo esc_html($m['extra']); ?></span>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Team — Administration -->
<section class="team-block" style="padding-top: 0;">
    <div class="container">
        <div class="team-head">
            <div>
                <div class="eyebrow">Екип / 04</div>
                <h2>Администрация</h2>
            </div>
            <div class="right">Финансово управление, документооборот и техническа организация на обектите.</div>
        </div>
        <div class="team-grid">
            <?php foreach ($administration as $m): ?>
                <div class="person">
                    <div class="avatar">
                        <span class="initials"><?php echo esc_html($initials($m['name'])); ?></span>
                        <span class="badge"></span>
                    </div>
                    <div class="info">
                        <div class="role-tag"><?php echo esc_html($m['role']); ?></div>
                        <h4><?php echo esc_html($m['name']); ?></h4>
                        <div class="title"><?php echo esc_html($m['title']); ?></div>
                        <?php if (!empty($m['extra'])): ?>
                            <span class="extra"><?php echo esc_html($m['extra']); ?></span>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Team — Specialists -->
<section class="team-block" style="padding-top: 0;">
    <div class="container">
        <div class="team-head">
            <div>
                <div class="eyebrow">Екип / 05</div>
                <h2>Специалисти</h2>
            </div>
            <div class="right">Инженерният състав, който отговаря за качеството и техническото изпълнение на всеки
                обект.</div>
        </div>
        <div class="team-grid">
            <?php foreach ($specialists as $m): ?>
                <div class="person">
                    <div class="avatar">
                        <span class="initials"><?php echo esc_html($initials($m['name'])); ?></span>
                        <span class="badge"></span>
                    </div>
                    <div class="info">
                        <div class="role-tag"><?php echo esc_html($m['role']); ?></div>
                        <h4><?php echo esc_html($m['name']); ?></h4>
                        <div class="title"><?php echo esc_html($m['title']); ?></div>
                        <?php if (!empty($m['extra'])): ?>
                            <span class="extra"><?php echo esc_html($m['extra']); ?></span>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<?php get_footer();
