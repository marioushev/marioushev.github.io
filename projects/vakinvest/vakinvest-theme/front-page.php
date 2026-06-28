<?php get_header(); ?>

<!-- =============================================
     HERO SLIDER
     ============================================= -->
<?php
$hero_img = vi_opt('hero_image');
$slides = [
    [
        'tag' => 'Проект 01 / Жилищна сграда',
        'meta' => 'Завършен 2024',
        'title' => vi_opt('hero_title', 'Строителство, което <em>остава</em> поколения напред.'),
        'lead' => vi_opt('hero_lead', 'VAK INVEST 86 — пълен цикъл на проектиране и строителство на жилищни, обществени и инфраструктурни обекти в Североизточна България от 2016 г.'),
        'image' => vi_opt('hero_slide1_image', $hero_img),
        'cta1' => ['Изпълнени проекти →', home_url('/proekti/')],
        'cta2' => ['Поискай оферта', home_url('/kontakti/')],
    ],
    [
        'tag' => 'Проект 02 / Многофамилна сграда',
        'meta' => 'Реализация 2023',
        'title' => vi_opt('hero_slide2_title', 'Висококачествен <em>груб строеж</em> и довършителни работи.'),
        'lead' => vi_opt('hero_slide2_lead', 'Проектиране, изграждане, изолации и инсталации — един екип, един отговорник, гарантирани срокове.'),
        'image' => vi_opt('hero_slide2_image', $hero_img),
        'cta1' => ['Нашите услуги →', home_url('/uslugi/')],
        'cta2' => ['Механизация', home_url('/mehanizaciya/')],
    ],
    [
        'tag' => 'Проект 03 / Благоустрояване',
        'meta' => 'Завършен 2024',
        'title' => vi_opt('hero_slide3_title', 'От <em>идеята</em> до ключа — изцяло in-house.'),
        'lead' => vi_opt('hero_slide3_lead', 'Собствена механизация, висококвалифициран екип от специалисти и сертифицирана система за качество ISO 9001 / 14001 / 45001.'),
        'image' => vi_opt('hero_slide3_image', $hero_img),
        'cta1' => ['За компанията →', home_url('/za-nas/')],
        'cta2' => ['Сертификати', home_url('/sertifikati/')],
    ],
];
?>
<section class="hero" data-autoplay="6500">
    <?php foreach ($slides as $i => $s): ?>
        <div class="hero-slide<?php echo $i === 0 ? ' active' : ''; ?>" data-slide="<?php echo $i; ?>">
            <div class="hero-slide-bg" <?php if ($s['image'])
                echo ' style="background-image:url(' . esc_url($s['image']) . ')"'; ?>></div>
            <div class="hero-content container">
                <div class="hero-meta">
                    <span class="dot"></span>
                    <span><?php echo esc_html($s['tag']); ?></span>
                    <span class="bar"></span>
                    <span><?php echo esc_html($s['meta']); ?></span>
                </div>
                <?php if ($i === 0): ?>
                    <h1><?php echo wp_kses($s['title'], ['em' => []]); ?></h1>
                <?php else: ?>
                    <h2 class="hero-headline"><?php echo wp_kses($s['title'], ['em' => []]); ?></h2>
                <?php endif; ?>
                <p class="hero-lead"><?php echo esc_html($s['lead']); ?></p>
                <div class="hero-actions">
                    <a href="<?php echo esc_url($s['cta1'][1]); ?>" class="btn"><?php echo esc_html($s['cta1'][0]); ?></a>
                    <a href="<?php echo esc_url($s['cta2'][1]); ?>"
                        class="btn ghost"><?php echo esc_html($s['cta2'][0]); ?></a>
                </div>
            </div>
        </div>
    <?php endforeach; ?>

    <div class="hero-nav">
        <div class="container">
            <div class="slide-counter">
                <span class="current">01</span><span class="sep">/</span><span
                    class="total"><?php echo str_pad(count($slides), 2, '0', STR_PAD_LEFT); ?></span>
            </div>
            <div class="slide-progress">
                <div class="fill" style="width:0%"></div>
            </div>
            <div class="slide-arrows">
                <button class="arrow" id="hero-prev" type="button" aria-label="Предишен слайд">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M15 18l-6-6 6-6" />
                    </svg>
                </button>
                <button class="arrow" id="hero-next" type="button" aria-label="Следващ слайд">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M9 18l6-6-6-6" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
</section>

