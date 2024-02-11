# Vendas 360

This is a web system developed to register sellers and sales, as well as calculate the commission on sales made. The system also sends daily emails to the administrator and sellers with the sales made on the day.

## How to run the project

1. Clone this repository with the command `git clone git@github.com:jessecarvalho/tray.git`.
2. Access the project folder with the command `cd tray`.
3. Create a `.env` file at the root of the project and copy the content of the `.env.example` file into it.
4. Configure the `.env` file with your database information.
5. Configure the `.env` file with the information of your preferred smtp email provider, it is set up to send emails with Mailtrap.
6. Run the docker with the command `docker-compose up --build -d`.
7. If you are interested in populating the database, run the seeds with the command `docker-compose exec app php artisan db:seed`.
8. Access the application at `http://localhost:8000`.

## How to run the tests
1. Configure the `.env.testing` file with your test database information.
2. With docker running, execute the command `docker-compose exec app php artisan migrate --env=testing` to create the test database.
3. Execute the command `docker-compose run app php artisan test` to run the tests.

## Cronjob
The system is set up to send emails daily at 23:59 to the administrator and to the sellers. The trigger is being set up directly in the creation of the docker image.

## Technologies used

<img height="25" src="https://laravel.com/img/logotype.min.svg"/>

For the backend, I chose to use Laravel, because it is a framework that I have a lot of contact with and that I have a lot of confidence in. It is also a good choice for a small project like this, as it is a framework that has a lot of resources and is easy to use.

<img height="25" src="https://blade-ui-kit.com/images/logo.svg"/>

For the frontend, I chose to use Blade UI Kit, because it is a good choice for small projects. 

<img height="50" src="https://www.mysql.com/common/logos/logo-mysql-170x115.png"/>

I chose to use MySQL as the database, because it is a database that I have a lot of contact with and that I have a lot of confidence in.

<img height="50" src="https://miro.medium.com/v2/resize:fit:512/1*JEHLmWo6_SrpHPiP4AimIw.png"/>

I chose to use Docker to run the application because it is a tool that makes it easy to run the application in any environment.
