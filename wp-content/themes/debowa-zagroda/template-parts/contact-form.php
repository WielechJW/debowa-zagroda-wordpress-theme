<?php
/**
 * Formularz kontaktowy.
 *
 * @package Debowa_Zagroda
 */

$form_state = isset( $_GET['form'] ) ? sanitize_key( wp_unslash( $_GET['form'] ) ) : '';
$visit_type = isset( $_GET['visit'] ) ? sanitize_text_field( wp_unslash( $_GET['visit'] ) ) : '';
?>

<?php if ( 'success' === $form_state ) : ?>
    <div class="form-message form-message--success" role="status">
        <strong><?php esc_html_e( 'Dziękujemy!', 'debowa-zagroda' ); ?></strong>
        <?php esc_html_e( 'Wiadomość została wysłana. Odezwiemy się najszybciej, jak to możliwe.', 'debowa-zagroda' ); ?>
    </div>
<?php elseif ( 'invalid' === $form_state ) : ?>
    <div class="form-message form-message--error" role="alert"><?php esc_html_e( 'Uzupełnij imię, poprawny e-mail i wiadomość.', 'debowa-zagroda' ); ?></div>
<?php elseif ( 'error' === $form_state ) : ?>
    <div class="form-message form-message--error" role="alert"><?php esc_html_e( 'Nie udało się wysłać wiadomości. Spróbuj ponownie lub napisz do nas bezpośrednio.', 'debowa-zagroda' ); ?></div>
<?php endif; ?>

<form class="contact-form" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" method="post">
    <input type="hidden" name="action" value="debowa_contact">
    <?php wp_nonce_field( 'debowa_contact', 'debowa_contact_nonce' ); ?>
    <div class="form-honeypot" aria-hidden="true">
        <label for="website"><?php esc_html_e( 'Strona internetowa', 'debowa-zagroda' ); ?></label>
        <input id="website" name="website" type="text" tabindex="-1" autocomplete="off">
    </div>

    <div class="form-row">
        <label>
            <span><?php esc_html_e( 'Imię', 'debowa-zagroda' ); ?> *</span>
            <input name="name" type="text" autocomplete="name" required placeholder="<?php esc_attr_e( 'Jak masz na imię?', 'debowa-zagroda' ); ?>">
        </label>
        <label>
            <span><?php esc_html_e( 'E-mail', 'debowa-zagroda' ); ?> *</span>
            <input name="email" type="email" autocomplete="email" required placeholder="<?php esc_attr_e( 'Twój adres e-mail', 'debowa-zagroda' ); ?>">
        </label>
    </div>

    <div class="form-row">
        <label>
            <span><?php esc_html_e( 'Telefon', 'debowa-zagroda' ); ?></span>
            <input name="phone" type="tel" autocomplete="tel" placeholder="<?php esc_attr_e( 'Opcjonalnie', 'debowa-zagroda' ); ?>">
        </label>
        <label>
            <span><?php esc_html_e( 'Interesuje mnie', 'debowa-zagroda' ); ?></span>
            <select name="visit">
                <?php foreach ( debowa_zagroda_offer_packages() as $package ) : ?>
                    <option value="<?php echo esc_attr( $package['title'] ); ?>" <?php selected( $visit_type, $package['title'] ); ?>><?php echo esc_html( $package['title'] ); ?></option>
                <?php endforeach; ?>
                <option value="Oferta indywidualna" <?php selected( $visit_type, 'Oferta indywidualna' ); ?>><?php esc_html_e( 'Wydarzenie / oferta indywidualna', 'debowa-zagroda' ); ?></option>
                <option value="Inne" <?php selected( $visit_type, 'Inne' ); ?>><?php esc_html_e( 'Coś innego', 'debowa-zagroda' ); ?></option>
            </select>
        </label>
    </div>

    <label>
        <span><?php esc_html_e( 'Wiadomość', 'debowa-zagroda' ); ?> *</span>
        <textarea name="message" rows="5" required placeholder="<?php esc_attr_e( 'Napisz, kiedy chcesz nas odwiedzić i ile osób planuje wizytę…', 'debowa-zagroda' ); ?>"></textarea>
    </label>

    <div class="contact-form__footer">
        <p><?php esc_html_e( 'Wysyłając formularz, zgadzasz się na kontakt w sprawie wizyty.', 'debowa-zagroda' ); ?></p>
        <button class="button button--primary" type="submit">
            <?php esc_html_e( 'Wyślij wiadomość', 'debowa-zagroda' ); ?>
            <span aria-hidden="true">↗</span>
        </button>
    </div>
</form>
