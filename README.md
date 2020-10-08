## Requirements
<details>
<summary>Before installation make sure you have installed</summary>

- composer

- PHP >= 7.3

- node

</details>

## Installation

- `composer install`

- `cp .env.example .env`

- `php artisan key:generate`

- set up your database
- `php artisan migrate`

- `php artisan db:seed`

- `php artisan storage:link`

- `php artisan passport:keys`

- `npm install`

- `npm run dev`

<details>
<summary>Local Development Server</summary>

- If you are using MacOS or Linux, I recommend Laravel Valet

- If you are using Windows, I recommend Laragon

- Else you can run the following comand no matter OS you are using

    - `php artisan serve`

- You can also see [laravel documentation](https://laravel.com/docs/8.x) for more options

</details>