<!-- =============================================
     SERVICES (5-card grid)
     ============================================= -->
<section class="block" id="uslugi">
    <div class="container">
        <div class="section-head">
            <div class="left">
                <div class="eyebrow">Какво правим / 01</div>
                <h2 class="section-title">Нашите услуги</h2>
            </div>
            <div class="right">
                Пълен цикъл строителство — от проектиране и груб строеж до инсталации, изолации и пътно строителство.
                Един изпълнител за целия Ви обект.
            </div>
        </div>
        <div class="services-grid">
            <?php
            $home_services = [
                [
                    'slug' => 'proektirane',
                    'num' => '01',
                    'title' => 'Проектиране и строителство',
                    'items' => ['Изкопни работи', 'Груб строеж', 'Покривни конструкции'],
                ],
                [
                    'slug' => 'el-vik',
                    'num' => '02',
                    'title' => 'Ел. и ВиК инсталации',
                    'items' => ['Електрически инсталации', 'ВиК инсталации'],
                ],
                [
                    'slug' => 'dovarshitelni',
                    'num' => '03',
                    'title' => 'Довършителни работи',
                    'items' => ['Външна и вътрешна мазилка', 'Шпакловки'],
                ],
                [
                    'slug' => 'izolacii',
                    'num' => '04',
                    'title' => 'Изолации',
                    'items' => ['Топлоизолация', 'Хидроизолация'],
                ],
                [
                    'slug' => 'patno',
                    'num' => '05',
                    'title' => 'Пътно строителство',
                    'items' => ['Хидроизолация на мостове', 'Канавки и дерета'],
                ],
            ];
            foreach ($home_services as $s):
                $img = vi_opt('home_service_' . $s['slug'] . '_image');
                ?>
                <a class="service-card" href="<?php echo esc_url(home_url('/uslugi/' . $s['slug'] . '/')); ?>">
                    <div class="photo" <?php if ($img)
                        echo ' style="background-image:url(' . esc_url($img) . ')"'; ?>>
                        <span class="num"><?php echo esc_html($s['num']); ?></span>
                    </div>
                    <div class="body">
                        <h3><?php echo esc_html($s['title']); ?></h3>
                        <ul>
                            <?php foreach ($s['items'] as $item): ?>
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

<!-- =============================================
     VALUES BAND (full-bleed, 4-col, dark)
     ============================================= -->
<section class="values">
    <div class="value">
        <div class="num">01</div>
        <div class="icon">
            <svg width="40" height="40" viewBox="0 0 40 40" fill="none" stroke="currentColor" stroke-width="1.5">
                <circle cx="20" cy="20" r="14" />
                <path d="M14 20l4 4 8-8" />
            </svg>
        </div>
        <h4>Високо качество в реални срокове</h4>
    </div>
    <div class="value">
        <div class="num">02</div>
        <div class="icon">
            <svg width="40" height="40" viewBox="0 0 40 40" fill="none" stroke="currentColor" stroke-width="1.5">
                <rect x="6" y="14" width="28" height="20" />
                <path d="M12 14V8m16 6V8M6 22h28" />
            </svg>
        </div>
        <h4>Най-съвременни технологии в строителството</h4>
    </div>
    <div class="value">
        <div class="num">03</div>
        <div class="icon">
            <svg width="40" height="40" viewBox="0 0 40 40" fill="none" stroke="currentColor" stroke-width="1.5">
                <circle cx="14" cy="14" r="5" />
                <circle cx="28" cy="18" r="4" />
                <path d="M5 32c1-5 5-8 9-8s8 3 9 8M22 32c1-3 4-5 7-5s5 2 6 5" />
            </svg>
        </div>
        <h4>Висококвалифициран екип от специалисти</h4>
    </div>
    <div class="value">
        <div class="num">04</div>
        <div class="icon">
            <svg width="40" height="40" viewBox="0 0 40 40" fill="none" stroke="currentColor" stroke-width="1.5">
                <path d="M20 6c-6 0-10 4-10 10 0 4 2 6 4 8v4h12v-4c2-2 4-4 4-8 0-6-4-10-10-10zM16 32h8M18 36h4" />
            </svg>
        </div>
        <h4>Оригинални идеи и отлично изпълнение</h4>
    </div>
</section>

<!-- =============================================
     ABOUT (2-col with image + frame tag)
     ============================================= -->
