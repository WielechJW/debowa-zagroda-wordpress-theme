<?php
/**
 * Template Name: Kontakt
 *
 * @package Debowa_Zagroda
 */

get_header();

$phone     = get_theme_mod( 'contact_phone', '+48 608 242 618' );
$phone_url = 'tel:' . preg_replace( '/[^0-9+]/', '', $phone );
$email     = get_theme_mod( 'contact_email', get_option( 'admin_email' ) );
$address   = get_theme_mod( 'contact_address', 'Dębowa 3e, Warszawa' );
$hours     = get_theme_mod( 'contact_hours', 'Wizyty po wcześniejszej rezerwacji' );
$facebook  = get_theme_mod( 'facebook_url', '' );
$instagram = get_theme_mod( 'instagram_url', '' );
?>

<section id="start" class="contact-page-intro" aria-labelledby="contact-title">
    <div class="site-shell">
        <a class="offer-back" href="<?php echo esc_url( home_url( '/' ) ); ?>"><span aria-hidden="true">←</span> <?php esc_html_e( 'Wróć do zagrody', 'debowa-zagroda' ); ?></a>
        <div class="contact-page-intro__inner">
            <div>
                <p class="eyebrow" data-hero-item><span class="eyebrow__line"></span><?php esc_html_e( 'Kontakt', 'debowa-zagroda' ); ?></p>
                <h1 id="contact-title" data-hero-item><?php echo esc_html( get_theme_mod( 'contact_title', 'Masz ochotę nas odwiedzić?' ) ); ?></h1>
                <p class="section-lead" data-hero-item><?php echo esc_html( get_theme_mod( 'contact_text', 'Napisz, jaki termin i rodzaj spotkania Cię interesuje. Odezwiemy się i wspólnie ustalimy szczegóły.' ) ); ?></p>
                <div class="hero__actions" data-hero-item>
                    <a class="button button--primary" href="#formularz"><?php esc_html_e( 'Napisz do nas', 'debowa-zagroda' ); ?><span aria-hidden="true">↓</span></a>
                    <a class="button button--ghost" href="<?php echo esc_url( $phone_url ); ?>"><?php esc_html_e( 'Zadzwoń', 'debowa-zagroda' ); ?><span aria-hidden="true">↗</span></a>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section section--contact section--contact-page" aria-labelledby="contact-form-title">
    <div class="site-shell contact">
        <div id="formularz" class="contact__form-wrap reveal reveal--left">
            <h2 id="contact-form-title" class="contact-page__form-title"><?php esc_html_e( 'Napisz do nas', 'debowa-zagroda' ); ?></h2>
            <p class="contact-page__form-intro"><?php esc_html_e( 'Podaj termin, liczbę osób i to, na co masz ochotę. Wspólnie zaplanujemy spotkanie.', 'debowa-zagroda' ); ?></p>
            <?php get_template_part( 'template-parts/contact-form' ); ?>
        </div>
        <div class="contact__intro reveal reveal--right">
            <p class="eyebrow eyebrow--light"><span class="eyebrow__line"></span><?php echo esc_html( get_theme_mod( 'contact_eyebrow', 'Do zobaczenia w zagrodzie' ) ); ?></p>
            <h2 id="contact-details-title"><?php esc_html_e( 'Porozmawiajmy o Twojej wizycie', 'debowa-zagroda' ); ?></h2>
            <p class="section-lead"><?php esc_html_e( 'Masz pytanie, szukasz terminu albo planujesz wyjątkową okazję? Zadzwoń lub zostaw nam wiadomość.', 'debowa-zagroda' ); ?></p>
            <div class="contact__details">
                <div>
                    <span><?php esc_html_e( 'Telefon', 'debowa-zagroda' ); ?></span>
                    <a href="<?php echo esc_url( $phone_url ); ?>"><?php echo esc_html( $phone ); ?></a>
                </div>
                <div>
                    <span><?php esc_html_e( 'E-mail', 'debowa-zagroda' ); ?></span>
                    <a href="mailto:<?php echo esc_attr( $email ); ?>"><?php echo esc_html( $email ); ?></a>
                </div>
                <div>
                    <span><?php esc_html_e( 'Gdzie jesteśmy', 'debowa-zagroda' ); ?></span>
                    <a href="<?php echo esc_url( debowa_zagroda_directions_url() ); ?>" target="_blank" rel="noopener"><?php echo esc_html( $address ); ?></a>
                </div>
                <div>
                    <span><?php esc_html_e( 'Kiedy', 'debowa-zagroda' ); ?></span>
                    <strong><?php echo esc_html( $hours ); ?></strong>
                </div>
            </div>
            <?php if ( $facebook || $instagram ) : ?>
                <div class="contact-page-socials">
                    <?php if ( $facebook ) : ?><a href="<?php echo esc_url( $facebook ); ?>" target="_blank" rel="noopener"><?php esc_html_e( 'Napisz na Facebooku', 'debowa-zagroda' ); ?> <span aria-hidden="true">↗</span></a><?php endif; ?>
                    <?php if ( $instagram ) : ?><a href="<?php echo esc_url( $instagram ); ?>" target="_blank" rel="noopener">Instagram <span aria-hidden="true">↗</span></a><?php endif; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<section id="dojazd" class="section section--contact-location" aria-labelledby="location-title">
    <div class="site-shell contact-location">
        <div class="contact-location__card reveal reveal--left">
            <svg viewBox="0 0 48 48" aria-hidden="true"><path d="M24 43S9 27 9 18a15 15 0 0 1 30 0c0 9-15 25-15 25Z"/><circle cx="24" cy="18" r="5"/></svg>
            <p><?php echo esc_html( $address ); ?></p>
            <span><?php echo esc_html( $hours ); ?></span>
        </div>
        <div class="contact-location__content reveal reveal--right">
            <p class="eyebrow"><span class="eyebrow__line"></span><?php esc_html_e( 'Blisko natury, blisko Ciebie', 'debowa-zagroda' ); ?></p>
            <h2 id="location-title"><?php esc_html_e( 'Znajdź drogę do zagrody', 'debowa-zagroda' ); ?></h2>
            <p class="section-lead"><?php esc_html_e( 'Zanim ruszysz w drogę, ustal z nami termin wizyty. Na miejscu będą czekać nasze alpaki i chwila spokoju.', 'debowa-zagroda' ); ?></p>
            <a class="button button--primary" href="<?php echo esc_url( debowa_zagroda_directions_url() ); ?>" target="_blank" rel="noopener"><?php esc_html_e( 'Otwórz mapę i dojazd', 'debowa-zagroda' ); ?><span aria-hidden="true">↗</span></a>
        </div>
    </div>
</section>

<?php get_footer(); ?>
