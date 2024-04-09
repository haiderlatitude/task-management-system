## About Task Management System

Task Management System is a simple web application that allows Admin to create, update, delete and view tasks.
The application is built using Laravel Breeze and core front-end technologies like HTML, CSS.

## User Credentials

```
User 1
email: admin@gmail.com
password: admin

User 2
email: user@gmail.com
password: user
```

## How to setup

### Clone

```shell
git clone https://github.com/haiderlatitude/task-management-system.git
```

### Copy the ENV file

```shell
cp .env.example .env
```

### Generate the application key

```shell
php artisan key:generate
```

### Install dependencies

```shell
composer install
```
```shell
npm install
```

### Run migration and seed the database

```shell
php artisan migrate --seed
```
### Serve the application

```shell
php artisan serve
```
```shell
npm run dev
```

The above commands will serve the application on [your local machine](http://localhost:8000/login),
precisely on the address: 127.0.0.1:8000/login

### Support

If you encounter any error during the application setup,
please don't hesitate to contact me.
I'll be gladly available for you <3
