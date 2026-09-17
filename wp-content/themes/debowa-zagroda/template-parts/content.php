<?php
/**
 * Karta wpisu na liście.
 *
 * @package Debowa_Zagroda
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'entry-card' ); ?>>
    <?php if ( has_post_thumbnail() ) : ?>
        <a href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
            <?php the_post_thumbnail( 'medium_large' ); ?>
        </a>
    <?php endif; ?>

    <header>
        <?php the_title( '<h2 class="entry-card__title"><a href="' . esc_url( get_permalink() ) . '">', '</a></h2>' ); ?>
        <p class="entry-meta"><?php echo esc_html( get_the_date() ); ?></p>
    </header>

    <div class="entry-content">
        <?php the_excerpt(); ?>
    </div>
</article>
