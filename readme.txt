1. buat database terlebih dahulu berdasarkan isi .env
2. gunakan command berikut ini : 
php artisan migrate:fresh
php artisan config:clear
php artisan key:generate
php artisan cache:clear
php artisan passport:install --force
php artisan db:seed
php artisan serve --port=8000