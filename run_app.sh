composer install
cd docker
docker-compose up -d
docker exec -it docker_php_1 bin/console doctrine:migrations:migrate