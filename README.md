# Dębowa Zagroda — WordPress

Lokalne środowisko WordPress dla strony alpakarni, uruchamiane w Dockerze. Repozytorium zawiera własny klasyczny motyw `debowa-zagroda`; pliki WordPressa i dane bazy pozostają w wolumenach Dockera.

## Wymagania

- Docker Desktop albo Docker Engine z wtyczką Compose
- opcjonalnie `make`

## Start

```bash
cp .env.example .env
docker compose up -d
```

Pierwsze uruchomienie może potrwać kilkadziesiąt sekund, ponieważ Docker pobiera obrazy, a usługa `setup` instaluje WordPressa i aktywuje motyw.

- strona: http://localhost:8080
- panel: http://localhost:8080/wp-admin
- domyślny login: `admin`
- domyślne hasło: `admin`

Przed rozpoczęciem pracy zmień dane administratora w `.env`. Plik ten jest ignorowany przez Git.

Możesz też użyć skrótów:

```bash
make up
make logs
make status
make down
```

## Motyw

Kod motywu znajduje się w:

```text
wp-content/themes/debowa-zagroda/
```

Zmiany w PHP, CSS i JavaScript są widoczne w kontenerze od razu. Motyw zawiera podstawowe szablony, menu, obsługę logo, miniatur wpisów, style edytora i niewielki plik JavaScript.

## WP-CLI

Polecenia WP-CLI można wykonywać przez serwis narzędziowy:

```bash
make wp ARGS="plugin list"
make wp ARGS="user list"
make wp ARGS="cache flush"
```

Bez `make` odpowiednikiem jest:

```bash
docker compose run --rm wp-cli plugin list
```

## Reset środowiska

To polecenie usuwa lokalną bazę i pliki WordPressa zapisane w wolumenach, po czym tworzy czystą instalację:

```bash
make reset
```

Kod motywu w repozytorium nie zostanie usunięty.

## Publikacja na GitHubie

Po utworzeniu pustego repozytorium na GitHubie:

```bash
git remote add origin git@github.com:TWOJ-LOGIN/debowa-zagroda.git
git push -u origin main
```

Nie należy publikować pliku `.env` ani produkcyjnych haseł. Konfiguracja Docker Compose jest przeznaczona do lokalnego developmentu, nie do hostingu produkcyjnego.
