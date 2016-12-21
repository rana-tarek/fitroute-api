<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

//Authentication
Route::get('admin', 'Admin\UsersController@admin');
Route::get('signin', 'Auth\AuthController@getLogin');
Route::post('signin', 'Auth\AuthController@postLogin');
Route::get('signout', 'Auth\AuthController@getLogout');
Route::get('register', 'Auth\AuthController@getRegister');
Route::post('register', 'Auth\AuthController@postRegister');
Route::get('/', 'Admin\UsersController@index');

$router->group(['middleware' => 'auth'], function() {
    // Users
    Route::get('users', 'Admin\AppUsersController@index');
	Route::get('users/create', 'Admin\AppUsersController@create');
	Route::post('users/create', 'Admin\AppUsersController@store');
	Route::get('users/{id}/edit', 'Admin\AppUsersController@edit');
	Route::get('users/{id}/delete', 'Admin\AppUsersController@destroy');
	Route::patch('users/{id}', 'Admin\AppUsersController@update');
	Route::get('users/admin', 'Admin\AppUsersController@getAdmins');
	Route::get('admins/{id}/delete', 'Admin\AppUsersController@destroyAdmin');
	// Places
	Route::get('places', 'Admin\PlacesController@index');
	Route::get('places/create', 'Admin\PlacesController@create');
	Route::post('places/create', 'Admin\PlacesController@store');
	Route::get('places/{id}/edit', 'Admin\PlacesController@edit');
	Route::get('places/{id}/delete', 'Admin\PlacesController@destroy');
	Route::patch('places/{id}', 'Admin\PlacesController@update');
	Route::post('places/getSubcategories', 'Admin\PlacesController@getSubcategories');
	// Categories
	Route::get('categories', 'Admin\CategoriesController@index');
	Route::get('categories/create', 'Admin\CategoriesController@create');
	Route::post('categories/create', 'Admin\CategoriesController@store');
	Route::get('categories/{id}/edit', 'Admin\CategoriesController@edit');
	Route::get('categories/{id}/delete', 'Admin\CategoriesController@destroy');
	Route::patch('categories/{id}', 'Admin\CategoriesController@update');
	// Subcategories
	Route::get('subcategories', 'Admin\SubcategoriesController@index');
	Route::get('subcategories/create', 'Admin\SubcategoriesController@create');
	Route::post('subcategories/create', 'Admin\SubcategoriesController@store');
	Route::get('subcategories/{id}/edit', 'Admin\SubcategoriesController@edit');
	Route::get('subcategories/{id}/delete', 'Admin\SubcategoriesController@destroy');
	Route::patch('subcategories/{id}', 'Admin\SubcategoriesController@update');
});

Route::get ('generate-token', 'LoginController@generateGuestToken');
Route::post('login', 'LoginController@getUser');

$api = app('Dingo\Api\Routing\Router');
app('Dingo\Api\Transformer\Factory')->register('Category', 'CategoryTransformer');
$api->version('v1', ['middleware' => 'jwt.auth'],  function ($api) {
	$api->post('set-registeration-id', 'App\Api\V1\Controllers\LoginController@setRegistration');
	$api->post('refresh-token', 'App\Api\V1\Controllers\LoginController@refreshToken');
	$api->post('get-categories', 'App\Api\V1\Controllers\CategoryController@getCategories');
	$api->post('get-places', 'App\Api\V1\Controllers\PlaceController@getPlaces');
	$api->post('get-facilities', 'App\Api\V1\Controllers\CategoryController@getFacilities');
	$api->post('get-popular-places', 'App\Api\V1\Controllers\PlaceController@getPopularPlaces');
	$api->post('search', 'App\Api\V1\Controllers\PlaceController@search');
	$api->get('user/bookmarks', 'App\Api\V1\Controllers\PlaceController@getBookmarks');
	$api->get('place/bookmark/{user_id}/{place_id}', 'App\Api\V1\Controllers\PlaceController@deleteBookmark');
	$api->post('place/bookmark', 'App\Api\V1\Controllers\PlaceController@addBookmark');
});

