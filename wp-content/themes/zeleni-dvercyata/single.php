<?php get_header(); ?>

<main>
    <h1><?php the_title(); ?></h1>
    <h2>single page</h2>
    <div class="post-meta">
        <span class="post-date"><?php the_time('d.m.Y'); ?></span>
        <span class="post-author"><?php the_author(); ?></span>
    </div>
    <div class="content">
        <?php the_content(); ?>
    </div>
</main>

<?php get_footer(); ?>