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

Route::get ('generate-token', 'LoginController@generateGuestToken');
Route::post('login', 'LoginController@getUser');


// $router->group(['prefix' => 'api', 'middleware' => 'jwt.auth'], function() {

// 	//Login
// 	Route::post('set-registeration-id', 'Api\LoginController@setRegistration');
// 	Route::post('refresh-token', 'Api\LoginController@refreshToken');
	
// });

$api = app('Dingo\Api\Routing\Router');
app('Dingo\Api\Transformer\Factory')->register('Category', 'CategoryTransformer');
$api->version('v1', ['middleware' => 'jwt.auth'],  function ($api) {
	$api->post('set-registeration-id', 'App\Api\V1\Controllers\LoginController@setRegistration');
	$api->post('refresh-token', 'App\Api\V1\Controllers\LoginController@refreshToken');
	$api->post('get-categories', 'App\Api\V1\Controllers\CategoryController@getCategories');
	$api->post('get-places', 'App\Api\V1\Controllers\PlaceController@getPlaces');
	$api->post('get-facilities', 'App\Api\V1\Controllers\CategoryController@getFacilities');
	$api->post('get-popular-places', 'App\Api\V1\Controllers\CategoryController@getPopularPlaces');
});

