

## About Tender Monitoring Application

Tender monitoring is a web to track progression of tenders, each of tender has work to be done in the form of a todo list

## Feature

- Job Tender.
- Category.
- Files Upload.
- Members Managemet.
- User Roles.
- Quantity of items.
- Profile.
- Leader page (to check the summary of job progression for admin).

Tender Monitoring is good application for online storage media

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
cp .env.example .env <-- edit db config
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
