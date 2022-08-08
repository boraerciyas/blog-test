# Blog Example

This is a Blog example project coded with Php [Laravel Framework](https://laravel.com/).

[VueJS](https://vuejs.org) is also used inside the project.  

# Installation

Installation process is basic and optional. 
You can use dockerized run option which is pre-configured with all tools needed.
Otherwise, you can run application in your local environment, but you are going to need 
`composer`, `npm` `php >= 7.3`, `MySQL`, `Redis Server`.

## Docker 

```shell
# Copy .env.example to .env
cp .env.example .env

docker-compose up -d --build
docker exec -it app composer install
docker exec -it app npm install --legacy-peer-deps
docker exec -it app php artisan key:generate
docker exec -it app php artisan migrate --seed
```

## Local

```shell
# Copy .env.example to .env
cp .env.example .env

# After changing the configs inside the .env file with yours
composer install && npm install

# To generate application key
php artisan key:generate

# Create the database
php artisan migrate --seed

# To run
php artisan serve
```


