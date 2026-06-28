<?php get_header(); ?>

<?php while (have_posts()) : the_post();
    $gallery_ids = vakinvest_get_gallery_ids(get_the_ID());
    $year        = get_post_meta(get_the_ID(), '_vi_year', true);
    $location    = get_post_meta(get_the_ID(), '_vi_location', true);
    $area        = get_post_meta(get_the_ID(), '_vi_area', true);
    $cats        = get_the_terms(get_the_ID(), 'project_category');
    $cat_name    = ($cats && !is_wp_error($cats)) ? $cats[0]->name : '';
?>

<div class="page-banner">
    <div class="container">
        <h1><?php the_title(); ?></h1>
        <?php vakinvest_breadcrumb(); ?>
    </div>
</div>

<main id="main-content">
    <div class="container single-project-layout">

        <!-- Gallery + Description -->
        <article>
            <?php if ($gallery_ids) : ?>
            <div class="project-gallery">
                <?php $first_src = wp_get_attachment_image_src($gallery_ids[0], 'project-large'); ?>
                <div class="project-gallery-main" id="gallery-main" data-index="0">
                    <img src="<?php echo esc_url($first_src[0]); ?>"
                         alt="<?php the_title_attribute(); ?>"
                         id="gallery-main-img">
                </div>
                <?php if (count($gallery_ids) > 1) : ?>
                <div class="project-gallery-thumbs">
                    <?php foreach ($gallery_ids as $i => $img_id) :
                        $thumb = wp_get_attachment_image_src($img_id, 'thumbnail');
                        $large = wp_get_attachment_image_src($img_id, 'project-large');
                        if (!$thumb) continue;
                    ?>
                    <div class="thumb <?php echo $i === 0 ? 'active' : ''; ?>"
                         data-index="<?php echo $i; ?>"
                         data-large="<?php echo esc_url($large[0]); ?>"
                         data-alt="<?php the_title_attribute(); ?>"
                         role="button"
                         tabindex="0"
                         aria-label="Снимка <?php echo $i + 1; ?>">
                        <img src="<?php echo esc_url($thumb[0]); ?>" alt="">
                    </div>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>
            </div>
            <?php endif; ?>

            <div class="project-description">
                <h2>За проекта</h2>
                <?php if (has_excerpt()) : ?>
                    <p><strong><?php the_excerpt(); ?></strong></p>
                <?php endif; ?>
                <?php the_content(); ?>
            </div>
        </article>

        <!-- Sidebar -->
        <aside class="project-sidebar">
            <div class="project-info-card">
                <h4>Детайли</h4>
                <?php if ($cat_name) : ?>
                <div class="project-info-row">
                    <span class="label">Категория</span>
                    <span class="value"><?php echo esc_html($cat_name); ?></span>
                </div>
                <?php endif; ?>
                <?php if ($year) : ?>
                <div class="project-info-row">
                    <span class="label">Година</span>
                    <span class="value"><?php echo esc_html($year); ?></span>
                </div>
                <?php endif; ?>
                <?php if ($location) : ?>
                <div class="project-info-row">
                    <span class="label">Местоположение</span>
                    <span class="value"><?php echo esc_html($location); ?></span>
                </div>
                <?php endif; ?>
                <?php if ($area) : ?>
                <div class="project-info-row">
                    <span class="label">Площ</span>
                    <span class="value"><?php echo esc_html($area); ?></span>
                </div>
                <?php endif; ?>
            </div>

            <div class="project-cta-card">
                <h4>Подобен проект?</h4>
                <p>Свържете се с нас за безплатна консултация и оферта за вашия обект.</p>
                <a href="<?php echo esc_url(home_url('/kontakti/')); ?>" class="btn btn-outline">
                    Свържете се с нас
                </a>
            </div>

            <a href="<?php echo esc_url(get_post_type_archive_link('vi_project')); ?>"
               class="project-back-link">
                ← Обратно към всички проекти
            </a>
        </aside>

    </div><!-- .single-project-layout -->
</main>

<!-- Gallery data for JS lightbox -->
<script>
var VI_GALLERY = <?php
    $gallery_data = [];
    foreach ($gallery_ids as $img_id) {
        $large = wp_get_attachment_image_src($img_id, 'project-large');
        if ($large) $gallery_data[] = ['src' => $large[0], 'alt' => get_the_title()];
    }
    echo wp_json_encode($gallery_data);
?>;
</script>

<?php endwhile; ?>
<?php get_footer();
