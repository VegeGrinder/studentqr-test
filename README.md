Please follow these steps to run the web page:
1. download XAMPP
2. run Apache on XAMPP
3. download composer (target the php.exe installed from XAMPP, e.g. C:\xampp\php\php.exe)
4. run `composer install` at project root directory
5. rename `.env.example` to `.env` at project root directory
6. run `php artisan key:generate` at project root directory
7. run `php artisan config:cache` at project root directory
8. go to `http://127.0.0.1:8000/students` to access the page
