<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

### Basic Auth Routes ###

Auth::routes();

### Common Routes ###

Route::group(['namespace' => 'Common', 'middleware' => ['auth'] ], function ($router) {

    # HomeController
    $router->get('/', ['as' => 'home', 'uses' => 'HomeController@index']);
    $router->get('/home', ['as' => 'home', 'uses' => 'HomeController@index']);
});

### Admin Routes ###

Route::group(['namespace' => 'Admin', 'middleware' => ['auth'] ], function () {

    # MoviesController
    Route::group(['prefix' => 'movies'], function($router){
        $router->get('', [ 'as' => 'movies.index', 'middleware' => 'access:movies_read', 'uses' => 'MoviesController@index' ]);
        $router->get('datatable', [ 'as' => 'movies.datatable', 'middleware' => 'access:movies_read', 'uses' => 'MoviesController@datatable' ]);
        $router->get('create', [ 'as' => 'movies.create', 'middleware' => 'access:movies_create', 'uses' => 'MoviesController@create' ]);
        $router->post('store', [ 'as' => 'movies.store', 'middleware' => 'access:movies_create', 'uses' => 'MoviesController@store' ]);
        $router->get('edit/{id}', [ 'as' => 'movies.edit', 'middleware' => 'access:movies_edit', 'uses' => 'MoviesController@edit' ]);
        $router->put('update/{id}', [ 'as' => 'movies.update', 'middleware' => 'access:movies_edit', 'uses' => 'MoviesController@update' ]);
        $router->get('show-delete/{id}', [ 'as' => 'movies.show-delete', 'middleware' => 'access:movies_delete', 'uses' => 'MoviesController@showDelete' ]);
        $router->delete('delete/{id}', [ 'as' => 'movies.delete', 'middleware' => 'access:movies_delete', 'uses' => 'MoviesController@delete' ]);
        $router->get('get-movies', [ 'as' => 'movies.get-movies', 'middleware' => 'access:movies_read', 'uses' => 'MoviesController@getMovies' ]);
    });

    # MembersController
    Route::group(['prefix' => 'members'], function($router){
        $router->get('', [ 'as' => 'members.index', 'middleware' => 'access:members_read', 'uses' => 'MembersController@index' ]);
        $router->get('datatable', [ 'as' => 'members.datatable', 'middleware' => 'access:members_read', 'uses' => 'MembersController@datatable' ]);
        $router->get('create', [ 'as' => 'members.create', 'middleware' => 'access:members_create', 'uses' => 'MembersController@create' ]);
        $router->post('store', [ 'as' => 'members.store', 'middleware' => 'access:members_create', 'uses' => 'MembersController@store' ]);
        $router->get('edit/{id}', [ 'as' => 'members.edit', 'middleware' => 'access:members_edit', 'uses' => 'MembersController@edit' ]);
        $router->put('update/{id}', [ 'as' => 'members.update', 'middleware' => 'access:members_edit', 'uses' => 'MembersController@update' ]);
        $router->get('show-delete/{id}', [ 'as' => 'members.show-delete', 'middleware' => 'access:members_delete', 'uses' => 'MembersController@showDelete' ]);
        $router->delete('delete/{id}', [ 'as' => 'members.delete', 'middleware' => 'access:members_delete', 'uses' => 'MembersController@delete' ]);
        $router->get('get-members', [ 'as' => 'members.get-members', 'middleware' => 'access:members_read', 'uses' => 'MembersController@getMovies' ]);
    });

    # LendingsController
    Route::group(['prefix' => 'lendings'], function($router){
        $router->get('', [ 'as' => 'lendings.index', 'middleware' => 'access:lendings_read', 'uses' => 'LendingsController@index' ]);
        $router->get('datatable', [ 'as' => 'lendings.datatable', 'middleware' => 'access:lendings_read', 'uses' => 'LendingsController@datatable' ]);
        $router->get('create', [ 'as' => 'lendings.create', 'middleware' => 'access:lendings_create', 'uses' => 'LendingsController@create' ]);
        $router->post('store', [ 'as' => 'lendings.store', 'middleware' => 'access:lendings_create', 'uses' => 'LendingsController@store' ]);
        $router->get('show-return/{id}', [ 'as' => 'lendings.show-return', 'middleware' => 'access:lendings_return', 'uses' => 'LendingsController@showReturn' ]);
        $router->put('return/{id}', [ 'as' => 'lendings.return', 'middleware' => 'access:lendings_return', 'uses' => 'LendingsController@return' ]);
    });

    # ReturnsController
    Route::group(['prefix' => 'returns'], function($router){
        $router->get('', [ 'as' => 'returns.index', 'middleware' => 'access:returns_read', 'uses' => 'ReturnsController@index' ]);
        $router->get('datatable', [ 'as' => 'returns.datatable', 'middleware' => 'access:returns_read', 'uses' => 'ReturnsController@datatable' ]);
        $router->get('show-return/{id}', [ 'as' => 'returns.show-return', 'middleware' => 'access:returns_return', 'uses' => 'ReturnsController@showReturn' ]);
        $router->put('/{id}', [ 'as' => 'returns.return', 'middleware' => 'access:returns_return', 'uses' => 'ReturnsController@return' ]);
    });
});
