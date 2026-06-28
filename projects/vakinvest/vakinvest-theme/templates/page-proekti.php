<?php
/**
 * Template Name: Изпълнени проекти
 */

$paged = get_query_var('paged') ?: 1;
$projects = new WP_Query([
    'post_type'      => 'vi_project',
    'posts_per_page' => 12,
    'paged'          => $paged,
    'post_status'    => 'publish',
]);

get_header();

$categories = get_terms(['taxonomy' => 'project_category', 'hide_empty' => true]);
$banner_img = vi_opt('proekti_banner_image');

/* Total project count for the meta-row */
$total_projects = wp_count_posts('vi_project');
$total_published = isset($total_projects->publish) ? (int) $total_projects->publish : 0;
?>

<section class="page-banner">
    <div class="bg"<?php if ($banner_img) echo ' style="background-image:url(' . esc_url($banner_img) . ')"'; ?>></div>
    <div class="container">
        <nav class="crumb" aria-label="Breadcrumb">
            <a href="<?php echo esc_url(home_url('/')); ?>">Начало</a>
            <span class="sep">/</span>
            <span class="current">Изпълнени проекти</span>
        </nav>
        <h1>Проекти.</h1>
        <div class="meta-row">
            <div><span class="v">/01</span> <?php echo $total_published ? esc_html($total_published . '+ ОБЕКТА') : '240+ ОБЕКТА'; ?></div>
            <div><span class="v">/02</span> ОТ 1994</div>
            <div><span class="v">/03</span> В СРОК</div>
        </div>
    </div>
</section>

<section class="portfolio-section">
    <div class="container">

        <div class="portfolio-intro">
            <div class="eyebrow">Нашата работа / 01</div>
            <h2>Реализирани обекти</h2>
            <p>Разгледайте избрани проекти от нашето портфолио — жилищни сгради, обществени обекти, инфраструктурни и индустриални строежи, изпълнени с грижа към детайла и качеството.</p>
        </div>

        <?php if ($categories && !is_wp_error($categories)) : ?>
        <div class="portfolio-filter" role="group" aria-label="Филтриране по категория">
            <button class="filter-btn active" data-filter="*">Всички</button>
            <?php foreach ($categories as $cat) : ?>
                <button class="filter-btn" data-filter="<?php echo esc_attr($cat->slug); ?>">
                    <?php echo esc_html($cat->name); ?>
                </button>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>

        <div class="portfolio-grid" id="portfolio-grid">
            <?php if ($projects->have_posts()) : while ($projects->have_posts()) : $projects->the_post();
                $cats      = get_the_terms(get_the_ID(), 'project_category');
                $cat_slugs = ($cats && !is_wp_error($cats)) ? implode(' ', wp_list_pluck($cats, 'slug')) : '';
                $cat_name  = ($cats && !is_wp_error($cats)) ? esc_html($cats[0]->name) : '';
                $year      = get_post_meta(get_the_ID(), '_vi_year', true);
                $loc       = get_post_meta(get_the_ID(), '_vi_location', true);
            ?>
            <a href="<?php the_permalink(); ?>"
               class="project-card"
               data-category="<?php echo esc_attr($cat_slugs); ?>">
                <div class="project-card-image">
                    <?php if (has_post_thumbnail()) :
                        the_post_thumbnail('project-thumb', ['alt' => esc_attr(get_the_title())]);
                    else : ?>
                        <div class="project-card-image-placeholder">снимка / проект</div>
                    <?php endif; ?>
                    <?php if ($cat_name) : ?>
                        <span class="project-cat-badge"><?php echo $cat_name; ?></span>
                    <?php endif; ?>
                </div>
                <div class="project-card-body">
                    <div class="project-card-meta">
                        <?php if ($year) : ?><span><?php echo esc_html($year); ?></span><?php endif; ?>
                        <?php if ($loc)  : ?><span><?php echo esc_html($loc); ?></span><?php endif; ?>
                    </div>
                    <h3><?php the_title(); ?></h3>
                    <?php if (has_excerpt()) : ?><p><?php echo esc_html(wp_trim_words(get_the_excerpt(), 22)); ?></p><?php endif; ?>
                    <div class="project-card-footer">Виж проекта →</div>
                </div>
            </a>
            <?php endwhile; wp_reset_postdata();
            else : ?>
            <div class="portfolio-empty">
                <div class="portfolio-empty-icon">▢</div>
                <p>Все още няма добавени проекти. Скоро ще представим нашите реализирани обекти.</p>
            </div>
            <?php endif; ?>
        </div>

        <?php if ($projects->max_num_pages > 1) :
            $pagination = paginate_links([
                'total'     => $projects->max_num_pages,
                'current'   => $paged,
                'prev_text' => '‹',
                'next_text' => '›',
            ]);
            if ($pagination) : ?>
        <nav class="portfolio-pagination" aria-label="Навигация">
            <?php echo $pagination; ?>
        </nav>
            <?php endif;
        endif; ?>

    </div>
</section>

<?php get_footer();
