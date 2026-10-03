<?php
/**
 * Adresy podstrony kontaktowej i dojazdu.
 *
 * @package Debowa_Zagroda
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function debowa_zagroda_contact_url(): string {
    $page = get_page_by_path( 'kontakt' );

    return $page && 'publish' === $page->post_status ? get_permalink( $page ) : home_url( '/kontakt/' );
}

function debowa_zagroda_directions_url(): string {
    $maps_url = get_theme_mod( 'maps_url', '' );

    return $maps_url ?: 'https://www.google.com/maps/search/?api=1&query=' . rawurlencode( get_theme_mod( 'contact_address', 'Dębowa 3e, Warszawa' ) );
}
