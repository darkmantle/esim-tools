<?php

use Illuminate\Http\Request;
use Symfony\Component\DomCrawler\Crawler;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/exchange/{from}/{to}', function ($from, $to) {
    //$crawler = new Crawler(file_get_contents(__DIR__.'\test.html'));
    $crawler = new Crawler(file_get_contents('http://harmonia.e-sim.org/monetaryMarket.html?buyerCurrencyId=' . $to . '&sellerCurrencyId=' . $from));

    $items = array();
    $crawler = $crawler->filter('table');

    $i = 0;
    foreach ($crawler->children() as $c) {
        if ($i > 0) {
            $test = array_reverse(preg_split("^[\n\r\s★]+^", trim($c->nodeValue)));

            $obj = new stdClass();
            $obj->toName = $test[0];
            $obj->toRate = $test[1];
            $obj->fromName = $test[3];
            $obj->amount = $test[6];

            $name = '';
            for ($i = 7; $i < count($test); $i++) {
                $name = $test[$i].' '.$name;
            }
            $obj->seller = $name;

            $items[] = $obj;
        }
        $i++;
    }

    return response()->json($items);
});