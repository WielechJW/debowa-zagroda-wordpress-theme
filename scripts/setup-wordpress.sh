#!/bin/sh

set -eu

wp_path="/var/www/html"
max_attempts=60
attempt=1

echo "Oczekiwanie na pliki WordPressa..."

while [ ! -f "${wp_path}/wp-config.php" ]; do
  if [ "${attempt}" -ge "${max_attempts}" ]; then
    echo "Nie udało się znaleźć wp-config.php w wyznaczonym czasie." >&2
    exit 1
  fi

  attempt=$((attempt + 1))
  sleep 2
done

if ! wp core is-installed --path="${wp_path}"; then
  echo "Instalowanie WordPressa..."
  wp core install \
    --path="${wp_path}" \
    --url="${WP_URL}" \
    --title="${WP_TITLE}" \
    --admin_user="${WP_ADMIN_USER}" \
    --admin_password="${WP_ADMIN_PASSWORD}" \
    --admin_email="${WP_ADMIN_EMAIL}" \
    --skip-email
else
  echo "WordPress jest już zainstalowany."
fi

wp theme activate debowa-zagroda --path="${wp_path}"
wp option update blogdescription "Alpakarnia blisko natury" --path="${wp_path}"
wp option update timezone_string "Europe/Warsaw" --path="${wp_path}"

offer_page_id="$(wp post list --post_type=page --name=oferta --post_status=publish,draft,pending,private,future --field=ID --path="${wp_path}")"
if [ -z "${offer_page_id}" ]; then
  wp post create --post_type=page --post_title="Oferta i cennik" --post_name=oferta \
    --post_status=publish --page_template=page-oferta.php --path="${wp_path}"
fi

contact_page_id="$(wp post list --post_type=page --name=kontakt --post_status=publish,draft,pending,private,future --field=ID --path="${wp_path}")"
if [ -z "${contact_page_id}" ]; then
  wp post create --post_type=page --post_title="Kontakt" --post_name=kontakt \
    --post_status=publish --page_template=page-kontakt.php --path="${wp_path}"
fi

wp rewrite structure '/%postname%/' --path="${wp_path}"
# WP-CLI cannot detect Apache from the separate CLI container. Write the
# generated WordPress rules while preserving other .htaccess sections.
wp eval '
  require_once ABSPATH . "wp-admin/includes/misc.php";
  global $wp_rewrite;
  if (!insert_with_markers(ABSPATH . ".htaccess", "WordPress", $wp_rewrite->mod_rewrite_rules())) {
    WP_CLI::error("Nie udało się zapisać reguł adresów w .htaccess.");
  }
' --path="${wp_path}"

echo "Gotowe: ${WP_URL}"
