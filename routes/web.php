<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;
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


Auth::routes();

Route::get('/', 'HomeController@home');

Route::get('/products', function() {
    return view('product');
});

Route::get('/exchange', function() {
    return view('exchange');
});

Route::get('/jobs', function() {
    return view('jobs');
});

Route::get('/change-server/{server}', function($server) {
    Session::put('esim_server', $server);
    return Session::get('esim_server');
});