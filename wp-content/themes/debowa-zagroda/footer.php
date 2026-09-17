<?php
/**
 * Stopka strony.
 *
 * @package Debowa_Zagroda
 */
?>
</main>

<footer class="site-footer">
    <div class="site-shell site-footer__inner">
        <p>
            &copy; <?php echo esc_html( wp_date( 'Y' ) ); ?>
            <?php bloginfo( 'name' ); ?>
        </p>

        <?php if ( has_nav_menu( 'footer' ) ) : ?>
            <nav class="site-navigation" aria-label="<?php esc_attr_e( 'Menu w stopce', 'debowa-zagroda' ); ?>">
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
            </nav>
        <?php endif; ?>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
