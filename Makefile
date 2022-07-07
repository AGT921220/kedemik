 start:
	@docker compose up -d;\
 stop:
	@docker compose down;\

install:
	echo "Docker Exec";\
	sudo docker exec -it php-kedemik composer install
enter:
	sudo docker exec -it php-kedemik /bin/sh