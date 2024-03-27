install: ## Install
	@docker-compose exec php composer install --optimize-autoloader
	@docker-compose exec php composer dump-autoload
	@$(MAKE) cache

create-database: ## Create Database
	@docker-compose exec php bin/console doctrine:database:create

validate-database: ## Create Database
	@docker-compose exec php bin/console doctrine:schema:validate

drop-database: ## Delete Database
	@docker-compose exec php bin/console doctrine:database:drop --force

database: ## Delete Database
	@$(MAKE) drop-database
	@$(MAKE) create-database

migrations: ## Create migrations
	@docker-compose exec php bin/console doctrine:migrations:diff

migrate: ## Run migrations
	@docker-compose exec php bin/console doctrine:migrations:migrate -n

migrate-rollback: ## Rollback migrations
	@docker-compose exec php bin/console doctrine:migrations:migrate prev -n

fixtures: ## Load sample Data
	@docker-compose exec  php bin/console doctrine:fixtures:load -n

update: ## Update
	@docker-compose exec php composer update --optimize-autoloader
	@docker-compose exec php composer dump-autoload
	@$(MAKE) cache

cache: ## Clears the cache.
	@docker-compose exec php bin/console cache:clear

enter: ## Enter php container
	@docker-compose exec php bash

test: ## Run testsuite
	@docker-compose exec php vendor/bin/behat --format=junit --out=results --format=pretty --out=std
	@docker-compose exec php vendor/bin/phpunit --log-junit results/phpunit.xml --coverage-clover coverage/xml/phpunit.xml --coverage-html coverage/html/phpunit/

start: ## Start Containers
	@docker-compose up -d

stop: ## Stop Containers
	@docker-compose stop

recreate: ## recreate containers
	@$(MAKE) stop
	@docker-compose rm -f
	@docker-compose build
	@$(MAKE) start

consume: ## start consumer for new messenger
	@docker-compose exec php bin/console messenger:consume

analyse: ## Run static code analysis
	@docker-compose exec php vendor/bin/phpstan analyse src