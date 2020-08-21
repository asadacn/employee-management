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

Route::resource('ranks', 'Employee\RankController');