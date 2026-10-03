<?php
/**
 * Template Name: Oferta i cennik
 *
 * @package Debowa_Zagroda
 */

get_header();

$packages  = debowa_zagroda_offer_packages();
$phone     = get_theme_mod( 'contact_phone', '+48 608 242 618' );
$phone_url = 'tel:' . preg_replace( '/[^0-9+]/', '', $phone );
$facebook  = get_theme_mod( 'facebook_url', '' );
$events    = array( 'Urodziny z alpakami', 'Przedszkola i szkoły', 'Festyny i imprezy plenerowe', 'Oferta dla firm', 'Alpaki na wesela i imprezy okolicznościowe' );
?>

<section id="start" class="offer-intro" aria-labelledby="offer-title">
    <div class="site-shell offer-intro__inner">
        <div class="offer-intro__content">
            <a class="offer-back" href="<?php echo esc_url( home_url( '/' ) ); ?>"><span aria-hidden="true">←</span> <?php esc_html_e( 'Wróć do zagrody', 'debowa-zagroda' ); ?></a>
            <p class="eyebrow" data-hero-item><span class="eyebrow__line"></span><?php esc_html_e( 'Oferta i cennik', 'debowa-zagroda' ); ?></p>
            <h1 id="offer-title" data-hero-item><?php esc_html_e( 'Małe spotkania.', 'debowa-zagroda' ); ?><br><em><?php esc_html_e( 'Dużo wspomnień.', 'debowa-zagroda' ); ?></em></h1>
            <p class="section-lead" data-hero-item><?php esc_html_e( 'Poznaj alpaki, rusz z nimi na spacer albo zaplanuj coś wyjątkowego. Wybierz swoją chwilę blisko natury — my zadbamy o puchate towarzystwo.', 'debowa-zagroda' ); ?></p>
            <div class="hero__actions" data-hero-item>
                <a class="button button--primary" href="#cennik"><?php esc_html_e( 'Sprawdź cennik', 'debowa-zagroda' ); ?><span aria-hidden="true">↓</span></a>
                <a class="button button--ghost" href="#rezerwacja"><?php esc_html_e( 'Zaplanuj wizytę', 'debowa-zagroda' ); ?><span aria-hidden="true">↗</span></a>
            </div>
        </div>
        <div class="offer-intro__visual reveal reveal--right">
            <div class="about__image-wrap">
                <img src="<?php echo esc_url( get_theme_mod( 'offer_2_image', debowa_zagroda_image( 'zagroda.webp' ) ) ); ?>" alt="<?php esc_attr_e( 'Alpaki w Dębowej Zagrodzie', 'debowa-zagroda' ); ?>" fetchpriority="high">
            </div>
            <div class="offer-intro__note" data-float><span aria-hidden="true">✦</span><?php esc_html_e( 'Blisko natury.', 'debowa-zagroda' ); ?><br><?php esc_html_e( 'Blisko siebie.', 'debowa-zagroda' ); ?></div>
        </div>
    </div>
    <nav class="site-shell offer-sections" aria-label="<?php esc_attr_e( 'Rodzaje oferty', 'debowa-zagroda' ); ?>">
        <a href="#cennik"><?php esc_html_e( 'Spotkania i spacery', 'debowa-zagroda' ); ?></a>
        <a href="#indywidualnie"><?php esc_html_e( 'Tylko dla Ciebie', 'debowa-zagroda' ); ?></a>
        <a href="#sesje"><?php esc_html_e( 'Sesje zdjęciowe', 'debowa-zagroda' ); ?></a>
        <a href="#wydarzenia"><?php esc_html_e( 'Wyjątkowe okazje', 'debowa-zagroda' ); ?></a>
    </nav>
</section>

