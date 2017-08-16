<?php

namespace App\Http\Controllers\API;

use App\Citizen;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\DomCrawler\Crawler;


class CitizenController extends Controller
{
    function parseName($str)
    {
        return str_replace(" ", "", lcfirst(ucwords(strtolower($str))));
    }

    /**
     * @api {get} /user/:id Request User information
     * @apiName GetUser
     * @apiGroup User
     *
     * @apiParam {Number} id Users unique ID.
     *
     * @apiSuccess {String} firstname Firstname of the User.
     * @apiSuccess {String} lastname  Lastname of the User.
     */
    function getCitizen ($server, $id) {
        $crawler = new Crawler(file_get_contents('http://'.$server.'.e-sim.org/profile.html?id=' . $id));
        //$crawler = new Crawler(file_get_contents(__DIR__ . '\test.html'));

        $citizen = new \stdClass();

        $name = $crawler->filter('h2');
        $name = explode("\xC2", $name->getNode(0)->nodeValue, 2);
        $citizen->name = trim($name[1], " \t\n\r\0\x0B\xC2\xA0");

        $table = $crawler->filter('.smallTableFont');
        foreach ($table->children() as $child) {
            $arr = explode(":", $child->nodeValue);
            $name = $this->parseName($arr[0]);
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

        $cit = Citizen::where('id', $id)->count();
        if ($cit == 0) {
            $cit = new Citizen();
            $cit->id = $id;
            $cit->name = $citizen->name;
            $cit->save();
        }


        return response()->json($citizen);

    }

    function getByName($server, $name) {
        $cit = Citizen::where('name', $name);
        if ($cit->count() == 1) {
            return $this->getCitizen($server, $cit->get()->id);
        }

        $error = new \stdClass();
        $error->message = "Citizen not linked";
        return response()->json($error);
    }
}
