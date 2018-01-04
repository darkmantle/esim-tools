<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\DomCrawler\Crawler;

/**
 * @resource Economy
 *
 * The Economy resource lets you gather data regarding the different aspects of the in-game economy. This includes
 * information regarding the exchange, products, job market, auctions and the current stock companies.
 */
class EconomyController extends Controller {
	function getProducts( $server, $resource, $country, $quality ) {
		if ( $country == 0 ) {
			$country = - 1;
		}
		$crawler = new Crawler( file_get_contents( 'http://' . $server . '.e-sim.org/productMarket.html?resource=' . strtoupper( $resource ) . '&countryId=' . $country . '&quality=' . $quality . '&page=1' ) );

		$table = $crawler->filter( '.dataTable' );

		$results = array();
		foreach ( $table->children() as $row ) {
			if ( trim( $row->nodeValue ) == "No offers" ) {
				return response()->json( array() );
			}

			$string = explode( "You ", $row->nodeValue )[0];
			$arr = array_reverse( preg_split( "^[\n\r\s★]+^", trim( $string ) ) );
			if ( $arr[1] != "Price" ) {

				$seller = '';
				for ( $i = 3; $i < count( $arr ); $i ++ ) {
					$seller = $arr[ $i ] . " " . $seller;
				}

				$product = new \stdClass();
				$product->currency = $arr[0];
				$product->price = $arr[1];
				$product->amount = $arr[2];
				$product->seller = trim( $seller );
				$results[] = $product;
			}
		}

		return response()->json( $results );

	}

	function getExchange( $server, $from, $to ) {
		$crawler = new Crawler( file_get_contents( 'http://' . $server . '.e-sim.org/monetaryMarket.html?buyerCurrencyId=' . $to . '&sellerCurrencyId=' . $from ) );

		$items = array();
		$crawler = $crawler->filter( 'table' );

		$i = 0;
		foreach ( $crawler->children() as $c ) {
			if ( $i > 0 ) {
				$test = array_reverse( preg_split( "^[\n\r\s★]+^", trim( $c->nodeValue ) ) );

				$obj = new \stdClass();
				$obj->to = $test[0];
				$obj->rate = $test[1];
				$obj->from = $test[3];
				$obj->amount = $test[6];

				$name = '';
				for ( $i = 7; $i < count( $test ); $i ++ ) {
					$name = $test[ $i ] . ' ' . $name;
				}
				$obj->seller = $name;

				$items[] = $obj;
			}
			$i ++;
		}

		return response()->json( $items );
	}

	function getJobs( $server, $country, $skill ) {
		$crawler = new Crawler( file_get_contents( 'http://' . $server . '.e-sim.org/jobMarket.html?countryId=' . $country . '&minimalSkill=' . $skill ) );

		$rows = array();
		$titles = [ 'employer', 'company', '', 'minimum_skill', 'salary', '' ];
		$tr_elements = $crawler->filterXPath( '//table/tr' );
		// iterate over filter results
		foreach ( $tr_elements as $j => $content ) {
			if ( $j === 0 ) {
				continue;
			}

			$tds = new \stdClass();
			// create crawler instance for result
			$crawler = new Crawler( $content );
			//iterate again
			foreach ( $crawler->filter( 'td' ) as $i => $node ) {
				// extract the value
				if ( $i === 5 || $i === 2 ) {
					continue;
				}

				if ( $i === 4 ) {
					$split = explode( " ", trim( $node->nodeValue ) );
					$tds->salary = new \stdClass();
					$tds->salary->amount = $split[0];
					$tds->salary->currency = $split[1];
					continue;
				}

				$tds->{$titles[ $i ]} = trim( $node->nodeValue );

			}
			$rows[] = $tds;

		}

		return response()->json( $rows );
	}

	function getAuctions( $server, $status, $sorting, $page ) {
		$crawler = new Crawler( file_get_contents( 'http://' . $server . '.e-sim.org/auctions.html?type=null&status=' . strtoupper( $status ) . '&equipmentSorting=' . strtoupper( $sorting ) . '&page=' . $page ) );

		$rows = array();

		$tr_elements = $crawler->filterXPath( '//table/tr' );
		// iterate over filter results
		foreach ( $tr_elements as $i => $content ) {
			$tds = array();
			// create crawler instance for result
			$crawler = new Crawler( $content );
			//iterate again
			foreach ( $crawler->filter( 'td' ) as $i => $node ) {
				// extract the value
				$tds[] = $node->nodeValue;
			}
			if ( $tds[0] !== "Seller" ) {
				$item = new \stdClass();
				$item->seller = trim( $tds[0] );
				$item->name = preg_replace( "/\([^)]+\)/", "", html_entity_decode( str_replace( '&gt', '&gt;)', trim( $tds[2] ) ) ) );
				$item->price = trim( $tds[3] );

				$rows[] = $item;
			}

		}

		return response()->json( $rows );

	}
}
