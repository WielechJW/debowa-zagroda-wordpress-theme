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

Changes to PHP, CSS, and JavaScript files are reflected in the container immediately. The theme includes basic templates, menus, logo support, featured images, editor styles, and a small JavaScript file.

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
