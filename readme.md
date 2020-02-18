## Laravel Website

This is the source of the official [Laravel website](https://laravel.com).

## Local Development

If you want to work on this project on your local machine, you may follow the instructions below. These instructions assume you are serving the site using Laravel Valet out of your `~/Sites` directory:

1. Fork this repository 
2. Open your terminal and `cd` to your `~/Sites` folder
3. Clone your fork into the `~/Sites/laravel` folder, by running the following command *with your username placed into the {username} slot*:
    ```bash
    https://github.com/jhuei0831/web.git
    ```
4. CD into the new directory you just created:
    ```bash
    cd web
    ```
5. Install the composer plugin:
    ```bash
    composer update
    ```
6. Create `.env` file:
    ```bash
    cp .env.example .env
    ```
7. ```bash
    php artisan key:generate
    ```
8. Set up database
    ```bash
    php artisan migrate
    ```
9. Insert account in database, email:`admin@gmail.com`,password:`admin`
    ```bash
    php artisan db:seed --class=DatabaseSeeder
    ```