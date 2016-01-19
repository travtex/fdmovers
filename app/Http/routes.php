<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::get('admin', function () {
	return redirect('/admin/move');
});

$router->group([
	'namespace' => 'Admin',
	'middleware' => ['web', 'auth'],
], function () {
	Route::resource('admin/move', 'MoveController');
	Route::post('admin/addmover', 'MoverController@addMover');
	Route::resource('admin/mover', 'MoverController');
	Route::resource('admin/crew', 'CrewController');
	Route::resource('admin/truck', 'TruckController');
	Route::get('admin/truckinfo/{id}', 'TruckController@getMoveInfo');
});
$router->group([
	'middleware' => 'web',
], function () {
	Route::auth();
	Route::get('/', 'HomeController@index');
    Route::get('/home', 'HomeController@index');
});


