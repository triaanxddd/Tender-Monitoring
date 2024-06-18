

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
- Download tender-monitoring zip file
- Extract the project file
- Get into the tender-monitoring folder
- And open terminal
```
composer install
cp .env.example .env <-- edit db config
```

to migrate database and feed the data
```
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
