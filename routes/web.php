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
})->name('home');

Route::get('/dashboard', [
    "uses"=>'PostController@getDashboard',
    'as'=>'dashboard',
    'middleware'=>'auth'
]);

Route::get('/account', [
    "uses"=>'UserController@getAccount',
    'as'=>'account',
    'middleware'=>'auth'
]);

Route::post('/signup', [
    "uses"=>'UserController@postSignUp',
    'as'=>'signup'
]);

Route::post('/signin', [
    "uses"=>'UserController@postSignIn',
    'as'=>'signin'
]);

Route::post('/createpost', [
    "uses"=>'PostController@postCreatePost',
    'as'=>'post.create',
    'middleware'=>'auth'
]);

Route::post('/updateaccount', [
    "uses"=>'UserController@updateAccount',
    'as'=>'account.save',
    'middleware'=>'auth'
]);

Route::post('/edit', [
    "uses"=>'PostController@editPost',
    'as'=>'edit',
    'middleware'=>'auth'
]);

Route::get('/deletepost/{id}', [
    "uses"=>'PostController@deletePost',
    'as'=>'post.delete',
    'middleware'=>'auth'
]);

Route::get('/userimage/{filename}', [
    "uses"=>'UserController@getUserImage',
    'as'=>'account.image',
    'middleware'=>'auth'
]);

Route::get('/logout', [
    "uses"=>'UserController@logout',
    'as'=>'logout'
]);

