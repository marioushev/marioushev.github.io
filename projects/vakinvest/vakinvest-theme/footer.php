<?php
$phone = vi_opt('company_phone', '+359 87 631 3061');
$email = vi_opt('company_email', 'vak-invest86@abv.bg');
$addr = vi_opt('company_address', 'гр. София, р-н Лозенец, Черни връх, 27');
?>

<footer class="site-footer" role="contentinfo">
    <div class="container">

        <div class="footer-top">

            <!-- Brand -->
            <div class="footer-brand">
                <a href="<?php echo esc_url(home_url('/')); ?>" class="site-logo" aria-label="ВАК ИНВЕСТ 86">
                    <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/logo-white.png'); ?>"
                        alt="ВАК ИНВЕСТ 86">
                    <!-- <div class="logo-mark"> -->
                    <!-- </div> -->
                    <div class="logo-text">
                        <div class="name">VAK INVEST 86</div>
                        <div class="tag">Строителство · Инженерство</div>
                    </div>
                </a>
                <p>Пълен цикъл строителство в Североизточна България от 2016 г. — проектиране, изпълнение, инсталации и
                    инфраструктура.</p>
            </div>

            <!-- Services links -->
            <div class="footer-col">
                <h5>Услуги</h5>
                <?php if (has_nav_menu('footer-services')):
                    wp_nav_menu([
                        'theme_location' => 'footer-services',
                        'container' => false,
                        'menu_class' => 'footer-list',
                        'depth' => 1,
                    ]);
                else: ?>
                    <ul class="footer-list">
                        <li><a href="<?php echo esc_url(home_url('/uslugi/proektirane/')); ?>">Проектиране и
                                строителство</a></li>
                        <li><a href="<?php echo esc_url(home_url('/uslugi/el-vik/')); ?>">Ел. и ВиК инсталации</a></li>
                        <li><a href="<?php echo esc_url(home_url('/uslugi/dovarshitelni/')); ?>">Довършителни работи</a>
                        </li>
                        <li><a href="<?php echo esc_url(home_url('/uslugi/izolacii/')); ?>">Изолации</a></li>
                        <li><a href="<?php echo esc_url(home_url('/uslugi/patno/')); ?>">Пътно строителство</a></li>
                    </ul>
                <?php endif; ?>
            </div>

            <!-- About links -->
            <div class="footer-col">
                <h5>За нас</h5>
                <?php if (has_nav_menu('footer-about')):
                    wp_nav_menu([
                        'theme_location' => 'footer-about',
                        'container' => false,
                        'menu_class' => 'footer-list',
                        'depth' => 1,
                    ]);
                else: ?>
                    <ul class="footer-list">
                        <li><a href="<?php echo esc_url(home_url('/za-nas/')); ?>">За компанията</a></li>
                        <li><a href="<?php echo esc_url(home_url('/mehanizaciya/')); ?>">Механизация</a></li>
                        <li><a href="<?php echo esc_url(home_url('/proekti/')); ?>">Изпълнени проекти</a></li>
                        <li><a href="<?php echo esc_url(home_url('/sertifikati/')); ?>">Сертификати</a></li>
                        <li><a href="<?php echo esc_url(home_url('/klienti/')); ?>">Клиенти</a></li>
                        <li><a href="<?php echo esc_url(home_url('/obshti-uslovia/')); ?>">Общи условия</a></li>
                        <li><a href="<?php echo esc_url(home_url('/politika-za-poveritelnost/')); ?>">Политика за
                                поверителност</a></li>
                    </ul>
                <?php endif; ?>
            </div>

            <!-- Contact -->
            <div class="footer-col">
                <h5>Контакти</h5>
                <div class="footer-contact-row">
                    <div class="lab">Адрес</div>
                    <div class="val"><?php echo nl2br(esc_html($addr)); ?></div>
                </div>
                <div class="footer-contact-row">
                    <div class="lab">Тел.</div>
                    <div class="val">
                        <a
                            href="tel:<?php echo esc_attr(preg_replace('/\s+/', '', $phone)); ?>"><?php echo esc_html($phone); ?></a>
                        <?php $p2 = vi_opt('company_phone2');
                        if ($p2): ?>
                            <br><a
                                href="tel:<?php echo esc_attr(preg_replace('/\s+/', '', $p2)); ?>"><?php echo esc_html($p2); ?></a>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="footer-contact-row">
                    <div class="lab">E-mail</div>
                    <div class="val"><a
                            href="mailto:<?php echo esc_attr($email); ?>"><?php echo esc_html($email); ?></a></div>
                </div>
            </div>

        </div><!-- .footer-top -->

        <div class="footer-bottom">
            <span>© <?php echo date('Y'); ?> ВСИЧКИ ПРАВА ЗАПАЗЕНИ — VAK INVEST 86</span>
            <span>EIK / VAT BG · ISO 9001 / 14001 / 45001</span>
        </div>

    </div><!-- .container -->
</footer>

<!-- Back to top -->
<button class="back-to-top" id="back-to-top" aria-label="Обратно нагоре">
    <svg viewBox="0 0 24 24">
        <polyline points="18 15 12 9 6 15" />
    </svg>
</button>

<!-- Cookie consent banner -->
<div class="cookie-banner" id="cookie-banner" role="dialog" aria-live="polite" aria-label="Бисквитки" hidden>
    <p>Този сайт използва бисквитки за подобряване на потребителското изживяване. <a
            href="<?php echo esc_url(home_url('/politika-za-poveritelnost/')); ?>">Научи повече</a></p>
    <button type="button" class="cookie-banner-accept btn" id="cookie-accept">Разбрах</button>
</div>

<!-- Lightbox (used by single project) -->
<div class="lightbox-overlay" id="lightbox" role="dialog" aria-modal="true" aria-label="Галерия">
    <div class="lightbox-inner">
        <button class="lightbox-close" id="lightbox-close" aria-label="Затвори">×</button>
        <button class="lightbox-prev" id="lightbox-prev" aria-label="Предишна">‹</button>
        <img src="" alt="" id="lightbox-img">
        <button class="lightbox-next" id="lightbox-next" aria-label="Следваща">›</button>
    </div>
</div>

<?php wp_footer(); ?>
</body>

</html>