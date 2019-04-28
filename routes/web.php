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
Route::post('home', 'HomeController@store')->name('user.store');
Route::get('user/{id}/edit', 'HomeController@editUser')->name('user.edit');
Route::delete('user/delete/{id}', 'HomeController@destroy')->name('user.destroy');
Route::get('user/{id}/show', 'HomeController@showUser')->name('user.show');
Route::get('user/{id}/staff', 'HomeController@showStaff')->name('user.staff');
Route::put('/user/update/{id}', 'HomeController@update')->name('user.update');
Route::get('resetform', 'HomeController@resetForm')->name('form.reset');
Route::post('/rspassword', 'HomeController@resetPassword')->name('resetpassword');
Route::get('department', 'DepartmentController@index')->name('department');
Route::post('department', 'DepartmentController@store')->name('department.store');
Route::get('department/{id}/edit', 'DepartmentController@editDepartment')->name('department.edit');
Route::get('department/{id}/show', 'DepartmentController@showDepartment')->name('department.show');
Route::delete('department/destroy/{id}', 'DepartmentController@destroy')->name('department.delete');
Route::put('/department/{id}', 'DepartmentController@update')->name('department.update');
Route::get('changepassword/{id}', 'HomeController@password')->name('changepassword');
Route::post('/change/{id}', 'HomeController@changePassword')->name('change');
Route::get('/export/{id}', 'HomeController@export')->name('export');
Route::get('/edit/{id}', 'HomeController@editInfor')->name('edit.infor');
Route::post('/update/{id}', 'HomeController@updateInfor')->name('update.infor');
Route::get('/live_search/action', 'HomeController@action')->name('live_search.action');
Route::get('/user/add/{id}', 'HomeController@modalAdd')->name('user.add');
Route::post('user/post', 'HomeController@post')->name('user.ajax');
Route::get('/department_search/action', 'DepartmentController@action')->name('department_search.action');
Route::get('/department/add/{id}', 'DepartmentController@modalAdd')->name('department.add');
Route::post('department/post', 'DepartmentController@post')->name('department.post');
Route::get('/department_user_search/action/{id}', 'DepartmentController@searchUser')->name('department_user_search.action');

