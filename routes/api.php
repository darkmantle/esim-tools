<?php

use Illuminate\Support\Facades\Route;
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

function parseName($str)
{
    return str_replace(" ", "", lcfirst(ucwords(strtolower($str))));
}

Route::get('/product/{resource}/{country}/{quality}', function ($resource, $country, $quality) {
    if ($country == 0) {
        $country = -1;
    }
    $crawler = new Crawler(file_get_contents('http://harmonia.e-sim.org/productMarket.html?resource='.strtoupper($resource).'&countryId='.$country.'&quality='.$quality.'&page=1'));
    //$crawler = new Crawler(file_get_contents(__DIR__ . '\test.html'));

    $table = $crawler->filter('.dataTable');

    $results = array();
    foreach ($table->children() as $row) {
        echo $row->nodeValue.'<br>';
        if (trim($row->nodeValue) == "No offers") {
            return response()->json(null);
        }
        $string = explode("You ", $row->nodeValue)[0];
        $arr = array_reverse(preg_split("^[\n\r\s★]+^", trim($string)));
        if ($arr[1] != "Price") {

            $seller = '';
            for ($i = 3; $i < count($arr); $i++) {
                $seller = $arr[$i]." ".$seller;
            }

            $product = new stdClass();
            $product->currency = $arr[0];
            $product->price = $arr[1];
            $product->amount = $arr[2];
            $product->seller = trim($seller);
            $results[] = $product;
        }
    }

    //return response()->json($results);


});
Route::get('/citizen/{id}', function ($id) {
    $crawler = new Crawler(file_get_contents('http://harmonia.e-sim.org/profile.html?id=' . $id));
    //$crawler = new Crawler(file_get_contents(__DIR__ . '\test.html'));

    $citizen = new stdClass();

    $name = $crawler->filter('h2');
    $name = explode("\xC2", $name->getNode(0)->nodeValue, 2);
    $citizen->name = trim($name[1], " \t\n\r\0\x0B\xC2\xA0");

    $table = $crawler->filter('.smallTableFont');
    foreach ($table->children() as $child) {
        $arr = explode(":", $child->nodeValue);
        $name = parseName($arr[0]);
        $citizen->{$name} = trim($arr[1]);
    }

    $mu = $crawler->filter('a[href*="military"]');
    if ($mu->count() > 0) {
        $citizen->militaryUnit = $mu->getNode(0)->nodeValue;
    }
    $party = $crawler->filter('a[href*="party.html"]');
    if ($party->count() > 0) {
        $citizen->party = $party->getNode(0)->nodeValue;
    }

    return response()->json($citizen);

});
Route::get('/exchange/{from}/{to}', function ($from, $to) {
    $crawler = new Crawler(file_get_contents('http://harmonia.e-sim.org/monetaryMarket.html?buyerCurrencyId=' . $to . '&sellerCurrencyId=' . $from));

    $items = array();
    $crawler = $crawler->filter('table');

    $i = 0;
    foreach ($crawler->children() as $c) {
        if ($i > 0) {
            $test = array_reverse(preg_split("^[\n\r\s★]+^", trim($c->nodeValue)));

            $obj = new stdClass();
            $obj->to = $test[0];
            $obj->rate = $test[1];
            $obj->from = $test[3];
            $obj->amount = $test[6];

            $name = '';
            for ($i = 7; $i < count($test); $i++) {
                $name = $test[$i] . ' ' . $name;
            }
            $obj->seller = $name;

            $items[] = $obj;
        }
        $i++;
    }

    return response()->json($items);
});