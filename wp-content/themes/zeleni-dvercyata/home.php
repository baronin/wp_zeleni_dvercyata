<?php get_header(); ?>

<main>
    <h1>Home Page</h1>
    <h2><?php the_title(); ?></h2>
    <div class="content">
        <?php the_content(); ?>
    </div>
</main>

<?php get_footer(); ?>