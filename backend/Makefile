c:u:
	@echo "${BLUE}Updating your application dependencies:${NC}"
	@docker-compose exec -T php composer update

c:i:
	@echo "${BLUE}Installing your application dependencies:${NC}"
	@docker-compose exec -T php composer install

start: init
	@echo "${BLUE}Starting all containers:${NC}"
	@docker-compose up -d

stop:
	@echo "${BLUE}Stopping all containers:${NC}"
	@docker-compose down -v

d:m:m:
	@docker-compose exec -T php bin/console d:m:m --no-interaction

d:f:l:
	@mkdir -p ie-api/public/tmp
	@docker-compose exec -T php bin/console doctrine:fixtures:load --env=test --purge-with-truncate --no-interaction

logs:
	@docker-compose logs -f
