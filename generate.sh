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
