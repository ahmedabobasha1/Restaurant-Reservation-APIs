# Restaurant Reservation APIs


# Install 
````
git clone https://github.com/ahmedabobasha1/Restaurant-Reservation-APIs.git
cd Restaurant-Reservation-APIs
composer install
php artisan key:generate
cp .env.example .env
````
> **Note**
> make sure to update .env with your local variables 
````
php artisan migrate --seed
php artisan serv --port=8000
