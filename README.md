# Test groupe-leaderinsurance.fr

#### Environnement docker: (centos 7 / php 8 / apache / mariadb ) (voir docker-compose.yml)

```shell 
docker-compose up -d
```

#### Installation:

```shell 
docker exec -it test_app bash 
composer install
```

##### TEST unitaire
```shell 
php ./vendor/bin/phpunit tests/
```

```shell 
Le site est accessible en local sous l'url suivante:
http://test.dev:8000            // n'oublier pas d'ajouter test.dev dans votre hosts                                                            
```

