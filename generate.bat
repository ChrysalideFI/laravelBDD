"C:\xampp\mysql\bin\mysql.exe" -u root -e "drop database bloglaravel"
"C:\xampp\mysql\bin\mysql.exe" -u root -e "create database bloglaravel"

php artisan migrate:refresh --seed
