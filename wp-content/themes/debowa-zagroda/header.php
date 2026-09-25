<?php
/**
 * Nagłówek strony.
 *
 * @package Debowa_Zagroda
 */
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#1f3b2b">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<a class="skip-link" href="#content"><?php esc_html_e( 'Przejdź do treści', 'debowa-zagroda' ); ?></a>

<header class="site-header" data-site-header>
    <div class="site-shell site-header__inner">
        <div class="site-branding">
            <?php if ( has_custom_logo() ) : ?>
                <?php the_custom_logo(); ?>
            <?php else : ?>
                <a class="brand-logo" href="<?php echo esc_url( home_url( '/' ) ); ?>" aria-label="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
                    <img src="<?php echo esc_url( debowa_zagroda_image( 'logo-debowa-zagroda.jpg' ) ); ?>" alt="" width="1254" height="1254">
                </a>
            <?php endif; ?>
            <a class="site-title" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
                <span><?php bloginfo( 'name' ); ?></span>
                <?php if ( get_bloginfo( 'description' ) ) : ?>
                    <small><?php bloginfo( 'description' ); ?></small>
                <?php endif; ?>
            </a>
        </div>

        <button class="menu-toggle" type="button" aria-expanded="false" aria-controls="primary-menu">
            <span class="menu-toggle__label"><?php esc_html_e( 'Menu', 'debowa-zagroda' ); ?></span>
            <span class="menu-toggle__icon" aria-hidden="true"><i></i><i></i></span>
        </button>

        <nav class="site-navigation" aria-label="<?php esc_attr_e( 'Menu główne', 'debowa-zagroda' ); ?>" data-navigation>
            <?php
            wp_nav_menu(
                array(
                    'theme_location' => 'primary',
                    'container'      => false,
                    'menu_class'     => 'menu',
                    'menu_id'        => 'primary-menu',
                    'fallback_cb'    => 'debowa_zagroda_fallback_menu',
                )
            );
            ?>
        </nav>
    </div>
</header>

<main id="content" class="<?php echo esc_attr( is_front_page() ? 'site-main site-main--front' : 'site-main site-shell' ); ?>">