<section class="block" id="za-nas">
    <div class="container">
        <div class="about-grid">
            <div class="about-copy">
                <div class="eyebrow">Повече за нас / 02</div>
                <h2 class="section-title" style="margin-top:14px">
                    <?php echo esc_html(vi_opt('home_about_headline', 'Дългогодишен опит в строителството.')); ?>
                </h2>
                <p><?php echo esc_html(vi_opt('home_about_p1', 'Специализираме в областта на проектирането и строителството на жилищни, обществени и инфраструктурни обекти. Нашият стремеж е постигането на високо качество в реални срокове чрез прилагане на най-съвременни технологии.')); ?>
                </p>
                <p><?php echo esc_html(vi_opt('home_about_p2', 'Гарантираме професионално и отговорно отношение към работата и нашите клиенти, висококвалифициран екип от специалисти, оригинални проекти, висококачествени материали и отлично изпълнение.')); ?>
                </p>
                <a href="<?php echo esc_url(home_url('/za-nas/')); ?>" class="btn dark" style="margin-top:32px">Прочети
                    повече →</a>

                <div class="about-stats">
                    <div class="stat">
                        <div class="num"><?php echo esc_html(vi_opt('home_stat_years', '9')); ?><span>+</span></div>
                        <div class="label">Години опит</div>
                    </div>
                    <div class="stat">
                        <div class="num"><?php echo esc_html(vi_opt('home_stat_projects', '240')); ?><span>+</span>
                        </div>
                        <div class="label">Завършени обекта</div>
                    </div>
                    <div class="stat">
                        <div class="num"><?php echo esc_html(vi_opt('home_stat_machines', '17')); ?></div>
                        <div class="label">Машини в парка</div>
                    </div>
                </div>
            </div>
            <div class="about-visual">
                <?php $about_img = vi_opt('home_about_image'); ?>
                <div class="img-main" <?php if ($about_img)
                    echo ' style="background-image:url(' . esc_url($about_img) . ')"'; ?>></div>
                <!-- <div class="frame-tag">
                    <div class="label">Активен проект</div>
                    <div class="val">
                        <?php echo esc_html(vi_opt('home_about_active', 'Многофамилна жилищна сграда — Шумен, 2024–2026')); ?>
                    </div>
                </div> -->
            </div>
        </div>
    </div>
</section>

<!-- =============================================
     CERTIFICATES (gray section, 4 circular seals)
     ============================================= -->
<section class="block gray" id="sertifikati">
    <div class="container">
        <div class="section-head">
            <div class="left">
                <div class="eyebrow">Сертификати / 03</div>
                <h2 class="section-title">Сертификати и удостоверения</h2>
            </div>
            <div class="right">
                Системи за управление по ISO 9001, 14001 и 45001. Вписани в Камарата на строителите в България.
            </div>
        </div>
        <div class="cert-row">
            <?php
            $home_certs = [
                ['line1' => 'ISO', 'line2' => '9001', 'title' => 'Управление<br>на качеството', 'meta' => 'ISO 9001:2015'],
                ['line1' => 'ISO', 'line2' => '14001', 'title' => 'Околна<br>среда', 'meta' => 'ISO 14001:2015'],
                ['line1' => 'КСБ', 'line2' => 'I гр.', 'title' => 'Удостоверение<br>първа група', 'meta' => 'Камара на строителите'],
                ['line1' => 'КСБ', 'line2' => 'II гр.', 'title' => 'Удостоверение<br>втора група', 'meta' => 'Камара на строителите'],
            ];
            foreach ($home_certs as $c): ?>
                <div class="cert">
                    <div class="seal">
                        <div class="seal-name"><?php echo esc_html($c['line1']); ?><br><?php echo esc_html($c['line2']); ?>
                        </div>
                    </div>
                    <h4><?php echo wp_kses($c['title'], ['br' => []]); ?></h4>
                    <div class="meta"><?php echo esc_html($c['meta']); ?></div>
                </div>
            <?php endforeach; ?>
        </div>
        <div style="text-align:center; margin-top:48px">
            <a href="<?php echo esc_url(home_url('/sertifikati/')); ?>" class="btn dark">Виж всички сертификати →</a>
        </div>
    </div>
</section>

<!-- =============================================
     MACHINERY (full-bleed dark section)
     ============================================= -->
