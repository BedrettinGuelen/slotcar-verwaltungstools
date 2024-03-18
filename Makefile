install: ## Install
	@composer install --optimize-autoloader
	@composer dump-autoload
	@symfony console auth:init
	@$(MAKE) cache

create-database: ## Create Database
	@symfony console doctrine:database:create

validate-database: ## Create Database
	@symfony console doctrine:schema:validate

drop-database: ## Delete Database
	@symfony console doctrine:database:drop --force

database: ## Delete Database
	@$(MAKE) drop-database
	@$(MAKE) create-database

migrations: ## Create migrations
	@symfony console doctrine:migrations:diff

migrate: ## Run migrations
	@symfony console doctrine:migrations:migrate -n

fixtures: ## Load sample Data
	@symfony console doctrine:fixtures:load -n

update: ## Update
	@composer update --optimize-autoloader
	@composer dump-autoload
	@$(MAKE) cache

cache: ## Clears the cache.
	@symfony console cache:clear

test: ## Run testsuite
	@symfony console cache:clear -e test
	@export XDEBUG_MODE=coverage && php vendor/bin/behat --format=junit --out=test-results --format=pretty --out=std
	@export XDEBUG_MODE=coverage && php vendor/bin/phpunit --log-junit test-results/phpunit.xml --coverage-clover coverage/xml/phpunit.xml --coverage-html coverage/html/phpunit/

start: ## Start Containers
	@symfony server:stop
	@docker-compose up -d
	@symfony server:start -d --no-tls

stop: ## Stop Containers
	@docker-compose stop
	@symfony server:stop

recreate: ## recreate containers
	@$(MAKE) stop
	@docker-compose rm -f
	@docker-compose build
	@$(MAKE) start

analyse: ## Run static code analysis
	@php vendor/bin/phpstan analyse src