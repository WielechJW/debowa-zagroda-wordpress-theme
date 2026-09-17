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
wp rewrite structure '/%postname%/' --hard --path="${wp_path}"

echo "Gotowe: ${WP_URL}"
