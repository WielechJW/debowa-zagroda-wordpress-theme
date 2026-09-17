<?php
/**
 * Funkcje motywu Dębowa Zagroda.
 *
 * @package Debowa_Zagroda
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Rejestruje funkcje obsługiwane przez motyw.
 */
function debowa_zagroda_setup(): void {
    load_theme_textdomain( 'debowa-zagroda', get_template_directory() . '/languages' );

    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'responsive-embeds' );
    add_theme_support( 'editor-styles' );
    add_editor_style( 'style.css' );
    add_theme_support(
        'html5',
        array(
            'comment-list',
            'comment-form',
            'search-form',
            'gallery',
            'caption',
            'style',
            'script',
        )
    );
    add_theme_support(
        'custom-logo',
        array(
            'height'      => 112,
            'width'       => 240,
            'flex-height' => true,
            'flex-width'  => true,
        )
    );

    register_nav_menus(
        array(
            'primary' => __( 'Menu główne', 'debowa-zagroda' ),
            'footer'  => __( 'Menu w stopce', 'debowa-zagroda' ),
        )
    );
}
add_action( 'after_setup_theme', 'debowa_zagroda_setup' );

/**
 * Ładuje style i skrypty motywu.
 */
function debowa_zagroda_assets(): void {
    $theme = wp_get_theme();

    wp_enqueue_style(
        'debowa-zagroda-style',
        get_stylesheet_uri(),
        array(),
        $theme->get( 'Version' )
    );

    wp_enqueue_script(
        'debowa-zagroda-script',
        get_template_directory_uri() . '/assets/js/main.js',
        array(),
        $theme->get( 'Version' ),
        true
    );
}
add_action( 'wp_enqueue_scripts', 'debowa_zagroda_assets' );
