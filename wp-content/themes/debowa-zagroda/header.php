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
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<a class="skip-link" href="#content"><?php esc_html_e( 'Przejdź do treści', 'debowa-zagroda' ); ?></a>

<header class="site-header">
    <div class="site-shell site-header__inner">
        <div class="site-branding">
            <?php if ( has_custom_logo() ) : ?>
                <?php the_custom_logo(); ?>
            <?php endif; ?>
            <a class="site-title" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
                <?php bloginfo( 'name' ); ?>
            </a>
        </div>

        <?php if ( has_nav_menu( 'primary' ) ) : ?>
            <nav class="site-navigation" aria-label="<?php esc_attr_e( 'Menu główne', 'debowa-zagroda' ); ?>">
                <?php
                wp_nav_menu(
                    array(
                        'theme_location' => 'primary',
                        'container'      => false,
                        'menu_class'     => 'menu',
                        'fallback_cb'    => false,
                    )
                );
                ?>
            </nav>
        <?php endif; ?>
    </div>
</header>

<main id="content" class="site-main site-shell">
