<?php
/**
 * Funkcje motywu Dębowa Zagroda.
 *
 * @package Debowa_Zagroda
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

require_once get_template_directory() . '/inc/offer.php';
require_once get_template_directory() . '/inc/contact.php';

function debowa_zagroda_setup(): void {
    load_theme_textdomain( 'debowa-zagroda', get_template_directory() . '/languages' );
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'responsive-embeds' );
    add_theme_support( 'editor-styles' );
    add_editor_style( 'style.css' );
    add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption', 'style', 'script' ) );
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

function debowa_zagroda_assets(): void {
    $theme = wp_get_theme();
    wp_enqueue_style( 'debowa-zagroda-style', get_stylesheet_uri(), array(), $theme->get( 'Version' ) );
    wp_enqueue_script( 'debowa-zagroda-script', get_template_directory_uri() . '/assets/js/main.js', array(), $theme->get( 'Version' ), true );
}
add_action( 'wp_enqueue_scripts', 'debowa_zagroda_assets' );

function debowa_zagroda_image( string $filename ): string {
    return get_template_directory_uri() . '/assets/images/' . ltrim( $filename, '/' );
}

function debowa_zagroda_gallery_defaults(): array {
    $photos = array(
        array(
            'file'  => 'galeria_4',
            'alt'   => __( 'Cztery alpaki na leśnej ścieżce', 'debowa-zagroda' ),
            'class' => 'gallery-photo--forest',
        ),
        array(
            'file'  => 'galeria_5',
            'alt'   => __( 'Spotkanie z alpakami podczas spaceru w lesie', 'debowa-zagroda' ),
            'class' => 'gallery-photo--meeting',
        ),
        array(
            'file'  => 'galeria_6',
            'alt'   => __( 'Spokojny spacer z alpakami wśród drzew', 'debowa-zagroda' ),
            'class' => 'gallery-photo--walk',
        ),
        array(
            'file'  => 'galeria_9',
            'alt'   => __( 'Alpaki pasące się na słonecznej łące', 'debowa-zagroda' ),
            'class' => 'gallery-photo--meadow',
        ),
        array(
            'file'  => 'galeria_2',
            'alt'   => __( 'Alpaki na wybiegu w Dębowej Zagrodzie', 'debowa-zagroda' ),
            'class' => 'gallery-photo--paddock',
        ),
        array(
            'file'  => 'galeria_8',
            'alt'   => __( 'Goście z czterema alpakami podczas spaceru w lesie', 'debowa-zagroda' ),
            'class' => 'gallery-photo--guests',
        ),
    );

    foreach ( $photos as $index => $photo ) {
        $photos[ $index ]['image']         = debowa_zagroda_image( $photo['file'] . '.jpg' );
        $photos[ $index ]['preview']       = debowa_zagroda_image( $photo['file'] . '-1600.webp' );
        $photos[ $index ]['small_preview'] = debowa_zagroda_image( $photo['file'] . '-800.webp' );
        $photos[ $index ]['height']        = in_array( $photo['file'], array( 'galeria_2', 'galeria_8' ), true ) ? 2133 : 1200;
    }

    return $photos;
}

function debowa_zagroda_brand_name(): string {
    $name = get_bloginfo( 'name' );
    return 'debowa zagroda' === strtolower( remove_accents( $name ) ) ? 'Dębowa Zagroda' : $name;
}

function debowa_zagroda_fallback_menu(): void {
    $base = is_front_page() ? '' : home_url( '/' );
    ?>
    <ul id="primary-menu" class="menu">
        <li><a href="<?php echo esc_url( $base . '#o-nas' ); ?>"><?php esc_html_e( 'O nas', 'debowa-zagroda' ); ?></a></li>
        <li><a href="<?php echo esc_url( debowa_zagroda_offer_url() ); ?>"<?php if ( is_page( 'oferta' ) || is_page_template( 'page-oferta.php' ) ) : ?> class="is-active" aria-current="page"<?php endif; ?>><?php esc_html_e( 'Oferta i cennik', 'debowa-zagroda' ); ?></a></li>
        <li><a href="<?php echo esc_url( $base . '#alpaki' ); ?>"><?php esc_html_e( 'Nasze alpaki', 'debowa-zagroda' ); ?></a></li>
        <li><a href="<?php echo esc_url( $base . '#galeria' ); ?>"><?php esc_html_e( 'Galeria', 'debowa-zagroda' ); ?></a></li>
        <li><a class="menu-cta" href="<?php echo esc_url( debowa_zagroda_contact_url() ); ?>"<?php if ( is_page( 'kontakt' ) || is_page_template( 'page-kontakt.php' ) ) : ?> aria-current="page"<?php endif; ?>><?php esc_html_e( 'Kontakt', 'debowa-zagroda' ); ?></a></li>
    </ul>
    <?php
}

function debowa_zagroda_customize_register( WP_Customize_Manager $wp_customize ): void {
    $wp_customize->add_panel(
        'debowa_homepage',
        array(
            'title'       => __( 'Dębowa Zagroda — strona główna', 'debowa-zagroda' ),
            'description' => __( 'Tutaj zmienisz teksty, zdjęcia i dane widoczne na stronie one-page.', 'debowa-zagroda' ),
            'priority'    => 30,
        )
    );

    $sections = array(
        'hero'    => __( 'Hero', 'debowa-zagroda' ),
        'about'   => __( 'O nas', 'debowa-zagroda' ),
        'offers'  => __( 'Oferta', 'debowa-zagroda' ),
        'alpacas' => __( 'Nasze alpaki', 'debowa-zagroda' ),
        'gallery' => __( 'Galeria', 'debowa-zagroda' ),
        'contact' => __( 'Kontakt i stopka', 'debowa-zagroda' ),
    );

    foreach ( $sections as $id => $title ) {
        $wp_customize->add_section( 'debowa_' . $id, array( 'title' => $title, 'panel' => 'debowa_homepage' ) );
    }

    $text_settings = array(
        'hero_eyebrow'       => array( 'hero', __( 'Nadtytuł', 'debowa-zagroda' ), 'Blisko natury. Blisko alpak.' ),
        'hero_title'         => array( 'hero', __( 'Tytuł', 'debowa-zagroda' ), 'Zwolnij. Alpaki już na Ciebie czekają.' ),
        'hero_text'          => array( 'hero', __( 'Opis', 'debowa-zagroda' ), 'Dębowa Zagroda to kameralne miejsce, w którym możesz odetchnąć, poznać nasze alpaki i zabrać ze sobą naprawdę dobre wspomnienia.' ),
        'hero_button'        => array( 'hero', __( 'Tekst głównego przycisku', 'debowa-zagroda' ), 'Zaplanuj wizytę' ),
        'hero_second_button' => array( 'hero', __( 'Tekst drugiego przycisku', 'debowa-zagroda' ), 'Poznaj nasze alpaki' ),
        'about_eyebrow'      => array( 'about', __( 'Nadtytuł', 'debowa-zagroda' ), 'Kilka słów o nas' ),
        'about_title'        => array( 'about', __( 'Tytuł', 'debowa-zagroda' ), 'Tu czas płynie trochę wolniej' ),
        'about_text'         => array( 'about', __( 'Opis', 'debowa-zagroda' ), 'Stworzyliśmy Dębową Zagrodę z miłości do zwierząt, spokojnych poranków i prostych chwil blisko natury. Nasze spotkania odbywają się w małych grupach, dzięki czemu każdy ma czas naprawdę poznać alpaki.' ),
        'about_note'         => array( 'about', __( 'Krótka informacja', 'debowa-zagroda' ), 'Kameralnie, bez pośpiechu i z szacunkiem do zwierząt.' ),
        'about_fact_1_value' => array( 'about', __( 'Fakt 1 — wartość', 'debowa-zagroda' ), '4' ),
        'about_fact_1_label' => array( 'about', __( 'Fakt 1 — opis', 'debowa-zagroda' ), 'wyjątkowe alpaki' ),
        'about_fact_2_value' => array( 'about', __( 'Fakt 2 — wartość', 'debowa-zagroda' ), '100%' ),
        'about_fact_2_label' => array( 'about', __( 'Fakt 2 — opis', 'debowa-zagroda' ), 'blisko natury' ),
        'about_fact_3_value' => array( 'about', __( 'Fakt 3 — wartość', 'debowa-zagroda' ), '∞' ),
        'about_fact_3_label' => array( 'about', __( 'Fakt 3 — opis', 'debowa-zagroda' ), 'dobrych wspomnień' ),
        'offers_eyebrow'     => array( 'offers', __( 'Nadtytuł', 'debowa-zagroda' ), 'Co możemy razem zrobić?' ),
        'offers_title'       => array( 'offers', __( 'Tytuł sekcji', 'debowa-zagroda' ), 'Wybierz swój sposób na spotkanie' ),
        'offers_intro'       => array( 'offers', __( 'Krótki opis sekcji', 'debowa-zagroda' ), 'Każde spotkanie dopasowujemy do rytmu zwierząt i potrzeb naszych gości.' ),
        'offer_1_title'      => array( 'offers', __( 'Oferta 1 — tytuł', 'debowa-zagroda' ), 'Spacer z alpakami' ),
        'offer_1_text'       => array( 'offers', __( 'Oferta 1 — opis', 'debowa-zagroda' ), 'Spokojna wyprawa polną ścieżką w towarzystwie naszych puchatych przewodników. Czas na zdjęcia, głaskanie i poznanie ich charakterów.' ),
        'offer_1_meta'       => array( 'offers', __( 'Oferta 1 — informacje', 'debowa-zagroda' ), 'około 1 godz.' ),
        'offer_2_title'      => array( 'offers', __( 'Oferta 2 — tytuł', 'debowa-zagroda' ), 'Wizyta w zagrodzie' ),
        'offer_2_text'       => array( 'offers', __( 'Oferta 2 — opis', 'debowa-zagroda' ), 'Poznaj całą ekipę z bliska, dowiedz się, co alpaki lubią najbardziej i spędź swobodny czas w ich spokojnym rytmie.' ),
        'offer_2_meta'       => array( 'offers', __( 'Oferta 2 — informacje', 'debowa-zagroda' ), '30–40 min' ),
        'offers_button'      => array( 'offers', __( 'Tekst przycisku', 'debowa-zagroda' ), 'Zapytaj o termin' ),
        'alpacas_eyebrow'    => array( 'alpacas', __( 'Nadtytuł', 'debowa-zagroda' ), 'Poznaj nasze alpaki' ),
        'alpacas_title'      => array( 'alpacas', __( 'Tytuł sekcji', 'debowa-zagroda' ), 'Cztery charaktery. Jedno stado.' ),
        'alpaca_1_name'      => array( 'alpacas', __( 'Alpaka 1 — imię', 'debowa-zagroda' ), 'Lord' ),
        'alpaca_1_text'      => array( 'alpacas', __( 'Alpaka 1 — opis', 'debowa-zagroda' ), 'Ciekawska obserwatorka i pierwsza przy płocie.' ),
        'alpaca_2_name'      => array( 'alpacas', __( 'Alpaka 2 — imię', 'debowa-zagroda' ), 'Barri' ),
        'alpaca_2_text'      => array( 'alpacas', __( 'Alpaka 2 — opis', 'debowa-zagroda' ), 'Spokojny łakomczuch o karmelowym futrze.' ),
        'alpaca_3_name'      => array( 'alpacas', __( 'Alpaka 3 — imię', 'debowa-zagroda' ), 'Pierro' ),
        'alpaca_3_text'      => array( 'alpacas', __( 'Alpaka 3 — opis', 'debowa-zagroda' ), 'Dostojny indywidualista, który zna swoją wartość.' ),
        'alpaca_4_name'      => array( 'alpacas', __( 'Alpaka 4 — imię', 'debowa-zagroda' ), 'Ricco' ),
        'alpaca_4_text'      => array( 'alpacas', __( 'Alpaka 4 — opis', 'debowa-zagroda' ), 'Delikatna dusza i mistrzyni słodkich spojrzeń.' ),
        'gallery_eyebrow'    => array( 'gallery', __( 'Nadtytuł', 'debowa-zagroda' ), 'Z życia zagrody' ),
        'gallery_title'      => array( 'gallery', __( 'Tytuł sekcji', 'debowa-zagroda' ), 'Chwile, które zostają na dłużej' ),
        'contact_eyebrow'    => array( 'contact', __( 'Nadtytuł', 'debowa-zagroda' ), 'Do zobaczenia w zagrodzie' ),
        'contact_title'      => array( 'contact', __( 'Tytuł sekcji', 'debowa-zagroda' ), 'Masz ochotę nas odwiedzić?' ),
        'contact_text'       => array( 'contact', __( 'Opis', 'debowa-zagroda' ), 'Napisz, jaki termin i rodzaj spotkania Cię interesuje. Odezwiemy się i wspólnie ustalimy szczegóły.' ),
        'contact_address'    => array( 'contact', __( 'Adres', 'debowa-zagroda' ), 'Dębowa 3e, Warszawa' ),
        'contact_phone'      => array( 'contact', __( 'Telefon', 'debowa-zagroda' ), '+48 608 242 618' ),
        'contact_hours'      => array( 'contact', __( 'Godziny wizyt', 'debowa-zagroda' ), 'Wizyty po wcześniejszej rezerwacji' ),
        'footer_text'        => array( 'contact', __( 'Tekst w stopce', 'debowa-zagroda' ), 'Kameralne spotkania z alpakami, blisko natury.' ),
    );

    $priority = 10;
    foreach ( $text_settings as $id => $data ) {
        $is_long = str_contains( $id, '_text' ) || in_array( $id, array( 'about_note', 'contact_hours' ), true );
        $wp_customize->add_setting(
            $id,
            array(
                'default'           => $data[2],
                'sanitize_callback' => $is_long ? 'sanitize_textarea_field' : 'sanitize_text_field',
                'transport'         => 'refresh',
            )
        );
        $wp_customize->add_control(
            $id,
            array(
                'label'    => $data[1],
                'section'  => 'debowa_' . $data[0],
                'type'     => $is_long ? 'textarea' : 'text',
                'priority' => $priority++,
            )
        );
    }

    $url_settings = array(
        'contact_email' => array( 'contact', __( 'E-mail odbiorcy formularza', 'debowa-zagroda' ), 'kontakt@debowazagroda.pl', 'sanitize_email' ),
        'facebook_url'  => array( 'contact', __( 'Facebook — adres URL', 'debowa-zagroda' ), '', 'esc_url_raw' ),
        'instagram_url' => array( 'contact', __( 'Instagram — adres URL', 'debowa-zagroda' ), '', 'esc_url_raw' ),
        'maps_url'      => array( 'contact', __( 'Mapa / dojazd — adres URL', 'debowa-zagroda' ), '', 'esc_url_raw' ),
    );

    foreach ( $url_settings as $id => $data ) {
        $wp_customize->add_setting( $id, array( 'default' => $data[2], 'sanitize_callback' => $data[3] ) );
        $wp_customize->add_control(
            $id,
            array(
                'label'   => $data[1],
                'section' => 'debowa_' . $data[0],
                'type'    => 'contact_email' === $id ? 'email' : 'url',
            )
        );
    }

    $images = array(
        'hero_image'      => array( 'hero', __( 'Zdjęcie główne', 'debowa-zagroda' ), debowa_zagroda_image( 'hero-las.webp' ) ),
        'about_image'     => array( 'about', __( 'Zdjęcie w sekcji', 'debowa-zagroda' ), debowa_zagroda_image( 'czas-section.webp' ) ),
        'offer_1_image'   => array( 'offers', __( 'Oferta 1 — zdjęcie', 'debowa-zagroda' ), debowa_zagroda_image( 'spacer.webp' ) ),
        'offer_2_image'   => array( 'offers', __( 'Oferta 2 — zdjęcie', 'debowa-zagroda' ), debowa_zagroda_image( 'zagroda.webp' ) ),
        'alpaca_1_image'  => array( 'alpacas', __( 'Alpaka 1 — zdjęcie', 'debowa-zagroda' ), debowa_zagroda_image( 'lord.jpg' ) ),
        'alpaca_2_image'  => array( 'alpacas', __( 'Alpaka 2 — zdjęcie', 'debowa-zagroda' ), debowa_zagroda_image( 'barri.jpg' ) ),
        'alpaca_3_image'  => array( 'alpacas', __( 'Alpaka 3 — zdjęcie', 'debowa-zagroda' ), debowa_zagroda_image( 'pierro.jpg' ) ),
        'alpaca_4_image'  => array( 'alpacas', __( 'Alpaka 4 — zdjęcie', 'debowa-zagroda' ), debowa_zagroda_image( 'ricco.jpg' ) ),
    );

    foreach ( debowa_zagroda_gallery_defaults() as $index => $photo ) {
        $number = $index + 1;
        $images[ 'gallery_image_' . $number ] = array( 'gallery', sprintf( __( 'Zdjęcie %d', 'debowa-zagroda' ), $number ), $photo['image'] );
    }

    foreach ( $images as $id => $data ) {
        $wp_customize->add_setting( $id, array( 'default' => $data[2], 'sanitize_callback' => 'esc_url_raw' ) );
        $wp_customize->add_control(
            new WP_Customize_Image_Control(
                $wp_customize,
                $id,
                array(
                    'label'   => $data[1],
                    'section' => 'debowa_' . $data[0],
                )
            )
        );
    }
}
add_action( 'customize_register', 'debowa_zagroda_customize_register' );

function debowa_zagroda_handle_contact_form(): void {
    $redirect = debowa_zagroda_contact_url() . '#formularz';
    if (
        ! isset( $_POST['debowa_contact_nonce'] ) ||
        ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['debowa_contact_nonce'] ) ), 'debowa_contact' )
    ) {
        wp_safe_redirect( add_query_arg( 'form', 'error', $redirect ) );
        exit;
    }

    if ( ! empty( $_POST['website'] ) ) {
        wp_safe_redirect( add_query_arg( 'form', 'success', $redirect ) );
        exit;
    }

    $name    = isset( $_POST['name'] ) ? sanitize_text_field( wp_unslash( $_POST['name'] ) ) : '';
    $email   = isset( $_POST['email'] ) ? sanitize_email( wp_unslash( $_POST['email'] ) ) : '';
    $phone   = isset( $_POST['phone'] ) ? sanitize_text_field( wp_unslash( $_POST['phone'] ) ) : '';
    $visit   = isset( $_POST['visit'] ) ? sanitize_text_field( wp_unslash( $_POST['visit'] ) ) : '';
    $message = isset( $_POST['message'] ) ? sanitize_textarea_field( wp_unslash( $_POST['message'] ) ) : '';

    $visits = array_column( debowa_zagroda_offer_packages(), 'title' );
    $visits = array_merge( $visits, array( 'Oferta indywidualna', 'Inne' ) );
    if ( in_array( $visit, $visits, true ) ) {
        $redirect = add_query_arg( 'visit', $visit, $redirect );
    }

    if ( '' === $name || ! is_email( $email ) || '' === $message ) {
        wp_safe_redirect( add_query_arg( 'form', 'invalid', $redirect ) );
        exit;
    }

    $recipient = sanitize_email( get_theme_mod( 'contact_email', 'kontakt@debowazagroda.pl' ) );
    $subject   = sprintf( __( '[Dębowa Zagroda] Wiadomość od %s', 'debowa-zagroda' ), $name );
    $body      = sprintf(
        "Imię: %s\nE-mail: %s\nTelefon: %s\nRodzaj wizyty: %s\n\nWiadomość:\n%s",
        $name,
        $email,
        $phone,
        $visit,
        $message
    );
    $headers = array( 'Reply-To: ' . $name . ' <' . $email . '>' );
    $sent    = wp_mail( $recipient, $subject, $body, $headers );

    wp_safe_redirect( add_query_arg( 'form', $sent ? 'success' : 'error', $redirect ) );
    exit;
}
add_action( 'admin_post_debowa_contact', 'debowa_zagroda_handle_contact_form' );
add_action( 'admin_post_nopriv_debowa_contact', 'debowa_zagroda_handle_contact_form' );