<section id="cennik" class="section section--pricing" aria-labelledby="pricing-title">
    <div class="site-shell">
        <header class="section-heading section-heading--split reveal">
            <div>
                <p class="eyebrow"><span class="eyebrow__line"></span><?php esc_html_e( 'Chodź, poznajmy się', 'debowa-zagroda' ); ?></p>
                <h2 id="pricing-title"><?php esc_html_e( 'Spotkania i spacery', 'debowa-zagroda' ); ?></h2>
            </div>
            <p><?php esc_html_e( 'Od pierwszego głaskania po dłuższą wyprawę do lasu. W każdym spotkaniu jest czas na poznanie alpak i wspólne zdjęcia.', 'debowa-zagroda' ); ?></p>
        </header>
        <div class="pricing-grid">
            <?php foreach ( array( 'meeting', 'walk', 'forest' ) as $index => $id ) :
                $package = $packages[ $id ];
                ?>
                <article class="price-card reveal" aria-labelledby="package-<?php echo esc_attr( $id ); ?>">
                    <div class="price-card__top"><span class="price-card__index">0<?php echo esc_html( (string) ( $index + 1 ) ); ?></span><span class="price-card__duration"><?php echo esc_html( $package['duration'] ); ?></span></div>
                    <h3 id="package-<?php echo esc_attr( $id ); ?>"><?php echo esc_html( $package['title'] ); ?></h3>
                    <p class="price-card__description"><?php echo esc_html( $package['text'] ); ?></p>
                    <p class="price-card__price"><strong><?php echo esc_html( $package['price'] ); ?></strong><span><?php esc_html_e( 'zł / osoba', 'debowa-zagroda' ); ?></span></p>
                    <ul class="price-card__features">
                        <?php foreach ( $package['features'] as $feature ) : ?><li><?php echo esc_html( $feature ); ?></li><?php endforeach; ?>
                    </ul>
                    <div class="price-card__bottom">
                        <p class="price-card__note">
                            <?php if ( 'forest' === $id ) : ?>
                                <strong><?php esc_html_e( 'Minimum 2 osoby.', 'debowa-zagroda' ); ?></strong><br>
                                <?php echo esc_html( sprintf( __( 'Przy grupach powyżej 4 osób: %s zł za każdą kolejną osobę.', 'debowa-zagroda' ), get_theme_mod( 'pricing_forest_extra', '80' ) ) ); ?>
                            <?php else : ?>
                                <strong><?php esc_html_e( 'Dzieci do 3 lat bezpłatnie.', 'debowa-zagroda' ); ?></strong><br>
                                <?php esc_html_e( 'Pod opieką osoby dorosłej.', 'debowa-zagroda' ); ?>
                            <?php endif; ?>
                        </p>
                        <a class="button button--primary" href="<?php echo esc_url( debowa_zagroda_booking_url( $package['title'] ) ); ?>" aria-label="<?php echo esc_attr( 'Zapytaj o termin: ' . $package['title'] ); ?>"><?php esc_html_e( 'Zapytaj o termin', 'debowa-zagroda' ); ?><span aria-hidden="true">↗</span></a>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section id="indywidualnie" class="section section--offers section--private" aria-labelledby="private-title">
    <div class="site-shell">
        <header class="section-heading section-heading--split reveal">
            <div>
                <p class="eyebrow eyebrow--light"><span class="eyebrow__line"></span><?php esc_html_e( 'Twój czas, Twoje tempo', 'debowa-zagroda' ); ?></p>
                <h2 id="private-title"><?php esc_html_e( 'Spotkania indywidualne', 'debowa-zagroda' ); ?></h2>
            </div>
            <p><?php esc_html_e( 'Jeśli chcesz spędzić czas z alpakami tylko z bliską osobą albo sam na sam z naszymi zwierzakami, te spotkania są dla Ciebie.', 'debowa-zagroda' ); ?></p>
        </header>
        <div class="private-grid">
            <?php foreach ( array( 'private_meeting', 'private_walk', 'private_forest' ) as $id ) :
                $package = $packages[ $id ];
                ?>
                <article class="private-card reveal">
                    <p class="private-card__duration"><?php echo esc_html( $package['duration'] ); ?></p>
                    <h3><?php echo esc_html( $package['title'] ); ?></h3>
                    <div class="private-card__bottom">
                        <p class="private-card__price"><strong><?php echo esc_html( $package['price'] ); ?></strong> <span><?php esc_html_e( 'zł / osoba', 'debowa-zagroda' ); ?></span></p>
                        <a class="button button--cream" href="<?php echo esc_url( debowa_zagroda_booking_url( $package['title'] ) ); ?>" aria-label="<?php echo esc_attr( 'Zapytaj o termin: ' . $package['title'] ); ?>"><?php esc_html_e( 'Zapytaj o termin', 'debowa-zagroda' ); ?><span aria-hidden="true">↗</span></a>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section id="sesje" class="section section--photo" aria-labelledby="photo-title">
    <div class="site-shell photo-offer">
        <div class="photo-offer__media reveal reveal--left">
            <img src="<?php echo esc_url( get_theme_mod( 'hero_image', debowa_zagroda_image( 'hero-alpacas.webp' ) ) ); ?>" alt="<?php esc_attr_e( 'Puchate alpaki pośród zieleni', 'debowa-zagroda' ); ?>" loading="lazy">
            <span class="photo-offer__caption"><?php esc_html_e( 'Wspomnienia, do których chce się wracać.', 'debowa-zagroda' ); ?></span>
        </div>
        <div class="photo-offer__content reveal reveal--right">
            <p class="eyebrow"><span class="eyebrow__line"></span><?php esc_html_e( 'Zatrzymaj tę chwilę', 'debowa-zagroda' ); ?></p>
            <h2 id="photo-title"><?php esc_html_e( 'Sesja zdjęciowa z alpakami', 'debowa-zagroda' ); ?></h2>
            <p class="section-lead"><?php esc_html_e( 'Miękkie futerka, naturalne światło i Wasze uśmiechy. Wyjątkowe tło do zdjęć rodzinnych, we dwoje lub tylko dla siebie.', 'debowa-zagroda' ); ?></p>
            <dl class="photo-prices">
                <?php foreach ( array( 'photo_short', 'photo_long' ) as $id ) : ?>
                    <div><dt><?php echo esc_html( $packages[ $id ]['duration'] ); ?></dt><dd><?php echo esc_html( $packages[ $id ]['price'] ); ?> <span><?php esc_html_e( 'zł', 'debowa-zagroda' ); ?></span></dd></div>
                <?php endforeach; ?>
            </dl>
            <p class="photo-offer__note"><?php esc_html_e( 'Możesz przyjechać z własnym fotografem lub skorzystać z naszego fotografa — jego usługa jest wyceniana indywidualnie.', 'debowa-zagroda' ); ?></p>
            <a class="button button--primary" href="<?php echo esc_url( debowa_zagroda_booking_url( $packages['photo_short']['title'] ) ); ?>"><?php esc_html_e( 'Zaplanuj sesję', 'debowa-zagroda' ); ?><span aria-hidden="true">↗</span></a>
        </div>
    </div>
