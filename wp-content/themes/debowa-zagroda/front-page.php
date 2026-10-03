<?php
/**
 * One-page strony głównej.
 *
 * @package Debowa_Zagroda
 */

get_header();

$hero_image  = get_theme_mod( 'hero_image', debowa_zagroda_image( 'hero-alpacas.webp' ) );
$about_image = get_theme_mod( 'about_image', debowa_zagroda_image( 'alpaca-walk.webp' ) );

$offers = array(
    array(
        'number' => '01',
        'title'  => get_theme_mod( 'offer_1_title', 'Spacer z alpakami' ),
        'text'   => get_theme_mod( 'offer_1_text', 'Spokojna wyprawa polną ścieżką w towarzystwie naszych puchatych przewodników. Czas na zdjęcia, głaskanie i poznanie ich charakterów.' ),
        'meta'   => get_theme_mod( 'offer_1_meta', 'około 1 godz.' ),
        'image'  => get_theme_mod( 'offer_1_image', debowa_zagroda_image( 'alpaca-walk.webp' ) ),
    ),
    array(
        'number' => '02',
        'title'  => get_theme_mod( 'offer_2_title', 'Wizyta w zagrodzie' ),
        'text'   => get_theme_mod( 'offer_2_text', 'Poznaj całą ekipę z bliska, dowiedz się, co alpaki lubią najbardziej i spędź swobodny czas w ich spokojnym rytmie.' ),
        'meta'   => get_theme_mod( 'offer_2_meta', '30–40 min' ),
        'image'  => get_theme_mod( 'offer_2_image', debowa_zagroda_image( 'alpaca-visit.webp' ) ),
    ),
);

$alpacas = array(
    array(
        'name'     => get_theme_mod( 'alpaca_1_name', 'Biała' ),
        'text'     => get_theme_mod( 'alpaca_1_text', 'Ciekawska obserwatorka i pierwsza przy płocie.' ),
        'image'    => get_theme_mod( 'alpaca_1_image', debowa_zagroda_image( 'alpaca-visit.webp' ) ),
        'position' => 'alpaca-card__image--one',
    ),
    array(
        'name'     => get_theme_mod( 'alpaca_2_name', 'Toffi' ),
        'text'     => get_theme_mod( 'alpaca_2_text', 'Spokojny łakomczuch o karmelowym futrze.' ),
        'image'    => get_theme_mod( 'alpaca_2_image', debowa_zagroda_image( 'alpaca-visit.webp' ) ),
        'position' => 'alpaca-card__image--two',
    ),
    array(
        'name'     => get_theme_mod( 'alpaca_3_name', 'Dąbek' ),
        'text'     => get_theme_mod( 'alpaca_3_text', 'Dostojny indywidualista, który zna swoją wartość.' ),
        'image'    => get_theme_mod( 'alpaca_3_image', debowa_zagroda_image( 'alpaca-visit.webp' ) ),
        'position' => 'alpaca-card__image--three',
    ),
    array(
        'name'     => get_theme_mod( 'alpaca_4_name', 'Chmurka' ),
        'text'     => get_theme_mod( 'alpaca_4_text', 'Delikatna dusza i mistrzyni słodkich spojrzeń.' ),
        'image'    => get_theme_mod( 'alpaca_4_image', debowa_zagroda_image( 'alpaca-visit.webp' ) ),
        'position' => 'alpaca-card__image--four',
    ),
);

$gallery_defaults = array(
    debowa_zagroda_image( 'hero-alpacas.webp' ),
    debowa_zagroda_image( 'alpaca-walk.webp' ),
    debowa_zagroda_image( 'alpaca-visit.webp' ),
    '',
    '',
    '',
);
$gallery = array();
for ( $i = 1; $i <= 6; $i++ ) {
    $image = get_theme_mod( 'gallery_image_' . $i, $gallery_defaults[ $i - 1 ] );
    if ( $image ) {
        $gallery[] = $image;
    }
}

$phone      = get_theme_mod( 'contact_phone', '+48 608 242 618' );
$email      = get_theme_mod( 'contact_email', get_option( 'admin_email' ) );
?>

