Please follow these steps to run the web page:
1. download XAMPP
2. run Apache on XAMPP
3. run `composer install` at project root directory
4. run `php artisan vendor:publish --provider="Maatwebsite\Excel\ExcelServiceProvider" --tag=config`
5. rename `.env.example` to `.env` at project root directory
6. run `php artisan key:generate` at project root directory
7. run `php artisan config:cache` at project root directory
8. go to `http://127.0.0.1:8000/students` to access the page
