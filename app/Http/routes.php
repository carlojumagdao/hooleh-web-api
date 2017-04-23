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
    if(Auth::check()){return Redirect::to('dashboard');}
    return view('auth.login');
});

Route::get('/admin' , function () {
   if(Auth::check()){return Redirect::to('dashboard');}
    return view('auth.login');
});

//------------Authentication Admin--------------//
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@logout');
//------------Authentication Admin--------------//

//------------Password Reset Routes-------------//
$this->get('password/reset/{token?}', 'Auth\PasswordController@showResetForm');
$this->post('password/email', 'Auth\PasswordController@sendResetLinkEmail');
$this->post('password/reset', 'Auth\PasswordController@reset');
//------------Password Reset Routes-------------//


Route::group(['middleware' => 'auth'], function(){

	//---------Dashboard--------//
	Route::get('/dashboard', function () {
		return view('dashboard');
	});

	//----------Driver----------//
	Route::get('/drivers', array(
		'uses' => 'web\driverController@index',
		'as' => 'driver.index'
	));
	Route::get('/drivers/show/{id}', array(
		'uses' => 'web\driverController@show',
		'as' => 'driver.show'
	));
	//----------Driver----------//




	//----------Enforcer----------//
	Route::get('/enforcers', array(
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
	Route::get('/violations', array(
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
});


//----------API----------//
Route::post('api/authenticate', 'Auth\AuthController@authenticate');

Route::group(['middleware' => ['jwt.auth'], 'prefix' => 'api/v1', 'namespace' => 'api\v1'], function () {

	Route::resource('drivers', 'DriverController');	
	Route::resource('violations', 'ViolationController');
	Route::resource('driverviolations', 'DriverViolationController');
	Route::resource('enforcers','EnforcerController');
	
	Route::post('enforcertickets', 'EnforcerTicketController@store');
	Route::get('enforcertickets', 'EnforcerTicketController@enforcerTicket');
	Route::get('enforcers/{enforcer_id}/tickets', 'EnforcerTicketController@index');

	Route::get('enforcercurrentlogin', 'EnforcerController@enforcerCurrentLogin');
	Route::get('listviolationtoday', 'DriverViolationController@enforcerListViolationToday');
	Route::get('violationdetails/{id}', 'DriverViolationController@ticketDetails');
	Route::get('listviolationtodaysearchselected/{license}', 'DriverViolationController@enforcerListViolationTodaySelectSearched');

});





// Route::resource('api/v1/driverviolations', 'api\v1\DriverViolationController');
//----------API----------//

