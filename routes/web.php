<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', function () {
	if(Auth::user())
	{
		return redirect()->route('Company.index');
	}
	else
	{
		return view('welcome');		
	}
});

Auth::routes();

Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');

Route::group(['prefix' => 'company', 'as' => 'Company.', 'middleware' => 'auth'], function () {
	Route::get('index', 'CompanyController@index')->name('index');
	Route::get('create', 'CompanyController@create')->name('create');
	Route::post('store', 'CompanyController@store')->name('store');
	Route::get('show/{id}', 'CompanyController@show')->name('show');
	Route::get('edit/{id}', 'CompanyController@edit')->name('edit');
	Route::post('update/{id}', 'CompanyController@update')->name('update');
	Route::get('destroy/{id}', 'CompanyController@destroy')->name('destroy');
});

Route::group(['prefix' => 'employee', 'as' => 'Employee.', 'middleware' => 'auth'], function () {
	Route::post('store', 'EmployeeController@store')->name('store');
	Route::post('update/{id}', 'EmployeeController@update')->name('update');
	Route::get('destroy/{id}', 'EmployeeController@destroy')->name('destroy');
});