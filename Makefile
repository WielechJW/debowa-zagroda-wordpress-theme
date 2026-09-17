.PHONY: up down restart logs status wp shell reset

up:
	docker compose up -d

down:
	docker compose down

restart:
	docker compose restart wordpress

logs:
	docker compose logs -f wordpress db setup

status:
	docker compose ps --all

wp:
	docker compose run --rm wp-cli $(ARGS)

shell:
	docker compose exec wordpress bash

reset:
	docker compose down --volumes
	docker compose up -d
