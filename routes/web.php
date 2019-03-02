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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

/*
*	Employee/User Route
*/
Route::resource('/employee', 'EmployeeController');
Route::get('/employee-data', 'EmployeeController@getEmployee')->name('employee.data');
Route::get('/employee-trash', 'EmployeeController@trash')->name('employee.trash');
