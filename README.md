# Dębowa Zagroda — WordPress

A local, Docker-based WordPress environment for an alpaca farm website. The repository includes a custom classic theme called `debowa-zagroda`; WordPress files and database data are stored in Docker volumes.

## Requirements

- Docker Desktop or Docker Engine with the Compose plugin
- `make` (optional)

## Getting Started

```bash
cp .env.example .env
docker compose up -d
```

The first startup may take several seconds while Docker downloads the images and the `setup` service installs WordPress and activates the theme.

- Website: http://localhost:8080
- Admin panel: http://localhost:8080/wp-admin
- Default username: `admin`
- Default password: `admin`

Before you start working, change the administrator credentials in `.env`. This file is ignored by Git.

You can also use the following shortcuts:

```bash
make up
make logs
make status
make down
```

## Theme

The theme code is located in:

```text
wp-content/themes/debowa-zagroda/
```

Changes to PHP, CSS, and JavaScript files are reflected in the container immediately. The theme includes a complete animated one-page homepage, sticky navigation, editable sections, a native contact form, responsive layouts, menus, logo support, featured images, and editor styles.

### Editing the homepage

Open **Appearance → Customize → Dębowa Zagroda — strona główna**. The panel contains separate groups for Hero, About, Offer, Alpacas, Gallery, and Contact/Footer. All main marketing copy, contact details, social links, and homepage images can be replaced there without editing code.

The contact form sends messages to the address configured in **Kontakt i stopka → E-mail odbiorcy formularza**. On production, configure WordPress mail delivery (SMTP or a transactional mail provider) to ensure reliable delivery.

### Offer and pricing page

The **Oferta i cennik** page uses `page-oferta.php` and includes meetings, walks, private visits, photo sessions, and individually priced events. Change prices and durations in **Appearance → Customize → Dębowa Zagroda — oferta i cennik**. Booking links select the matching visit in the contact page form.

The setup script creates the published `/oferta/` page if it does not exist. For an existing installation, create a page with the slug `oferta` and select the **Oferta i cennik** template (or run the command below). The default navigation and footer link to it automatically; if you use a custom WordPress menu, add the page to that menu.

```bash
make wp ARGS='post create --post_type=page --post_title="Oferta i cennik" --post_name=oferta --post_status=publish --page_template=page-oferta.php'
```

### Contact page

The `/kontakt/` page uses `page-kontakt.php` and includes contact details, a reservation form, social links when configured, and a directions link. Its text and contact details use the existing **Appearance → Customize → Dębowa Zagroda — strona główna → Kontakt i stopka** settings. If no map URL is configured, the directions link searches Google Maps for the configured address.

The homepage and contact page share `template-parts/contact-form.php`. All form results return to `/kontakt/#formularz`, preserving the selected visit. The default menu, footer, and booking links lead to the contact page. Add it manually if using a custom WordPress menu.

The setup script creates the page if it does not exist. To add it to an existing installation:

```bash
make wp ARGS='post create --post_type=page --post_title="Kontakt" --post_name=kontakt --post_status=publish --page_template=page-kontakt.php'
```

## WP-CLI

You can run WP-CLI commands through the utility service:

```bash
make wp ARGS="plugin list"
make wp ARGS="user list"
make wp ARGS="cache flush"
```

Without `make`, use the equivalent command:

```bash
docker compose run --rm wp-cli plugin list
```

## Resetting the Environment

The following command removes the local database and WordPress files stored in Docker volumes, then creates a clean installation:

```bash
make reset
```

The theme code in the repository will not be removed.

## Publishing to GitHub

After creating an empty repository on GitHub, run:

```bash
git remote add origin git@github.com:YOUR-USERNAME/debowa-zagroda.git
git push -u origin main
```

Do not publish the `.env` file or any production passwords. The Docker Compose configuration is intended for local development, not production hosting.
