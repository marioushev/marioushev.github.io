<?php
/**
 * Template Name: Сертификати
 */
get_header();

$banner_img = vi_opt('sertifikati_banner_image');
?>

<section class="page-banner">
    <div class="bg"<?php if ($banner_img) echo ' style="background-image:url(' . esc_url($banner_img) . ')"'; ?>></div>
    <div class="container">
        <nav class="crumb" aria-label="Breadcrumb">
            <a href="<?php echo esc_url(home_url('/')); ?>">Начало</a>
            <span class="sep">/</span>
            <span class="current">Сертификати</span>
        </nav>
        <h1>Сертификати.</h1>
        <div class="meta-row">
            <div><span class="v">/01</span> ISO 9001 / 14001 / 45001</div>
            <div><span class="v">/02</span> КСБ</div>
            <div><span class="v">/03</span> 5 ГРУПИ СТРОЕЖИ</div>
        </div>
    </div>
</section>

<section class="block">
    <div class="container">

        <!-- Сертификати -->
        <div class="certs-subsection" data-lightbox-group="certs">
            <div class="subhead">
                <div class="eyebrow">Системи за управление / 01</div>
                <h2>Сертификати</h2>
            </div>
            <div class="certs-portrait-grid">
                <?php
                $certs = [
                    [
                        'title' => 'ISO 9001:2015',
                        'desc'  => 'Управление на качеството',
                        'image' => vi_opt('cert_iso9001_image'),
                        'icon'  => 'trophy',
                    ],
                    [
                        'title' => 'ISO 14001:2015',
                        'desc'  => 'Околна среда',
                        'image' => vi_opt('cert_iso14001_image'),
                        'icon'  => 'leaf',
                    ],
                    [
                        'title' => 'ISO 45001:2018',
                        'desc'  => 'Здраве и безопасност при работа',
                        'image' => vi_opt('cert_iso45001_image'),
                        'icon'  => 'safety-vest',
                    ],
                ];
                foreach ($certs as $c) : ?>
                <figure class="cert-portrait-item">
                    <a href="<?php echo $c['image'] ? esc_url($c['image']) : '#'; ?>"
                       class="cert-portrait-link<?php echo $c['image'] ? ' js-lightbox' : ''; ?>"
                       data-group="certs"
                       aria-label="<?php echo esc_attr($c['title']); ?>">
                        <?php if ($c['image']) : ?>
                            <img src="<?php echo esc_url($c['image']); ?>" alt="<?php echo esc_attr($c['title']); ?>" loading="lazy">
                        <?php else : ?>
                            <div class="cert-portrait-placeholder"><?php echo vakinvest_icon($c['icon']); ?></div>
                        <?php endif; ?>
                    </a>
                    <figcaption>
                        <strong><?php echo esc_html($c['title']); ?></strong>
                        <span><?php echo esc_html($c['desc']); ?></span>
                    </figcaption>
                </figure>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Удостоверения -->
        <div class="certs-subsection" data-lightbox-group="udostoverenia">
            <div class="subhead">
                <div class="eyebrow">Камара на строителите / 02</div>
                <h2>Удостоверения</h2>
            </div>
            <div class="certs-landscape-grid">
                <?php
                $udostoverenia = [
                    ['title' => 'Удостоверение Първа група',  'desc' => 'Камара на строителите в България', 'image' => vi_opt('udost_grupa1_image')],
                    ['title' => 'Удостоверение Втора група',  'desc' => 'Камара на строителите в България', 'image' => vi_opt('udost_grupa2_image')],
                    ['title' => 'Удостоверение Трета група',  'desc' => 'Камара на строителите в България', 'image' => vi_opt('udost_grupa3_image')],
                    ['title' => 'Удостоверение Четвърта група','desc' => 'Камара на строителите в България', 'image' => vi_opt('udost_grupa4_image')],
                    ['title' => 'Удостоверение Пета група',   'desc' => 'Камара на строителите в България', 'image' => vi_opt('udost_grupa5_image')],
                ];
                foreach ($udostoverenia as $u) : ?>
                <figure class="cert-landscape-item">
                    <a href="<?php echo $u['image'] ? esc_url($u['image']) : '#'; ?>"
                       class="cert-landscape-link<?php echo $u['image'] ? ' js-lightbox' : ''; ?>"
                       data-group="udostoverenia"
                       aria-label="<?php echo esc_attr($u['title']); ?>">
                        <?php if ($u['image']) : ?>
                            <img src="<?php echo esc_url($u['image']); ?>" alt="<?php echo esc_attr($u['title']); ?>" loading="lazy">
                        <?php else : ?>
                            <div class="cert-landscape-placeholder"><?php echo vakinvest_icon('document'); ?></div>
                        <?php endif; ?>
                    </a>
                    <figcaption>
                        <strong><?php echo esc_html($u['title']); ?></strong>
                        <span><?php echo esc_html($u['desc']); ?></span>
                    </figcaption>
                </figure>
                <?php endforeach; ?>
            </div>
        </div>

    </div>
</section>

<?php get_footer();