</section>

<section id="wydarzenia" class="section section--events" aria-labelledby="events-title">
    <div class="site-shell events-offer">
        <div class="events-offer__intro reveal">
            <p class="eyebrow"><span class="eyebrow__line"></span><?php esc_html_e( 'Oferta indywidualna', 'debowa-zagroda' ); ?></p>
            <h2 id="events-title"><?php esc_html_e( 'Wyjątkowe okazje. Puchaci goście.', 'debowa-zagroda' ); ?></h2>
            <p class="section-lead"><?php esc_html_e( 'Urodziny, wspólny dzień poza szkołą, a może ważna uroczystość? Opowiedz nam o swoim pomyśle, a wspólnie ustalimy szczegóły.', 'debowa-zagroda' ); ?></p>
        </div>
        <div class="events-offer__details reveal">
            <ul class="events-offer__list">
                <?php foreach ( $events as $event ) : ?><li><span aria-hidden="true">✦</span><?php echo esc_html( $event ); ?></li><?php endforeach; ?>
            </ul>
            <div class="events-offer__footer">
                <span><?php esc_html_e( 'Wycena indywidualna', 'debowa-zagroda' ); ?></span>
                <a class="button button--primary" href="<?php echo esc_url( debowa_zagroda_booking_url( 'Oferta indywidualna' ) ); ?>"><?php esc_html_e( 'Porozmawiajmy', 'debowa-zagroda' ); ?><span aria-hidden="true">↗</span></a>
            </div>
        </div>
    </div>
</section>

<section id="rezerwacja" class="section section--booking" aria-labelledby="booking-title">
    <div class="site-shell booking-offer reveal">
        <p class="eyebrow"><span class="eyebrow__line"></span><?php esc_html_e( 'Do zobaczenia w zagrodzie', 'debowa-zagroda' ); ?><span class="eyebrow__line"></span></p>
        <h2 id="booking-title"><?php esc_html_e( 'Twoja chwila z alpakami czeka.', 'debowa-zagroda' ); ?></h2>
        <p class="section-lead"><?php esc_html_e( 'Wizyty odbywają się po wcześniejszej rezerwacji. Zadzwoń lub napisz do nas, żeby ustalić termin i rodzaj spotkania.', 'debowa-zagroda' ); ?></p>
        <div class="booking-offer__actions">
            <a class="button button--primary" href="<?php echo esc_url( $phone_url ); ?>"><?php echo esc_html( $phone ); ?><span aria-hidden="true">↗</span></a>
            <a class="button button--ghost" href="<?php echo esc_url( $facebook ?: debowa_zagroda_contact_url() . '#formularz' ); ?>"<?php if ( $facebook ) : ?> target="_blank" rel="noopener"<?php endif; ?>><?php esc_html_e( 'Napisz do nas', 'debowa-zagroda' ); ?><span aria-hidden="true">↗</span></a>
        </div>
        <p class="booking-offer__address"><?php echo esc_html( get_theme_mod( 'contact_address', 'Dębowa 3e, Warszawa' ) ); ?></p>
    </div>
</section>

<?php get_footer(); ?>
