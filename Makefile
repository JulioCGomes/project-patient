help: ## 🐳 Commands make.
	@printf "\033[33mHow to use:\033[0m\n make [comando]\n\n\033[33mCommands:\033[0m\n"
	@grep -E '^[-a-zA-Z0-9_\.\/]+:.*?## .*$$' $(MAKEFILE_LIST) | sort | awk 'BEGIN {FS = ":.*?## "}; {printf " \033[32m%-30s\033[0m %s\n", $$1, $$2}'

up: ## 🟢 Start docker (sail e mysql).
	@echo "🟢 Make: Start docker\n"
	docker-compose up -d

down: ## 🔴 Down docker
	@echo "🔴 Make: Down docker.\n"
	docker-compose down

ps: ## 🟡 Check containers standing.
	@echo "🟡 Make: Check containers standing\n"
	docker-compose ps

bash: ## 🟡 Bash container.
	@echo "🟡 Make: Bash container.\n"
	docker-compose exec app bash

install: ## 🟢 Command composer install.
	@echo "🟢 Make: Composer install\n"
	docker-compose exec -it app composer install


###php artisan config:clear && php artisan view:clear && php artisan route:clear && php artisan cache:clear && php artisan config:cache && php artisan view:cache && php artisan route:cache && php artisan config:clear
