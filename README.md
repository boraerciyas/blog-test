# Blog Example

This is a Blog example project coded with Php [Laravel Framework](https://laravel.com/).

[VueJS](https://vuejs.org) is also used inside the project.  

# Installation

Installation process is basic and optional. 
You can use dockerized run option which is pre-configured with all tools needed.
Otherwise, you can run application in your local environment, but you are going to need 
`composer`, `npm` `php >= 7.3`, `MySQL`, `Redis Server`.

## Docker 

Default ports are used on docker environment so if your local machine runs 
`MySQL` on default port **3306**, `Redis Server` on default port **6379** and/or Apache/Nginx etc. on default port **80**,
You may need to stop those services to bind docker ports to your main machine's ports.


```shell
# Copy .env.example to .env
cp .env.example .env

docker-compose up -d --build
docker exec -it app composer install
docker exec -it app npm install --legacy-peer-deps
docker exec -it app php artisan key:generate
docker exec -it app php artisan migrate --seed
```

Then you can go
[http://localhost](http://localhost) in your favourite browser to view the project.

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

Then you can go
[http://localhost:8000](http://localhost:8000) in your favourite browser to view the project.

