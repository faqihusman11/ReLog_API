# Simple Register & Login API with Laravel REST API
A Register & Login API, developed with PHP Laravel framework.

Simple Register & Login APP:
-[ReLog_APP](https://github.com/faqihusman11/ReLog_APP)

Installed package:
- [Laravel Passport](https://laravel.com/docs/6.x/passport)

## Installation steps

Follow the below steps to install and set up the application.

**Step 1: Clone the Application**<br>
You can download the ZIP file or git clone from my repo into your project directory.

**Step 2: Configure the Application**<br>
After you clone the repo into your project folder the project need to be set up by following commands:

- In terminal go to your project directory then run 
    
        composer install 
    
- Then copy the .env.example file to .env file in the project root folder

- Edit the .env file and fill all required data for the below variables
    
        APP_URL=http://localhost // Your application domain URL go here

        DB_HOST=127.0.0.1 // Your database host IP. Here we are assumed it to be localhost.
        DB_PORT=3306 // Port if you are using except the default.
        DB_DATABASE=(name of your database)
        DB_USERNAME=(your database username)
        DB_PASSWORD=(your database password)
    
- To set the Application key run the below command in your terminal.
    
        php artisan key:generate
    
- Create all the necessary tables need for the application by running the below command.
    
        php artisan migrate

- Then run the below command in your terminal.

        php artisan passport:install

- Finally you can test it by running the below command.

        php artisan serve

Thats all! The application is configured now and enjoy.