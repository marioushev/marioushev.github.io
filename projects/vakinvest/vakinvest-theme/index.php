<?php
/* Fallback template — WordPress requires this file */
get_header(); ?>

<main class="container" style="padding:60px 24px;min-height:60vh">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <article>
            <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
            <?php the_excerpt(); ?>
        </article>
    <?php endwhile; else : ?>
        <p>Няма намерено съдържание.</p>
    <?php endif; ?>
</main>

<?php get_footer();
