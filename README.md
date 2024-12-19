

## Tender Monitoring Application in Laravel
![image](https://github.com/user-attachments/assets/c7f889b4-17c9-4993-b75c-f5965f074a02)

Tender monitoring is a website application to track progression of tender jobs, each of tender jobs has work to be done in the form of a todo list, users can input data in the form of text, numbers, and even files to complete the list provided until list be completed. 
All of these features is provided and made based on request of director and employees of Energia Transmedia company needed to store kind of documents in online website.

Requirement version programming language/framework/dbms:
- **PHP        : 8.0.2**
- **Laravel    : 9.52.16**
- **Bootstrap  : 5^**
- **MySQL      : 15.1**

## Feature
- Tracking each of jobs.
- Job List.
- Category of jobs.
- Files Upload.
- Members Managemet.
- User Roles.
- Quantity of items.
- Profile.
- Leader page (to check the summary of job progression for admin).
- Delete and Restore job

All of these features are made based on request by company directors himself

## References
- Argon Dashboard for Template (Argon Dashboard 2)
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

## Showcase Screenshots
- Main Dashboard Page
  ![image](https://github.com/user-attachments/assets/91f9731b-551c-4039-9287-433cbd86ebe4)
- Jobs Page
  ![image](https://github.com/user-attachments/assets/0e47507b-a3df-4da3-aa35-d634cc42ebb8)
  ![image](https://github.com/user-attachments/assets/4d238b2f-40ae-43b9-ad27-a978a2ee06e5)
  ![image](https://github.com/user-attachments/assets/c9b97cd8-fe54-472d-8cb7-e73c8f5ce46c)
  ![image](https://github.com/user-attachments/assets/355a0a3b-ba03-48cf-956d-fabe5923233e)

- Summary for admin Page
  ![image](https://github.com/user-attachments/assets/88fb4cda-4b1b-44c8-ba2f-1fd16ea05c94)

- Category Jobs Page
  ![image](https://github.com/user-attachments/assets/5ed80054-aadd-47b3-b4f7-4292880ac04f)

- Member Page
  ![image](https://github.com/user-attachments/assets/77c61d43-07da-4d79-8e35-caf8bc65f105)
  ![image](https://github.com/user-attachments/assets/41f65a3e-efc5-4b9e-8eb2-5d01eb5c49c0)

- Profile Page
  ![image](https://github.com/user-attachments/assets/8745a6fb-cc9f-4917-8b9d-0e6cc927beea)

