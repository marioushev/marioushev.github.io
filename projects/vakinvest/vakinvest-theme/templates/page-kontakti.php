<?php
/**
 * Template Name: Контакти
 */
get_header();

/* Generate math captcha */
$cap_a = wp_rand(2, 12);
$cap_b = wp_rand(2, 12);
$cap_sum = $cap_a + $cap_b;
$cap_token = vakinvest_captcha_token($cap_sum);

$banner_img = vi_opt('contact_banner_image');
$phone = vi_opt('company_phone', '+359 87 631 3061');
// $phone2 = vi_opt('company_phone2', '+359 54 80 28 15');
// $phone3 = vi_opt('company_phone3', '+359 888 50 17 10');
// $fax = vi_opt('company_fax', '+359 54 80 15 10');
$email = vi_opt('company_email', 'vak-invest86@abv.bg');
// $email2 = vi_opt('company_email2', 'offers@vakinvest86.bg');
// $website = vi_opt('company_web', 'www.vakinvest86.bg');
$addr_line1 = vi_opt('company_addr1', 'гр. София, р-н Лозенец, Черни връх, 27');
// $addr_line2 = vi_opt('company_addr2', 'ул. „Околовръстен път”, 373');
$addr_sub = vi_opt('company_region', 'Североизточна България');
$map_url = vi_opt('company_map_link', 'https://maps.google.com/?q=' . urlencode($addr_line1 . ' ' . $addr_line2));
$coords = vi_opt('company_coords', '43.2706° N · 26.9230° E');
?>

<!-- Page banner -->
<section class="page-banner">
    <div class="bg" <?php if ($banner_img)
        echo ' style="background-image:url(' . esc_url($banner_img) . ')"'; ?>></div>
    <div class="container">
        <nav class="crumb" aria-label="Breadcrumb">
            <a href="<?php echo esc_url(home_url('/')); ?>">Начало</a>
            <span class="sep">/</span>
            <span class="current">Контакти</span>
        </nav>
        <h1>Контакти.</h1>
        <div class="meta-row">
            <div><span class="v">/01</span> ОТГОВОР ДО 48Ч</div>
            <div><span class="v">/02</span> БЕЗПЛАТЕН ОГЛЕД</div>
            <div><span class="v">/03</span> ПРЕДВАРИТЕЛНА КСС</div>
        </div>
    </div>
</section>