<section id="start" class="hero" aria-labelledby="hero-title">
    <div class="hero__media" data-parallax>
        <img src="<?php echo esc_url( $hero_image ); ?>" alt="<?php esc_attr_e( 'Alpaki na zielonej łące', 'debowa-zagroda' ); ?>" fetchpriority="high">
    </div>
    <div class="hero__wash" aria-hidden="true"></div>
    <div class="hero__grain" aria-hidden="true"></div>

    <div class="site-shell hero__inner">
        <div class="hero__content">
            <p class="eyebrow hero__eyebrow" data-hero-item>
                <span class="eyebrow__line"></span>
                <?php echo esc_html( get_theme_mod( 'hero_eyebrow', 'Blisko natury. Blisko alpak.' ) ); ?>
            </p>
            <h1 id="hero-title" data-hero-item><?php echo esc_html( get_theme_mod( 'hero_title', 'Zwolnij. Alpaki już na Ciebie czekają.' ) ); ?></h1>
            <p class="hero__lead" data-hero-item><?php echo esc_html( get_theme_mod( 'hero_text', 'Dębowa Zagroda to kameralne miejsce, w którym możesz odetchnąć, poznać nasze alpaki i zabrać ze sobą naprawdę dobre wspomnienia.' ) ); ?></p>
            <div class="hero__actions" data-hero-item>
                <a class="button button--primary" href="<?php echo esc_url( debowa_zagroda_contact_url() ); ?>">
                    <?php echo esc_html( get_theme_mod( 'hero_button', 'Zaplanuj wizytę' ) ); ?>
                    <span aria-hidden="true">↗</span>
                </a>
                <a class="button button--ghost" href="#alpaki">
                    <?php echo esc_html( get_theme_mod( 'hero_second_button', 'Poznaj nasze alpaki' ) ); ?>
                </a>
            </div>
        </div>

        <div class="hero__badge" data-float aria-label="<?php esc_attr_e( 'Cztery wyjątkowe alpaki', 'debowa-zagroda' ); ?>">
            <span class="hero__badge-number">4</span>
            <span><?php esc_html_e( 'puchate', 'debowa-zagroda' ); ?><br><?php esc_html_e( 'charaktery', 'debowa-zagroda' ); ?></span>
        </div>

        <a class="scroll-cue" href="#o-nas">
            <span><?php esc_html_e( 'Przewiń, by nas poznać', 'debowa-zagroda' ); ?></span>
            <i aria-hidden="true"></i>
        </a>
    </div>
</section>

<section id="o-nas" class="section section--about">
    <div class="site-shell about">
        <div class="about__visual reveal reveal--left">
            <div class="about__image-wrap">
                <img src="<?php echo esc_url( $about_image ); ?>" alt="<?php esc_attr_e( 'Spacer z alpakami pośród zieleni', 'debowa-zagroda' ); ?>" loading="lazy">
            </div>
            <div class="about__seal" data-float aria-hidden="true">
                <svg viewBox="0 0 64 64">
                    <path d="M32 54V22M32 35c-10-1-17-7-19-17 10-1 18 5 19 17Zm0-8c3-10 10-16 20-16-2 11-9 17-20 16Z"/>
                </svg>
            </div>
        </div>

        <div class="about__content reveal reveal--right">
            <p class="eyebrow"><span class="eyebrow__line"></span><?php echo esc_html( get_theme_mod( 'about_eyebrow', 'Kilka słów o nas' ) ); ?></p>
            <h2><?php echo esc_html( get_theme_mod( 'about_title', 'Tu czas płynie trochę wolniej' ) ); ?></h2>
            <p class="section-lead"><?php echo esc_html( get_theme_mod( 'about_text', 'Stworzyliśmy Dębową Zagrodę z miłości do zwierząt, spokojnych poranków i prostych chwil blisko natury. Nasze spotkania odbywają się w małych grupach, dzięki czemu każdy ma czas naprawdę poznać alpaki.' ) ); ?></p>
            <div class="about__note">
                <span class="about__note-icon" aria-hidden="true">✦</span>
                <p><?php echo esc_html( get_theme_mod( 'about_note', 'Kameralnie, bez pośpiechu i z szacunkiem do zwierząt.' ) ); ?></p>
            </div>
            <div class="about__facts" data-reveal-group>
                <div><strong><?php echo esc_html( get_theme_mod( 'about_fact_1_value', '4' ) ); ?></strong><span><?php echo esc_html( get_theme_mod( 'about_fact_1_label', 'wyjątkowe alpaki' ) ); ?></span></div>
                <div><strong><?php echo esc_html( get_theme_mod( 'about_fact_2_value', '100%' ) ); ?></strong><span><?php echo esc_html( get_theme_mod( 'about_fact_2_label', 'blisko natury' ) ); ?></span></div>
                <div><strong><?php echo esc_html( get_theme_mod( 'about_fact_3_value', '∞' ) ); ?></strong><span><?php echo esc_html( get_theme_mod( 'about_fact_3_label', 'dobrych wspomnień' ) ); ?></span></div>
            </div>
        </div>
    </div>
</section>

