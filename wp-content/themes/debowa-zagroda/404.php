<?php
/**
 * Szablon błędu 404.
 *
 * @package Debowa_Zagroda
 */

get_header();
?>

<section class="empty-state">
    <p class="eyebrow">404 · <?php esc_html_e( 'Zboczyliśmy ze ścieżki', 'debowa-zagroda' ); ?></p>
    <h1 class="page-title"><?php esc_html_e( 'Nie znaleziono strony', 'debowa-zagroda' ); ?></h1>
    <p><?php esc_html_e( 'Wygląda na to, że ten adres nie istnieje. Wróć na stronę główną albo użyj wyszukiwarki.', 'debowa-zagroda' ); ?></p>
    <a class="button button--primary" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Wróć do zagrody', 'debowa-zagroda' ); ?><span aria-hidden="true">↗</span></a>
    <?php get_search_form(); ?>
</section>

<?php
get_footer();
