<?php

namespace App\Http\Controllers\API;

use App\Citizen;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\DomCrawler\Crawler;


class BattleController extends Controller {
	function getAll($server, $country) {
		$crawler = new Crawler(file_get_contents('http://'.$server.'.e-sim.org/battles.html?countryId=' . $country));

		$rows = array();
		$tr_elements = $crawler->filterXPath('//table/tr');
		// iterate over filter results
		foreach ($tr_elements as $i => $content) {
			if ($i === 0) continue;
			$tds = array();
			// create crawler instance for result
			$crawler = new Crawler($content);
			//iterate again
			foreach ($crawler->filter('td') as $i => $node) {
				// extract the value
				$tds[] = trim(preg_replace('/\s\s+/', ' ', $node->nodeValue));

			}

			if (str_contains($tds[0], "Practice ")) continue;

			$nf = new \NumberFormatter("en_EN", \NumberFormatter::DECIMAL);

			$battle = new \stdClass();
			$battle->region = explode("Subsidies", $tds[0])[0];
			$battle->score = $tds[1];
			$battle->damage = $nf->parse($tds[2], \NumberFormatter::TYPE_INT32);
			$rows[] = $battle;
		}

		return response()->json($rows);
	}
}