<section id="oferta" class="section section--offers">
    <div class="site-shell">
        <header class="section-heading section-heading--split reveal">
            <div>
                <p class="eyebrow eyebrow--light"><span class="eyebrow__line"></span><?php echo esc_html( get_theme_mod( 'offers_eyebrow', 'Co możemy razem zrobić?' ) ); ?></p>
                <h2><?php echo esc_html( get_theme_mod( 'offers_title', 'Wybierz swój sposób na spotkanie' ) ); ?></h2>
            </div>
            <p><?php echo esc_html( get_theme_mod( 'offers_intro', 'Każde spotkanie dopasowujemy do rytmu zwierząt i potrzeb naszych gości.' ) ); ?></p>
        </header>

        <div class="offers-grid" data-reveal-group>
            <?php foreach ( $offers as $index => $offer ) : ?>
                <article class="offer-card">
                    <div class="offer-card__media">
                        <img src="<?php echo esc_url( $offer['image'] ); ?>" alt="<?php echo esc_attr( $offer['title'] ); ?>" loading="lazy">
                        <span class="offer-card__number"><?php echo esc_html( $offer['number'] ); ?></span>
                    </div>
                    <div class="offer-card__body">
                        <div>
                            <h3><?php echo esc_html( $offer['title'] ); ?></h3>
                            <p><?php echo esc_html( $offer['text'] ); ?></p>
                        </div>
                        <div class="offer-card__footer">
                            <span class="offer-card__meta">
                                <svg viewBox="0 0 24 24" aria-hidden="true"><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/></svg>
                                <?php echo esc_html( $offer['meta'] ); ?>
                            </span>
                            <a class="circle-link" href="<?php echo esc_url( debowa_zagroda_booking_url( 0 === $index ? 'Spacer z alpakami' : 'Spotkanie z alpakami' ) ); ?>" aria-label="<?php echo esc_attr( get_theme_mod( 'offers_button', 'Zapytaj o termin' ) . ': ' . $offer['title'] ); ?>">↗</a>
                        </div>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>
        <div class="offers-more reveal">
            <p><?php esc_html_e( 'Spotkania, spacery do lasu, sesje zdjęciowe i wyjątkowe okazje.', 'debowa-zagroda' ); ?></p>
            <a class="button button--cream" href="<?php echo esc_url( debowa_zagroda_offer_url() ); ?>"><?php esc_html_e( 'Zobacz ofertę i cennik', 'debowa-zagroda' ); ?><span aria-hidden="true">↗</span></a>
        </div>
    </div>
</section>

<section class="nature-break" aria-label="<?php esc_attr_e( 'Nasze wartości', 'debowa-zagroda' ); ?>">
    <div class="nature-break__track" aria-hidden="true">
        <div class="nature-break__group">
            <span>cisza</span><i>✦</i><span>natura</span><i>✦</i><span>alpaki</span><i>✦</i><span>radość</span><i>✦</i><span>spokój</span><i>✦</i><span>łąka</span><i>✦</i><span>bliskość</span><i>✦</i><span>wspomnienia</span><i>✦</i>
        </div>
        <div class="nature-break__group">
            <span>cisza</span><i>✦</i><span>natura</span><i>✦</i><span>alpaki</span><i>✦</i><span>radość</span><i>✦</i><span>spokój</span><i>✦</i><span>łąka</span><i>✦</i><span>bliskość</span><i>✦</i><span>wspomnienia</span><i>✦</i>
        </div>
    </div>
</section>

