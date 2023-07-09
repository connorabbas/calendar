# Calendar
A basic calendar application built using [Laravel](https://laravel.com/), [Vue.js](https://vuejs.org/), & [FullCalendar](https://fullcalendar.io/docs)

## Installation
```
composer install
```
```
npm install
```
```
npm run dev
```

## Database Configuration
Setup a `calendar` and `calendar_testing` database.

Default DB connection:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=calendar
DB_USERNAME=root
DB_PASSWORD=
```

Separate DB/connection for running automated tests.
```env
DB_TEST_CONNECTION=testing
DB_TEST_HOST=127.0.0.1
DB_TEST_PORT=3306
DB_TEST_DATABASE=calendar_testing
DB_TEST_USERNAME=root
DB_TEST_PASSWORD=
```

Run migrations 
```
php artisan migrate
php artisan migrate --database=testing
```

Seed DB with test data (optional)
```
php artisan db:seed --EventSeeder
```