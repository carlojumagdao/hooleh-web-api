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

Route::get('/', function () {
    return view('dashboard');
});

Route::get('/dashboard', function () {
    return view('dashboard');
});

Route::get('/violation', function () {
    return view('violation');
});

Route::get('/violation', array(
	'uses' => 'web\violationController@index',
	'as' => 'violation.index'
));



//----------Enforcer----------//
Route::get('/enforcer', array(
	'uses' => 'web\enforcerController@index',
	'as' => 'enforcer.index'
));
Route::post('/enforcer/create', array(
	'uses' => 'web\enforcerController@create',
	'as' => 'enforcer.create'
));
Route::post('/enforcer/update', array(
	'uses' => 'web\enforcerController@update',
	'as' => 'enforcer.update'
));
Route::post('/enforcer/resetpassword', array(
	'uses' => 'web\enforcerController@resetpassword',
	'as' => 'enforcer.resetpassword'
));
Route::post('/enforcer/filter', array(
	'uses' => 'web\enforcerController@filter',
	'as' => 'enforcer.filter'
));
Route::post('/enforcer/suspend', array(
	'uses' => 'web\enforcerController@suspend',
	'as' => 'enforcer.suspend'
));
Route::post('/enforcer/restore', array(
	'uses' => 'web\enforcerController@restore',
	'as' => 'enforcer.restore'
));
Route::get('/enforcer/show/{id}', array(
	'uses' => 'web\enforcerController@show',
	'as' => 'enforcer.show'
));
Route::get('/enforcer/data', array(
	'uses' => 'web\enforcerController@getEnforcerData',
	'as' => 'enforcer.data'
));
//----------Enforcer----------//


//----------Violation--------//
Route::get('/violation', array(
	'uses' => 'web\violationController@index',
	'as' => 'violation.index'
));


Route::post('/violation/create', array(
	'uses' => 'web\violationController@create',
	'as' => 'violation.create'
));

Route::post('/violation/update', array(
	'uses' => 'web\violationController@update',
	'as' => 'violation.update'
));

Route::get('/violation/data', array(
	'uses' => 'web\violationController@getViolationData',
	'as' => 'violation.data'
));

Route::get('/violation/show/{id}', array(
	'uses' => 'web\violationController@show',
	'as' => 'violation.show'
));

Route::post('/violation/delete', array(
	'uses' => 'web\violationController@delete',
	'as' => 'violation.delete'
));

Route::post('/violation/restore', array(
	'uses' => 'web\violationController@restore',
	'as' => 'violation.restore'
));

Route::post('/violation/filter', array(
	'uses' => 'web\violationController@filter',
	'as' => 'violation.filter'
));

//----------Violation--------//


//----------API----------//

Route::get('/driver/{id}', function () {
    return view('enforcer');
});

//----------API----------//
Route::post('api/authenticate', 'Auth\AuthController@authenticate');

Route::group(['middleware' => ['jwt.auth', 'cors'], 'prefix' => 'api/v1', 'namespace' => 'api\v1'], function () {
	Route::resource('enforcers','EnforcerController');
	Route::resource('drivers', 'DriverController');	
	Route::resource('violations', 'ViolationController');
	Route::resource('driverviolations', 'DriverViolationController');
	
	Route::post('enforcertickets', 'EnforcerTicketController@store');
	Route::get('enforcertickets', 'api\v1\EnforcerTicketController@enforcerTicket');
	Route::get('enforcers/{enforcer_id}/tickets', 'EnforcerTicketController@index');

	Route::get('enforcercurrentlogin', 'EnforcerController@enforcerCurrentLogin');
	Route::get('listviolationtoday', 'DriverViolationController@enforcerListViolationToday');
	Route::get('violationdetails/{id}', 'DriverViolationController@ticketDetails');
});

// Route::resource('api/v1/driverviolations', 'api\v1\DriverViolationController');
//----------API----------//

