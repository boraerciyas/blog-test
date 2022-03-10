## Blog Example

This is a Blog example project coded with Php [Laravel Framework](https://laravel.com/).

[VueJS](https://vuejs.org) is also used inside the project.  

## Installation

```shell
git clone https://github.com/boraerciyas/blog-test.git
cd blog-test

# Copy .env.example to .env
cp .env.example .env

# After changing the configs inside the .env file with yours
composer install && npm install

# To generate application key
php artisan key:generate

# Create the database
php artisan migrate --seed
```

## Run

```shell
php artisan serve
```