<section id="alpaki" class="section section--alpacas">
    <div class="site-shell">
        <header class="section-heading section-heading--center reveal">
            <p class="eyebrow"><span class="eyebrow__line"></span><?php echo esc_html( get_theme_mod( 'alpacas_eyebrow', 'Poznaj nasze alpaki' ) ); ?><span class="eyebrow__line"></span></p>
            <h2><?php echo esc_html( get_theme_mod( 'alpacas_title', 'Cztery charaktery. Jedno stado.' ) ); ?></h2>
        </header>

        <div class="alpacas-grid" data-reveal-group>
            <?php foreach ( $alpacas as $index => $alpaca ) : ?>
                <article class="alpaca-card">
                    <div class="alpaca-card__media">
                        <img class="alpaca-card__image <?php echo esc_attr( $alpaca['position'] ); ?>" src="<?php echo esc_url( $alpaca['image'] ); ?>" alt="<?php echo esc_attr( $alpaca['name'] ); ?>" loading="lazy">
                        <span class="alpaca-card__index">0<?php echo esc_html( (string) ( $index + 1 ) ); ?></span>
                    </div>
                    <div class="alpaca-card__body">
                        <h3><?php echo esc_html( $alpaca['name'] ); ?></h3>
                        <p><?php echo esc_html( $alpaca['text'] ); ?></p>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section id="galeria" class="section section--gallery">
    <div class="site-shell">
        <header class="section-heading section-heading--split reveal">
            <div>
                <p class="eyebrow"><span class="eyebrow__line"></span><?php echo esc_html( get_theme_mod( 'gallery_eyebrow', 'Z życia zagrody' ) ); ?></p>
                <h2><?php echo esc_html( get_theme_mod( 'gallery_title', 'Chwile, które zostają na dłużej' ) ); ?></h2>
            </div>
            <?php if ( get_theme_mod( 'instagram_url', '' ) ) : ?>
                <a class="text-link" href="<?php echo esc_url( get_theme_mod( 'instagram_url', '' ) ); ?>" target="_blank" rel="noopener">
                    <?php esc_html_e( 'Zobacz więcej na Instagramie', 'debowa-zagroda' ); ?> <span>↗</span>
                </a>
            <?php endif; ?>
        </header>

        <div class="gallery-grid" data-gallery data-reveal-group>
            <?php foreach ( $gallery as $index => $image ) : ?>
                <button class="gallery-item gallery-item--<?php echo esc_attr( (string) ( $index + 1 ) ); ?>" type="button" data-gallery-item data-image="<?php echo esc_url( $image ); ?>" aria-label="<?php echo esc_attr( sprintf( __( 'Powiększ zdjęcie %d', 'debowa-zagroda' ), $index + 1 ) ); ?>">
                    <img src="<?php echo esc_url( $image ); ?>" alt="" loading="lazy">
                    <span aria-hidden="true">＋</span>
                </button>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section id="kontakt" class="section section--contact">
    <div class="site-shell contact">
        <div class="contact__intro reveal reveal--left">
            <p class="eyebrow eyebrow--light"><span class="eyebrow__line"></span><?php echo esc_html( get_theme_mod( 'contact_eyebrow', 'Do zobaczenia w zagrodzie' ) ); ?></p>
            <h2><?php echo esc_html( get_theme_mod( 'contact_title', 'Masz ochotę nas odwiedzić?' ) ); ?></h2>
            <p class="section-lead"><?php echo esc_html( get_theme_mod( 'contact_text', 'Napisz, jaki termin i rodzaj spotkania Cię interesuje. Odezwiemy się i wspólnie ustalimy szczegóły.' ) ); ?></p>

            <div class="contact__details">
                <div>
                    <span><?php esc_html_e( 'Gdzie jesteśmy', 'debowa-zagroda' ); ?></span>
                    <?php if ( get_theme_mod( 'maps_url', '' ) ) : ?>
                        <a href="<?php echo esc_url( get_theme_mod( 'maps_url', '' ) ); ?>" target="_blank" rel="noopener"><?php echo esc_html( get_theme_mod( 'contact_address', 'Dębowa 3e, Warszawa' ) ); ?></a>
                    <?php else : ?>
                        <strong><?php echo esc_html( get_theme_mod( 'contact_address', 'Dębowa 3e, Warszawa' ) ); ?></strong>
                    <?php endif; ?>
                </div>
                <div>
                    <span><?php esc_html_e( 'Porozmawiajmy', 'debowa-zagroda' ); ?></span>
                    <a href="tel:<?php echo esc_attr( preg_replace( '/[^0-9+]/', '', $phone ) ); ?>"><?php echo esc_html( $phone ); ?></a>
                    <a href="mailto:<?php echo esc_attr( $email ); ?>"><?php echo esc_html( $email ); ?></a>
                </div>
                <div>
                    <span><?php esc_html_e( 'Kiedy', 'debowa-zagroda' ); ?></span>
                    <strong><?php echo esc_html( get_theme_mod( 'contact_hours', 'Wizyty po wcześniejszej rezerwacji' ) ); ?></strong>
                </div>
            </div>
        </div>

        <div class="contact__form-wrap reveal reveal--right">
            <?php get_template_part( 'template-parts/contact-form' ); ?>
        </div>
    </div>
</section>

<div class="lightbox" data-lightbox aria-hidden="true" role="dialog" aria-modal="true" aria-label="<?php esc_attr_e( 'Podgląd zdjęcia', 'debowa-zagroda' ); ?>">
    <button type="button" class="lightbox__close" data-lightbox-close aria-label="<?php esc_attr_e( 'Zamknij podgląd', 'debowa-zagroda' ); ?>">×</button>
    <img src="" alt="">
</div>

<?php
get_footer();
