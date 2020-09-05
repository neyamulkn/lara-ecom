<?php

use Illuminate\Support\Facades\Route;

Route::get('/login', 'UserLoginController@LoginForm')->name('LoginForm');
Route::post('/login', 'UserLoginController@login')->name('userLogin');
Route::get('/register', 'UserRegisterController@RegisterForm')->name('userRegisterForm');
Route::post('/register', 'UserRegisterController@register')->name('userRegister');
Route::get('/logout', 'UserLoginController@logout')->name('userLogout');

route::group(['middleware' => ['auth:user', 'user']], function(){
	Route::get('dashboard', 'UserController@subcategory')->name('user.dashboard');
});


