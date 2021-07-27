## Rent&Roll Movie Renting App

Created as a prerequisite tests for Track&Roll recruitment

## Installation

Run git clone https://github.com/justcallmegrey/movie-lending.git movie-lending-egry__
Run cd movie-lending-egry__
Run git checkout master__
Copy env from .env.example and change DB_USERNAME & DB_PASSWORD__
Run composer update__
Run php artisan key:generate__
Run php artisan migrate:fresh --seed__
Run php artisan serve__
Run Login with Email=admin@mail.com, Password=password__

Note: Run below command if you need 10 dummy data for Movies & Members__
php artisan db:seed --class=MovieMemberSeeder__
## Laravel

<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

