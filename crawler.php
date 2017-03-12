<?php

require_once __DIR__.'/vendor/autoload.php';

use Goutte\Client;
use GuzzleHttp\Client as GuzzleClient;

$client = new Client();
// $client->setClient(new GuzzleClient(array(
// 	'timeout' => 30
// )));

// var_dump($client);

$crawler = $client->request('GET', 'http://madingkampus.com');
// $crawler = $client->request('GET', 'http://localhost:9966/');

var_dump($crawler);

// $crawler->filter('.carousel-inner .thumbnail a img')->each(function($node) {	
// 	print $node->attr('src') . "\n";
// });
