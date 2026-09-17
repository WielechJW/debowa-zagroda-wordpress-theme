<?php
/**
 * Główny szablon listy treści.
 *
 * @package Debowa_Zagroda
 */

get_header();
?>

<header class="page-header">
    <h1 class="page-title">
        <?php
        if ( is_home() && ! is_front_page() ) {
            single_post_title();
        } elseif ( is_archive() ) {
            the_archive_title();
        } elseif ( is_search() ) {
            printf(
                /* translators: %s: wyszukiwana fraza. */
                esc_html__( 'Wyniki dla: %s', 'debowa-zagroda' ),
                '<span>' . esc_html( get_search_query() ) . '</span>'
            );
        } else {
            esc_html_e( 'Aktualności', 'debowa-zagroda' );
        }
        ?>
    </h1>
</header>

<?php if ( have_posts() ) : ?>
    <div class="entries">
        <?php
        while ( have_posts() ) :
            the_post();
            get_template_part( 'template-parts/content' );
        endwhile;
        ?>
    </div>

    <?php the_posts_navigation(); ?>
<?php else : ?>
    <?php get_template_part( 'template-parts/content', 'none' ); ?>
<?php endif; ?>

<?php
get_footer();
