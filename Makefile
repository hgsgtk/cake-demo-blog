.PHONY: start
start: install up

.PHONY: up
up:
	docker-compose up -d

.PHONY: install
install:
	docker-compose run composer install --ignore-platform-reqs --no-interaction

.PHONY: ps
ps:
	docker-compose ps

.PHONY: migrate
migrate:
	docker-compose run php-cli bin/cake migrations migrate

.PHONY: test
test:
	docker-compose run php-cli ./vendor/bin/phpunit

.PHONY: down
down:
	docker-compose down
