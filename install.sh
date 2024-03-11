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
