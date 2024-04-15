mysql -u root -e "drop database mooc"
mysql -u root -e "create database mooc"

php artisan migrate:refresh --seed
