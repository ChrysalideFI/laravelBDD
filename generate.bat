"C:\xampp\mysql\bin\mysql.exe" -u root -e "drop database mooc"
"C:\xampp\mysql\bin\mysql.exe" -u root -e "create database mooc"

php artisan migrate:refresh --seed
