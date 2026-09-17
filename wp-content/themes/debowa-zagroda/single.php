<?php
/**
 * Szablon pojedynczego wpisu.
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
            <p class="entry-meta">
                <time datetime="<?php echo esc_attr( get_the_date( DATE_W3C ) ); ?>">
                    <?php echo esc_html( get_the_date() ); ?>
                </time>
            </p>
        </header>

        <?php if ( has_post_thumbnail() ) : ?>
            <?php the_post_thumbnail( 'large' ); ?>
        <?php endif; ?>

        <div class="entry-content">
            <?php the_content(); ?>
            <?php wp_link_pages(); ?>
        </div>
    </article>

    <?php the_post_navigation(); ?>

    <?php
    if ( comments_open() || get_comments_number() ) {
        comments_template();
    }
endwhile;

get_footer();
