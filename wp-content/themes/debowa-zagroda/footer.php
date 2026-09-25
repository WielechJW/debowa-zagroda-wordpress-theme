<?php
/**
 * Stopka strony.
 *
 * @package Debowa_Zagroda
 */

$facebook  = get_theme_mod( 'facebook_url', '' );
$instagram = get_theme_mod( 'instagram_url', '' );
?>
</main>

<footer class="site-footer">
    <div class="site-shell site-footer__top">
        <div class="site-footer__brand">
            <a class="site-footer__title" href="<?php echo esc_url( home_url( '/' ) ); ?>">
                <?php bloginfo( 'name' ); ?>
            </a>
            <p><?php echo esc_html( get_theme_mod( 'footer_text', 'Kameralne spotkania z alpakami, blisko natury.' ) ); ?></p>
        </div>

        <div class="site-footer__nav">
            <span><?php esc_html_e( 'Odkrywaj', 'debowa-zagroda' ); ?></span>
            <?php if ( has_nav_menu( 'footer' ) ) : ?>
                <?php
                wp_nav_menu(
                    array(
                        'theme_location' => 'footer',
                        'container'      => false,
                        'menu_class'     => 'menu',
                        'fallback_cb'    => false,
                    )
                );
                ?>
            <?php else : ?>
                <a href="<?php echo esc_url( home_url( '/#o-nas' ) ); ?>"><?php esc_html_e( 'O nas', 'debowa-zagroda' ); ?></a>
                <a href="<?php echo esc_url( home_url( '/#oferta' ) ); ?>"><?php esc_html_e( 'Oferta', 'debowa-zagroda' ); ?></a>
                <a href="<?php echo esc_url( home_url( '/#alpaki' ) ); ?>"><?php esc_html_e( 'Nasze alpaki', 'debowa-zagroda' ); ?></a>
            <?php endif; ?>
        </div>

        <div class="site-footer__nav">
            <span><?php esc_html_e( 'Kontakt', 'debowa-zagroda' ); ?></span>
            <a href="mailto:<?php echo esc_attr( get_theme_mod( 'contact_email', get_option( 'admin_email' ) ) ); ?>"><?php echo esc_html( get_theme_mod( 'contact_email', get_option( 'admin_email' ) ) ); ?></a>
            <a href="tel:<?php echo esc_attr( preg_replace( '/[^0-9+]/', '', get_theme_mod( 'contact_phone', '+48 000 000 000' ) ) ); ?>"><?php echo esc_html( get_theme_mod( 'contact_phone', '+48 000 000 000' ) ); ?></a>
        </div>

        <?php if ( $facebook || $instagram ) : ?>
            <div class="site-footer__socials">
                <span><?php esc_html_e( 'Obserwuj nas', 'debowa-zagroda' ); ?></span>
                <div>
                    <?php if ( $instagram ) : ?>
                        <a href="<?php echo esc_url( $instagram ); ?>" target="_blank" rel="noopener" aria-label="Instagram">ig</a>
                    <?php endif; ?>
                    <?php if ( $facebook ) : ?>
                        <a href="<?php echo esc_url( $facebook ); ?>" target="_blank" rel="noopener" aria-label="Facebook">f</a>
                    <?php endif; ?>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <div class="site-shell site-footer__bottom">
        <p>&copy; <?php echo esc_html( wp_date( 'Y' ) ); ?> <?php bloginfo( 'name' ); ?></p>
        <p><?php esc_html_e( 'Stworzone z troską o naturę i dobre spotkania.', 'debowa-zagroda' ); ?></p>
        <a href="#start"><?php esc_html_e( 'Wróć na górę', 'debowa-zagroda' ); ?> ↑</a>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
