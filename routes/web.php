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
|--------------------------------------------------------------------------
| Role Middleware
|--------------------------------------------------------------------------
|
| Here we decleard all employee route, like employee add, delete, create , trash etc.
|
*/


	/*
	|--------------------------------------------------------------------------
	| Employee/User Route
	|--------------------------------------------------------------------------
	|
	| Here we decleard all employee route, like employee add, delete, create , trash etc.
	|
	*/
	Route::resource('/employee', 'EmployeeController');
	Route::get('/employee-trash', 'EmployeeController@trash')->name('employee.trash');
	Route::resource('/award', 'AwardController');
	Route::resource('/award-type', 'AwardTypeController');
	Route::resource('/leave-request', 'LeaveRequestController');
	Route::get('/leave-request-pending', 'LeaveRequestController@pending')->name('leave-request-pending');
	Route::get('/leave-request/{id}/{status}', 'LeaveRequestController@status')->name('leave-request.status');
	Route::post('/leave-request/{id}/{status}', 'LeaveRequestController@status')->name('leave-request.status');
	//Loan Request Route
	Route::resource('/loan-request', 'LoanRequestController');
	Route::get('/loan-request/{id}/{status}', 'LoanRequestController@status')->name('loan-request.status');
	Route::post('/loan-request/{id}/{status}', 'LoanRequestController@status')->name('loan-request.status');
	Route::get('/loan-request-pending', 'LoanRequestController@pending')->name('loan-request-pending');
	//Advance request route
	Route::resource('/advance-request', 'AdvanceRequestController');
	Route::get('/advance-request/{id}/{status}', 'AdvanceRequestController@status')->name('advance-request.status');
	Route::post('/advance-request/{id}/{status}', 'AdvanceRequestController@status')->name('advance-request.status');
	Route::get('/advance-request-pending', 'AdvanceRequestController@pending')->name('advance-request-pending');
	/*
	|--------------------------------------------------------------------------
	| Role & Permissoins
	|--------------------------------------------------------------------------
	|
	| Here we decleard all route realated about role & permission.
	|
	*/
	Route::resource('/role', 'RoleController');
	Route::resource('/permission', 'PermissionController');
	/*
	|--------------------------------------------------------------------------
	| Department Route
	|--------------------------------------------------------------------------
	|
	| Here we decleard all route realated about role & permission.
	|
	*/
	Route::resource('/department', 'DepartmentController');
	Route::delete('/designationDestroy/{id}', 'DepartmentController@designationDestroy');
	Route::resource('/employee-type', 'EmployeeTypeController');	
	/*
	|--------------------------------------------------------------------------
	| COMPANY POLICY ROUTE
	|--------------------------------------------------------------------------
	|
	| Here we decleard all route realated about role & permission.
	|
	*/
	Route::resource('/leave-policy', 'LeavePolociController');
	Route::delete('/leaveDestroy/{id}', 'LeavePolociController@leaveDestroy');
	Route::resource('/working-hour-policy', 'WorkingHourPolicyController');
	Route::resource('/salary-deduction-policy', 'SalaryDeductionPolicyController');
	Route::resource('/overtime-policy', 'OverTimePolicyController');

	/*
	|--------------------------------------------------------------------------
	| COMPANY SETTING ROUTE
	|--------------------------------------------------------------------------
	|
	| Here we decleard all route realated about role & permission.
	|
	*/
	Route::resource('/route', 'RouteController');

	/*
	|--------------------------------------------------------------------------
	| Asset ROUTE
	|--------------------------------------------------------------------------
	|
	| Here we decleard all route realated about role & permission.
	|
	*/

	Route::resource('/asset-type', 'AssetTypeController');
	Route::resource('/equipment', 'EquipmentController');
	Route::resource('/asset-assign', 'AssetAssignmentController');
	Route::resource('/performance', 'PerformanceController');



