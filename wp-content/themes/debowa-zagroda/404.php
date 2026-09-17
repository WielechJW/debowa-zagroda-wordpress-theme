<?php
/**
 * Szablon błędu 404.
 *
 * @package Debowa_Zagroda
 */

get_header();
?>

<section class="empty-state">
    <h1 class="page-title"><?php esc_html_e( 'Nie znaleziono strony', 'debowa-zagroda' ); ?></h1>
    <p><?php esc_html_e( 'Wygląda na to, że ten adres nie istnieje. Wróć na stronę główną albo użyj wyszukiwarki.', 'debowa-zagroda' ); ?></p>
    <?php get_search_form(); ?>
</section>

<?php
get_footer();
