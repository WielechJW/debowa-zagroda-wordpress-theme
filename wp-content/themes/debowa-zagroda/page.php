<?php
/**
 * Szablon pojedynczej strony.
 *
 * @package Debowa_Zagroda
 */

get_header();

while ( have_posts() ) :
    the_post();
    ?>
    <article id="post-<?php the_ID(); ?>" <?php post_class( 'entry-single' ); ?>>
        <header class="page-header">
            <?php the_title( '<h1 class="page-title">', '</h1>' ); ?>
        </header>

        <div class="entry-content">
            <?php the_content(); ?>
            <?php wp_link_pages(); ?>
        </div>
    </article>
    <?php

    if ( comments_open() || get_comments_number() ) {
        comments_template();
    }
endwhile;

get_footer();
