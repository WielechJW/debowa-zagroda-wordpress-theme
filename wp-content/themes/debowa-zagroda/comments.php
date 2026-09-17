<?php
/**
 * Szablon komentarzy.
 *
 * @package Debowa_Zagroda
 */

if ( post_password_required() ) {
    return;
}
?>

<section id="comments" class="comments-area">
    <?php if ( have_comments() ) : ?>
        <h2>
            <?php
            printf(
                /* translators: %s: liczba komentarzy. */
                esc_html( _n( '%s komentarz', '%s komentarzy', get_comments_number(), 'debowa-zagroda' ) ),
                esc_html( number_format_i18n( get_comments_number() ) )
            );
            ?>
        </h2>

        <ol class="comment-list">
            <?php wp_list_comments(); ?>
        </ol>

        <?php the_comments_navigation(); ?>
    <?php endif; ?>

    <?php comment_form(); ?>
</section>
