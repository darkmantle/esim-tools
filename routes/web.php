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

Route::group(['middleware' => 'api', 'prefix' => 'api'], function() {
    Route::get('/exchange/{from}/{to}', function($from, $to) {
        //$crawler = new Crawler(file_get_contents(__DIR__.'\test.html'));
        $crawler = new Crawler(file_get_contents('http://harmonia.e-sim.org/monetaryMarket.html?buyerCurrencyId='.$to.'&sellerCurrencyId='.$from));

        $items = array();
        $crawler = $crawler->filter('table');

        $i = 0;
        foreach ($crawler->children() as $c)  {
            if ($i > 0) {
                $test = explode('                ', $c->nodeValue);
                array_shift($test); array_pop($test); array_pop($test);
                $items[] = $test;
            }
            $i++;
        }

        return response()->json($items);
    });
});