<?php

use Symfony\Component\DomCrawler\Crawler;
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

Route::get('/', function() {
    return view('home');
});

Route::get('/products', function() {
    return view('product');
});

Route::get('/exchange', function() {
    return view('exchange');
});
