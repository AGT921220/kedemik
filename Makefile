 start:
	@docker compose up -d;\
 stop:
	@docker compose down;\

install:
	echo "Docker Exec";\
	docker exec -it php-kedemik composer install
enter:
	docker exec -it php-kedemik /bin/bash