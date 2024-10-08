# Makefile

init-project:
	docker-compose up --build -d
	docker-compose exec symfony php bin/console doctrine:schema:update --force

update-database-schema:
	docker-compose exec symfony php bin/console doctrine:schema:update --force

load-fixtures-data:
	docker-compose exec symfony php bin/console doctrine:fixtures:load

run-tests:
	docker-compose exec symfony php -dxdebug.mode=off vendor/bin/phpunit

clear-cache:
	docker-compose exec symfony php bin/console cache:clear
