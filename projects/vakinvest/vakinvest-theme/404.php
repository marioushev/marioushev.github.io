<?php get_header(); ?>

<main id="main-content">
    <div class="not-found">
        <div class="not-found-code">404</div>
        <h1>Страницата не е намерена</h1>
        <p>Страницата, която търсите, не съществува или е преместена. Използвайте навигацията или се върнете на началната страница.</p>
        <a href="<?php echo esc_url(home_url('/')); ?>" class="btn btn-primary">← Към началната страница</a>
    </div>
</main>

<?php get_footer();