<section class="block dark" id="mehanizaciya">
    <div class="container">
        <div class="section-head">
            <div class="left">
                <div class="eyebrow">Парк / 04</div>
                <h2 class="section-title">Налична механизация</h2>
            </div>
            <div class="right">
                Собствен парк от 17 машини и съоръжения. Без подизпълнители за основната тежка механизация — гарантирани
                срокове и пълен контрол.
            </div>
        </div>
        <div class="machinery-grid">
            <?php
            $home_equip = [
                ['id' => 'M-01', 'title' => 'Багер товарач', 'qty' => '3 БР.', 'placeholder' => 'снимка / багер'],
                ['id' => 'M-02', 'title' => 'Самосвал', 'qty' => '4 БР.', 'placeholder' => 'снимка / самосвал'],
                ['id' => 'M-03', 'title' => 'Бобкат', 'qty' => '2 БР.', 'placeholder' => 'снимка / бобкат'],
                ['id' => 'M-04', 'title' => 'Валяк', 'qty' => '2 БР.', 'placeholder' => 'снимка / валяк'],
            ];
            foreach ($home_equip as $eq): ?>
                <div class="machine">
                    <div class="photo placeholder-img"><?php echo esc_html($eq['placeholder']); ?></div>
                    <div class="body">
                        <div class="id"><?php echo esc_html($eq['id']); ?></div>
                        <h4><?php echo esc_html($eq['title']); ?></h4>
                        <span class="qty"><?php echo esc_html($eq['qty']); ?></span>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <div style="text-align:center; margin-top:48px">
            <a href="<?php echo esc_url(home_url('/mehanizaciya/')); ?>" class="btn">Виж цялата механизация →</a>
        </div>
    </div>
</section>

<!-- =============================================
     NEWS (3-col with feature card)
     ============================================= -->
<!-- <?php
$news = new WP_Query([
    'post_type' => 'post',
    'posts_per_page' => 3,
    'post_status' => 'publish',
]);
if ($news->have_posts()): ?>
    <section class="block">
        <div class="container">
            <div class="section-head">
                <div class="left">
                    <div class="eyebrow">Новини / 05</div>
                    <h2 class="section-title">Последно от обекта</h2>
                </div>
                <div class="right">
                    Текущи проекти, обновления на оборудването и новини от компанията.
                </div>
            </div>
            <div class="news-grid">
                <?php $i = 0;
                while ($news->have_posts()):
                    $news->the_post();
                    $i++; ?>
                    <a class="news-card<?php echo $i === 1 ? ' feature' : ''; ?>" href="<?php the_permalink(); ?>">
                        <div class="photo" <?php
                        $thumb = get_the_post_thumbnail_url(get_the_ID(), 'large');
                        if ($thumb)
                            echo ' style="background-image:url(' . esc_url($thumb) . ')"';
                        ?>></div>
                        <div class="body">
                            <div class="date"><?php echo esc_html(get_the_date('j F Y')); ?></div>
                            <h3><?php the_title(); ?></h3>
                            <span class="read">Виж повече →</span>
                        </div>
                    </a>
                <?php endwhile;
                wp_reset_postdata(); ?>
            </div>
        </div>
    </section>
<?php endif; ?> -->

<!-- =============================================
     CTA BANNERS PAIR
     ============================================= -->
<section class="cta-pair-section">
    <div class="cta-pair">
        <a class="cta-banner" href="<?php echo esc_url(home_url('/proekti/')); ?>">
            <?php $cta1_img = vi_opt('cta_projects_image'); ?>
            <div class="bg" <?php if ($cta1_img)
                echo ' style="background-image:url(' . esc_url($cta1_img) . ')"'; ?>>
            </div>
            <div>
                <div class="cta-eyebrow">Портфолио · 240+ обекта</div>
                <h3>Разгледайте изпълнените ни проекти.</h3>
            </div>
            <div class="actions"><span class="btn">Към проектите →</span></div>
        </a>
        <a class="cta-banner teal" href="<?php echo esc_url(home_url('/kontakti/')); ?>" id="kontakti">
            <?php $cta2_img = vi_opt('cta_contact_image'); ?>
            <div class="bg" <?php if ($cta2_img)
                echo ' style="background-image:url(' . esc_url($cta2_img) . ')"'; ?>>
            </div>
            <div>
                <div class="cta-eyebrow">Безплатно запитване · отговор до 48ч</div>
                <h3>Поискайте оферта и за вашия проект.</h3>
            </div>
            <div class="actions"><span class="btn dark">Към контакти →</span></div>
        </a>
    </div>
</section>

<?php get_footer();
