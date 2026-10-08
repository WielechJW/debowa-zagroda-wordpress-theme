<?php
/**
 * Oferta i ustawienia cennika.
 *
 * @package Debowa_Zagroda
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function debowa_zagroda_offer_packages( bool $use_settings = true ): array {
    $packages = array(
        'meeting' => array(
            'title'    => 'Spotkanie z alpakami',
            'price'    => '35',
            'duration' => '30–40 min',
            'text'     => 'Pierwsze spotkanie, miękkie futerka i chwila oddechu. Poznaj nasze stado w spokojnym rytmie zagrody.',
            'features' => array( 'Poznanie alpak', 'Karmienie', 'Głaskanie', 'Ciekawostki o alpakach', 'Czas na zdjęcia' ),
        ),
        'walk' => array(
            'title'    => 'Spacer z alpakami',
            'price'    => '50',
            'duration' => 'ok. 1 godz.',
            'text'     => 'Trochę ruchu, trochę natury i puchate towarzystwo. Wybierz się z nami na krótki spacer z alpakami.',
            'features' => array( 'Poznanie alpak', 'Karmienie i głaskanie', 'Ciekawostki o alpakach', 'Zdjęcia', 'Krótki spacer z alpakami' ),
        ),
        'forest' => array(
            'title'    => 'Spacer z alpakami do lasu',
            'price'    => '100',
            'duration' => 'ok. 2 godz.',
            'text'     => 'Dłuższa wyprawa dla tych, którzy chcą pobyć blisko natury. Bez pośpiechu, w kierunku lasu.',
            'features' => array( 'Poznanie alpak', 'Karmienie i głaskanie', 'Ciekawostki o alpakach', 'Zdjęcia', 'Dłuższy spacer w kierunku lasu' ),
        ),
        'private_meeting' => array(
            'title'    => 'Spotkanie sam na sam z alpaką',
            'price'    => '60',
            'duration' => 'ok. 40 min',
        ),
        'private_walk' => array(
            'title'    => 'Spacer sam na sam z alpaką',
            'price'    => '90',
            'duration' => 'ok. 1 godz.',
        ),
        'private_forest' => array(
            'title'    => 'Spacer do lasu sam na sam z alpaką',
            'price'    => '180',
            'duration' => 'ok. 2 godz.',
        ),
        'photo_short' => array(
            'title'    => 'Sesja zdjęciowa — 30 minut',
            'price'    => '200',
            'duration' => '30 min',
        ),
        'photo_long' => array(
            'title'    => 'Sesja zdjęciowa — 60 minut',
            'price'    => '300',
            'duration' => '60 min',
        ),
    );

    if ( $use_settings ) {
        foreach ( $packages as $id => &$package ) {
            $package['price']    = get_theme_mod( 'pricing_' . $id . '_price', $package['price'] );
            $package['duration'] = get_theme_mod( 'pricing_' . $id . '_duration', $package['duration'] );
        }
        unset( $package );
    }

    return $packages;
}

function debowa_zagroda_offer_url(): string {
    $page = get_page_by_path( 'oferta' );

    return $page && 'publish' === $page->post_status ? get_permalink( $page ) : home_url( '/oferta/' );
}

function debowa_zagroda_booking_url( string $visit ): string {
    return add_query_arg( 'visit', $visit, debowa_zagroda_contact_url() ) . '#formularz';
}

function debowa_zagroda_customize_pricing( WP_Customize_Manager $wp_customize ): void {
    $wp_customize->add_section(
        'debowa_pricing',
        array(
            'title'       => __( 'Dębowa Zagroda — oferta i cennik', 'debowa-zagroda' ),
            'description' => __( 'Ceny w złotych oraz czas trwania wizyt na podstronie oferty.', 'debowa-zagroda' ),
            'priority'    => 31,
        )
    );

    foreach ( debowa_zagroda_offer_packages( false ) as $id => $package ) {
        foreach ( array( 'price' => 'Cena (zł)', 'duration' => 'Czas trwania' ) as $field => $label ) {
            $setting = 'pricing_' . $id . '_' . $field;
            $wp_customize->add_setting( $setting, array( 'default' => $package[ $field ], 'sanitize_callback' => 'sanitize_text_field' ) );
            $wp_customize->add_control(
                $setting,
                array(
                    'label'   => $package['title'] . ' — ' . $label,
                    'section' => 'debowa_pricing',
                    'type'    => 'text',
                )
            );
        }
    }

    $wp_customize->add_setting( 'pricing_forest_extra', array( 'default' => '80', 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control(
        'pricing_forest_extra',
        array(
            'label'   => __( 'Spacer do lasu — kolejna osoba w grupie powyżej 4 osób (zł)', 'debowa-zagroda' ),
            'section' => 'debowa_pricing',
            'type'    => 'text',
        )
    );
}
add_action( 'customize_register', 'debowa_zagroda_customize_pricing' );
