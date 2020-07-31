# PHP Data-Collector

### Install
```
    docker-compose up
```

### Run Tests
```
    docker exec docker_php_1 bin/phpunit
```

### Connect manually tp database
```
    docker exec -it docker_psql_1 psql -U dbuser datacollector
```