<?php get_header(); ?>

<div class="page-banner">
    <div class="container">
        <h1><?php the_title(); ?></h1>
        <?php vakinvest_breadcrumb(); ?>
    </div>
</div>

<main class="section" id="main-content">
    <div class="container">
        <div style="max-width:800px">
            <?php while (have_posts()) : the_post(); ?>
                <div class="prose"><?php the_content(); ?></div>
            <?php endwhile; ?>
        </div>
    </div>
</main>

<?php get_footer();
