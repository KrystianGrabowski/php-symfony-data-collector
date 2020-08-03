docker exec docker_php_1 bin/console doctrine:database:drop --force
docker exec docker_php_1 bin/console doctrine:database:create
docker exec docker_php_1 bin/console doctrine:migrations:migrate
docker exec docker_php_1 vendor/bin/phpunit