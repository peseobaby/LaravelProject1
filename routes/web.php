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

Route::get('home', 'HomeController@index')->name('home')->middleware('new','level');
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::get('user/add', 'HomeController@addUser')->name('user.add');
Route::post('home', 'HomeController@store')->name('user.store');
Route::get('user/{id}/edit', 'HomeController@editUser')->name('user.edit');
Route::delete('user/{id}', 'HomeController@destroy');
Route::get('user/{id}/show', 'HomeController@showUser')->name('user.show');
Route::get('user/{id}/staff', 'HomeController@showStaff')->name('user.staff');
Route::put('/user/{id}', 'HomeController@update')->name('user.update');
Route::get('resetform', 'HomeController@resetForm')->name('form.reset');
Route::post('/rspassword', 'HomeController@resetPassword')->name('resetpassword');
Route::get('department', 'DepartmentController@index')->name('department');
Route::get('department/add', 'DepartmentController@addDepartment')->name('department.add');
Route::post('department', 'DepartmentController@store')->name('department.store');
Route::get('department/{id}/edit', 'DepartmentController@editDepartment')->name('department.edit');
Route::get('department/{id}/show', 'DepartmentController@showDepartment')->name('department.show');
Route::delete('department/{id}', 'DepartmentController@destroy');
Route::put('/department/{id}', 'DepartmentController@update')->name('department.update');
Route::get('changepassword/{id}', 'HomeController@password')->name('changepassword');
Route::post('/change/{id}', 'HomeController@changePassword')->name('change');
Route::get('/export/{id}', 'HomeController@export')->name('export');
Route::get('/edit/{id}', 'HomeController@editInfor')->name('edit.infor');
Route::put('/update/{id}', 'HomeController@updateInfor')->name('update.infor');
