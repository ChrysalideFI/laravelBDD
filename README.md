## Use Laravel to generate an application and data from an existing database

Use the following amazing packages : 

- Migrations generator : https://github.com/kitloong/laravel-migrations-generator
- Factories generator : https://github.com/TheDoctor0/laravel-factory-generator
- Models generator : https://github.com/reliese/laravel 

## Install 

```
#install laravel
composer create-project laravel/laravel bloglaravel

#go into project
cd bloglaravel

#install Model generator
composer require reliese/laravel --dev
php artisan vendor:publish --tag=reliese-models
php artisan config:clear

#install Factory generator
composer require thedoctor0/laravel-factory-generator --dev

#install Migrations generator
composer require --dev kitloong/laravel-migrations-generator
```

## Generate (For MySQL)

```
mysql --execute='drop database bloglaravel';
mysql --execute='create database bloglaravel';
mysql bloglaravel < database/blog.sql;
rm -rf database/migrations/*
rm -rf app/Models/*
rm -rf database/factories/*
php artisan migrate:refresh
php artisan migrate:generate --ignore="personal_access_tokens" --squash
php artisan code:models
php artisan generate:factory
php artisan migrate:refresh --seed
```

Fix your factories, configure config/models.php, then run `php artisan migrate:refresh --seed` again
