

## About Tender Monitoring Application

Tender monitoring is a web to track progression of tenders, each of tenders has work to be done in the form of a todo list. Users can input data in the form of text, numbers, and even files to complete the list provided.

## Feature

- Job Tender.
- Category.
- Files Upload.
- Members Managemet.
- User Roles.
- Quantity of items.
- Profile.
- Leader page (to check the summary of job progression for admin).

All of these features are made based on request by company directors himself

## Installation
- Clone with github
  ```
  git clone https://github.com/triaanxddd/Tender-Monitoring
  ```
- Open Directory
```
  cd Tender-Monitoring
  ```
- And open terminal
```
composer install
cp .env.example .env <-- configure the config
```

to migrate database and seed the data
```
php artisan key:generate
php artisan migrate
php artisan db:seed
```

to run application
```
php artisan serve
```

## Admin login
- **Email:** admin@gmail.com
- **Password:** admin@123
