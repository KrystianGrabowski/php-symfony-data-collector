# PHP Data-Collector

### Install
```
    docker-compose up -d
```

### Run Tests
```
    docker exec <CONTAINER_ID> vendor/bin/phpunit
```

### Connect manually to database
```
    docker exec -it <CONTAINER_ID> psql -U dbuser datacollector
```

## API
### Update
* Update from all sources
```
    GET http://localhost:8080/update
```
* Update from source with id
```
    GET http://localhost:8080/update/{id}
```

### Data
* Show data
```
    GET http://localhost:8080/data
```
### Sources

* List all sources
```
    GET http://localhost:8080/source
```
* Add new source
```
    POST http://localhost:8080/source

    {
        "url": "https://api.optad360.com/testapi",
        "is_active": true
    }
```
* Show source with id
```
    GET http://localhost:8080/source/{id}
```
* Delete source with id
```
    DELETE http://localhost:8080/source/{id}
```

### Settings
* List all settings
```
    GET http://localhost:8080/settings
```
* Add new settings
```
    POST http://localhost:8080/settings

    {
        "currency": "EUR",
        "periodLength": 1,
        "groupby": ""
    }
```
* Show settings with id
```
    GET http://localhost:8080/settings/{id}
```
* Delete settings with id
```
    DELETE http://localhost:8080/settings/{id}
```