## Rent&Roll Movie Renting App

Created as a prerequisite tests for Track&Roll recruitment

## Installation

Run git clone https://github.com/justcallmegrey/movie-lending.git movie-lending-egry  
Run cd movie-lending-egry  
Run git checkout master  
Copy env from .env.example and change DB_USERNAME & DB_PASSWORD  
Run composer update  
Run php artisan key:generate  
Run php artisan migrate:fresh --seed  
Run php artisan serve  
Run Login with Email=admin@mail.com, Password=password  

Note: Run below command if you need 10 dummy data for Movies & Members  
php artisan db:seed --class=MovieMemberSeeder  

## Screenshots

https://drive.google.com/file/d/10oqKgH7WFzkhSB9MELeWFymKDZKK3Klv/view?usp=sharing
https://drive.google.com/file/d/1u8ShBI5tSX7tJWRIkP8qWBfcsIDlWBn5/view?usp=sharing
https://drive.google.com/file/d/1kBz0wiudPFnOp7y9tjVk1YQiIMw4UJ7K/view?usp=sharing
https://drive.google.com/file/d/1JIyKNGXZeHe_TiT7z3loFFpk82bdtcWN/view?usp=sharing

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

