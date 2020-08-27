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
    return view('home');
});
Route::get('/dashboard', function () {
    return view('employees.dashboard.index');
});
Route::get('/employees', function () {
    return view('employees.employee.index');
});
Route::get('/departments', function () {
    return view('employees.department.index');
});
Route::get('/ranks', function () {
    return view('employees.rank.index');
});

//RANKS
Route::resource('ranks', 'Employee\RankController');
Route::get('rank/search', 'Employee\RankController@search')->name('ranks-search');

//DEPARTMENT
Route::resource('departments', 'Employee\DepartmentController');
Route::get('department/search', 'Employee\DepartmentController@search')->name('departments-search');

//EMPLOYEE
Route::resource('employees', 'Employee\EmployeeController');
Route::get('employee/search', 'Employee\EmployeeController@search')->name('employees-search');

//SALARY PAYABLE
// Route::resource('salary-payable', 'Employee\PayableSalaryController');
Route::get('salary-payable/create/{id}', 'Employee\PayableSalaryController@create')->name('salary-payable.create');
Route::post('salary-payable/generate', 'Employee\PayableSalaryController@generate')->name('salary-payable.generate');
//SALARY PAYMENT
Route::get('salary-pay/create/{id}', 'Employee\SalaryPaymentController@create')->name('salary-pay.create');
Route::post('salary-pay', 'Employee\SalaryPaymentController@pay')->name('salary-pay');