<!-- Main contact section -->
<section class="block">
    <div class="container">

        <div class="contact-intro">
            <div class="eyebrow">Свържете се с нас / 01</div>
            <h2>Изпратете ни запитване — отговор до 48 часа.</h2>
        </div>

        <div class="contact-grid">

            <!-- Dark info column -->
            <div class="contact-info-col">
                <div class="eyebrow">Офис · Шумен</div>
                <h2>Един отговорник, един телефон, един срок.</h2>
                <p class="lead">Можете да ни намерите в офиса в центъра на Шумен или директно на обекта. За оферти
                    използвайте формата вдясно или ни се обадете.</p>

                <div class="info-list">
                    <div class="info-row">
                        <div class="icon">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="1.6">
                                <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 1118 0z" />
                                <circle cx="12" cy="10" r="3" />
                            </svg>
                        </div>
                        <div class="lab">Адрес</div>
                        <div class="val">
                            <?php echo esc_html($addr_line1); ?><br>
                            <?php echo esc_html($addr_line2); ?>
                            <?php if ($addr_sub): ?><span
                                    class="sub"><?php echo esc_html($addr_sub); ?></span><?php endif; ?>
                        </div>
                    </div>

                    <div class="info-row">
                        <div class="icon">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="1.6">
                                <path
                                    d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07 19.5 19.5 0 01-6-6 19.79 19.79 0 01-3.07-8.67A2 2 0 014.11 2h3a2 2 0 012 1.72c.13.96.36 1.9.7 2.81a2 2 0 01-.45 2.11L8.09 9.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45c.91.34 1.85.57 2.81.7a2 2 0 011.72 2.03z" />
                            </svg>
                        </div>
                        <div class="lab">Телефон</div>
                        <div class="val">
                            <a
                                href="tel:<?php echo esc_attr(preg_replace('/\s+/', '', $phone)); ?>"><?php echo esc_html($phone); ?></a>
                            <span class="sub">Централа</span>
                            <!-- <?php if ($phone2): ?>
                            <a href="tel:<?php echo esc_attr(preg_replace('/\s+/', '', $phone2)); ?>"
                                style="display:block;margin-top:8px"><?php echo esc_html($phone2); ?></a>
                            <span class="sub">Счетоводство</span>
                            <?php endif; ?>
                            <?php if ($phone3): ?>
                            <a href="tel:<?php echo esc_attr(preg_replace('/\s+/', '', $phone3)); ?>"
                                style="display:block;margin-top:8px"><?php echo esc_html($phone3); ?></a>
                            <span class="sub">Мобилен / 24ч</span>
                            <?php endif; ?> -->
                        </div>
                    </div>

                    <div class="info-row">
                        <div class="icon">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="1.6">
                                <rect x="3" y="6" width="18" height="14" rx="1" />
                                <path d="M3 8l9 6 9-6" />
                            </svg>
                        </div>
                        <div class="lab">E-mail</div>
                        <div class="val">
                            <a href="mailto:<?php echo esc_attr($email); ?>"><?php echo esc_html($email); ?></a>
                            <span class="sub">Общи запитвания</span>
                            <!-- <?php if ($email2): ?>
                            <a href="mailto:<?php echo esc_attr($email2); ?>"
                                style="display:block;margin-top:8px"><?php echo esc_html($email2); ?></a>
                            <span class="sub">Офертен отдел</span>
                            <?php endif; ?> -->
                        </div>
                    </div>

                    <!-- <?php if ($fax): ?>
                    <div class="info-row">
                        <div class="icon">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="1.6">
                                <rect x="6" y="9" width="12" height="9" />
                                <path d="M6 18v3h12v-3M6 9V3h12v6" />
                                <circle cx="9" cy="13" r="0.5" fill="currentColor" />
                            </svg>
                        </div>
                        <div class="lab">Факс</div>
                        <div class="val"><?php echo esc_html($fax); ?></div>
                    </div>
                    <?php endif; ?> -->

                    <!-- <?php if ($website): ?>
                        <div class="info-row">
                            <div class="icon">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="1.6">
                                    <circle cx="12" cy="12" r="10" />
                                    <path d="M2 12h20M12 2a15 15 0 010 20M12 2a15 15 0 000 20" />
                                </svg>
                            </div>
                            <div class="lab">Web</div>
                            <div class="val"><a
                                    href="<?php echo esc_url(home_url('/')); ?>"><?php echo esc_html($website); ?></a></div>
                        </div>
                    <?php endif; ?> -->
                </div>

                <div class="quick-links">
                    <a class="quick-link" href="tel:<?php echo esc_attr(preg_replace('/\s+/', '', $phone)); ?>">
                        <span class="num">/ 01</span>
                        <span class="label">Обади се сега</span>
                        <span class="arr">CALL →</span>
                    </a>
                    <a class="quick-link" href="<?php echo esc_url($map_url); ?>" target="_blank"
                        rel="noopener noreferrer">
                        <span class="num">/ 02</span>
                        <span class="label">Маршрут до офиса</span>
                        <span class="arr">MAPS →</span>
                    </a>
                </div>
            </div>

            <!-- Form column -->
            <div class="form-col" id="form-col">
                <div class="eyebrow">Форма за запитване / 02</div>
                <h3>Опишете ни вашия проект.</h3>
                <p class="sub">Полетата отбелязани с <span class="req">*</span> са задължителни. Ще се свържем с вас в
                    рамките на 48 работни часа.</p>

                <?php vakinvest_form_notice(); ?>

                <form id="contact-form" class="contact-form" method="POST" action="" novalidate>
                    <?php wp_nonce_field('vi_contact_form', 'vi_nonce'); ?>
                    <input type="hidden" name="vi_contact_submit" value="1">
                    <input type="hidden" name="vi_captcha_token" value="<?php echo esc_attr($cap_token); ?>">

                    <div class="row">
                        <div class="field">
                            <label for="vi_name">Вашето име <span class="req">*</span></label>
                            <input type="text" id="vi_name" name="vi_name"
                                value="<?php echo esc_attr($_POST['vi_name'] ?? ''); ?>" placeholder="Иван Петров"
                                required autocomplete="name">
                            <div class="err-msg" data-for="vi_name"></div>
                        </div>
                        <div class="field">
                            <label for="vi_phone">Телефон <span class="req">*</span></label>
                            <input type="tel" id="vi_phone" name="vi_phone"
                                value="<?php echo esc_attr($_POST['vi_phone'] ?? ''); ?>" placeholder="+359 888 000 000"
                                required autocomplete="tel">
                            <div class="err-msg" data-for="vi_phone"></div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="field">
                            <label for="vi_email">E-mail <span class="req">*</span></label>
                            <input type="email" id="vi_email" name="vi_email"
                                value="<?php echo esc_attr($_POST['vi_email'] ?? ''); ?>" placeholder="ivan@example.com"
                                required autocomplete="email">
                            <div class="err-msg" data-for="vi_email"></div>
                        </div>
                        <div class="field">
                            <label for="vi_city">Населено място</label>
                            <input type="text" id="vi_city" name="vi_city"
                                value="<?php echo esc_attr($_POST['vi_city'] ?? ''); ?>" placeholder="София">
                            <div class="err-msg" data-for="vi_city"></div>
                        </div>
                    </div>

                    <div class="row single">
                        <div class="field full">
                            <label for="vi_message">Вашето съобщение <span class="req">*</span></label>
                            <textarea id="vi_message" name="vi_message"
                                placeholder="Опишете обекта, желания обхват на услугите и срок на реализация…"
                                required><?php echo esc_textarea($_POST['vi_message'] ?? ''); ?></textarea>
                            <div class="err-msg" data-for="vi_message"></div>
                        </div>
                    </div>

                    <label class="gdpr" id="gdpr-block">
                        <input type="checkbox" name="vi_gdpr" value="1" id="vi_gdpr" <?php checked(!empty($_POST['vi_gdpr'])); ?> required>
                        <span class="check">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="3">
                                <path d="M5 12l5 5L20 7" />
                            </svg>
                        </span>
                        <span class="text">
                            Съгласен/на съм личните ми данни да бъдат обработени за целите на запитването, съгласно <a
                                href="<?php echo esc_url(home_url('/politika-za-poveritelnost/')); ?>"
                                target="_blank">Политиката за поверителност</a>. <span class="req">*</span>
                        </span>
                    </label>

                    <div class="submit-row">
                        <div class="captcha">
                            <span class="label">Потвърждение</span>
                            <span class="eq"><?php echo esc_html($cap_a); ?> + <?php echo esc_html($cap_b); ?> =</span>
                            <input type="number" id="vi_captcha" name="vi_captcha" min="0" max="99" placeholder="?"
                                required>
                            <span id="captcha-status" aria-live="polite"></span>
                        </div>
                        <button type="submit" class="btn lg" id="vi-submit-btn">
                            Изпращане
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2">
                                <path d="M5 12h14M12 5l7 7-7 7" />
                            </svg>
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</section>

