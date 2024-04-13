"C:\xampp\mysql\bin\mysql.exe" -u root -e "drop database bloglaravel"
"C:\xampp\mysql\bin\mysql.exe" -u root -e "create database bloglaravel"
"C:\xampp\mysql\bin\mysql.exe" -u root bloglaravel -e "source database/blog.sql"
@REM "C:\xampp\mysql\bin\mysql.exe" -u root -e "source database/blog.sql"

@REM C:\xampp\mysql -u root -e "drop database bloglaravel"
@REM C:\xampp\mysql -u root -e "create database bloglaravel"
@REM C:\xampp\mysql -u root bloglaravel < database/blog.sql

@REM rmdir /S /Q database\migrations\
@REM rmdir /S /Q app\Models\
@REM rmdir /S /Q database\factories\
php artisan migrate:refresh
php artisan migrate:generate --ignore="personal_access_tokens" --squash
php artisan code:models
php artisan generate:factory
php artisan migrate:refresh --seed