<!-- Map -->
<section class="map-section block tight" id="map-section">
    <div class="container">
        <div class="map-head">
            <div class="eyebrow">Локация / 03</div>
            <h3>Адреса ни.</h3>
        </div>
    </div>
    <div class="map-wrap">
        <div class="map-canvas"></div>
        <div class="map-grid"></div>
        <div class="map-roads">
            <svg viewBox="0 0 1200 480" preserveAspectRatio="xMidYMid slice">
                <path d="M 0 240 L 1200 220" stroke="rgba(15,39,72,.5)" stroke-width="14" fill="none" />
                <path d="M 0 240 L 1200 220" stroke="white" stroke-width="9" fill="none" />
                <path d="M 0 240 L 1200 220" stroke="rgba(15,39,72,.3)" stroke-width="0.5" fill="none"
                    stroke-dasharray="14 14" />
                <path d="M 200 0 L 220 480" stroke="rgba(15,39,72,.5)" stroke-width="10" fill="none" />
                <path d="M 200 0 L 220 480" stroke="white" stroke-width="6" fill="none" />
                <path d="M 800 0 L 780 480" stroke="rgba(15,39,72,.5)" stroke-width="10" fill="none" />
                <path d="M 800 0 L 780 480" stroke="white" stroke-width="6" fill="none" />
                <path d="M 0 100 Q 600 130 1200 90" stroke="rgba(15,39,72,.35)" stroke-width="6" fill="none" />
                <path d="M 0 100 Q 600 130 1200 90" stroke="white" stroke-width="3" fill="none" />
                <path d="M 0 380 Q 600 410 1200 370" stroke="rgba(15,39,72,.35)" stroke-width="6" fill="none" />
                <path d="M 0 380 Q 600 410 1200 370" stroke="white" stroke-width="3" fill="none" />
                <path d="M 220 240 L 380 100" stroke="rgba(15,39,72,.3)" stroke-width="4" fill="none" />
                <path d="M 220 240 L 380 100" stroke="white" stroke-width="2" fill="none" />
                <path d="M 600 230 L 720 380" stroke="rgba(15,39,72,.3)" stroke-width="4" fill="none" />
                <path d="M 600 230 L 720 380" stroke="white" stroke-width="2" fill="none" />
                <rect x="240" y="120" width="60" height="80" fill="rgba(15,39,72,.08)" />
                <rect x="320" y="140" width="80" height="60" fill="rgba(15,39,72,.08)" />
                <rect x="240" y="280" width="60" height="60" fill="rgba(15,39,72,.08)" />
                <rect x="320" y="280" width="100" height="80" fill="rgba(15,39,72,.08)" />
                <rect x="850" y="140" width="80" height="60" fill="rgba(15,39,72,.08)" />
                <rect x="950" y="120" width="100" height="80" fill="rgba(15,39,72,.08)" />
                <rect x="850" y="280" width="120" height="60" fill="rgba(15,39,72,.08)" />
                <rect x="990" y="280" width="60" height="80" fill="rgba(15,39,72,.08)" />
                <rect x="540" y="280" width="80" height="60" fill="rgba(15,39,72,.08)" />
                <rect x="640" y="280" width="60" height="60" fill="rgba(15,39,72,.08)" />
                <rect x="540" y="120" width="60" height="80" fill="rgba(15,39,72,.08)" />
                <rect x="60" y="280" width="120" height="120" fill="rgba(47,122,79,.12)" />
                <text x="120" y="345" text-anchor="middle" font-family="JetBrains Mono" font-size="9"
                    fill="rgba(47,122,79,.6)" letter-spacing="1.5">ПАРК</text>
                <path d="M 0 60 Q 400 90 800 50 T 1200 40" stroke="rgba(31,126,152,.3)" stroke-width="14" fill="none"
                    stroke-linecap="round" />
            </svg>
        </div>

        <div class="map-pin">
            <span class="pulse"></span>
            <span class="pulse"></span>
            <span class="dot"></span>
        </div>

        <div class="map-info">
            <div class="label">Адрес</div>
            <h4>VAK INVEST 86</h4>
            <p><?php echo esc_html($addr_line1); ?><br><?php echo esc_html($addr_line2); ?></p>
            <a href="<?php echo esc_url($map_url); ?>" target="_blank" rel="noopener noreferrer" class="open-btn">
                Отвори в Google Maps
                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M7 17L17 7M17 7H8M17 7v9" />
                </svg>
            </a>
        </div>

        <div class="map-controls">
            <button type="button" id="map-zoom-in" aria-label="Приближи">+</button>
            <button type="button" id="map-zoom-out" aria-label="Отдалечи">−</button>
            <button type="button" id="map-reset" aria-label="Нулирай">⊙</button>
        </div>

        <div class="map-tag">
            <span class="dot"></span>
            <span class="text"><?php echo esc_html($coords); ?></span>
        </div>
    </div>
</section>

<!-- Hours -->
<section class="hours-strip">
    <div class="container">
        <div class="hours-grid">
            <div>
                <div class="eyebrow">Работно време / 04</div>
                <h3>Кога сме на разположение.</h3>
                <p>Извън работно време оставете съобщение на мобилния номер — отговаряме до 24ч.</p>
            </div>
            <div class="hours-table">
                <div class="hours-cell">
                    <div class="day">Пон — Пет</div>
                    <div class="time"><?php echo esc_html(vi_opt('hours_weekday', '08:30 — 17:30')); ?></div>
                </div>
                <div class="hours-cell">
                    <div class="day">Събота</div>
                    <div class="time"><?php echo esc_html(vi_opt('hours_saturday', '09:00 — 13:00')); ?></div>
                </div>
                <div class="hours-cell closed">
                    <div class="day">Неделя</div>
                    <div class="time"><?php echo esc_html(vi_opt('hours_sunday', 'Затворено')); ?></div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php get_footer();
