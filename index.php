<?php

error_reporting(-1);
ini_set('display_errors', 'On');
date_default_timezone_set('Asia/Jakarta');

require_once __DIR__.'/vendor/autoload.php';

use Goutte\Client;

$app = new Silex\Application();

$app->get('/', function() use($app) {
  $client = new Client();

  $crawler = $client->request('GET', 'http://madingkampus.com');

  $listImages = $crawler->filter('.carousel-inner .thumbnail > a img')->each(function($node) {
    $imgSrc = $node->attr('src');
    return array(
      'url' => $imgSrc,
      'type' => 'image/*',
      'duration' => 1
    );
  });

  return $app->json(
    $listImages
  );

  // return $app->json(
  //   array(
  //     array(
  //       'url' => 'http://madingkampus.com/pamflet/17-03-02-madingkampus-kpjlhlefqa-.jpeg',
  //       'type' => 'image/jpeg',
  //       'duration' => 1
  //     ),
  //     array(
  //       'url' => 'http://madingkampus.com/pamflet/17-02-21-madingkampus-alkacgapjf-.PNG',
  //       'type' => 'image/png',
  //       'duration' => 1
  //     ),
  //     array(
  //       'url' => 'http://madingkampus.com/pamflet/17-01-17-madingkampus-kqdeqhgnne-.png',
  //       'type' => 'image/png',
  //       'duration' => 1
  //     )
  //   )
  // );
});

// enable CORS
$app->after(function ($request, $response) {
        if(!isset($_SERVER['HTTP_ORIGIN'])) {
          return;
        }
        $clientOrigin = $_SERVER['HTTP_ORIGIN'];
        $clientDomain = parse_url($clientOrigin, PHP_URL_HOST);
        $whitelistDomain = array('localhost', 'hasbi.lecturer.pens.ac.id');
        if(in_array($clientDomain, $whitelistDomain)) {
          $response->headers->set('Access-Control-Allow-Origin', $clientOrigin);
        }
        $response->headers->set('Access-Control-Allow-Headers', 'Authorization');
        $response->headers->set('Access-Control-Allow-Methods', 'GET, POST, PUT');
        // $response->headers->set('Http-Origin', $clientOrigin);
        // $response->headers->set('Client-Domain', $clientDomain);
        // $response->headers->set('In-Whitelist', in_array($clientDomain, $whitelistDomain));
    });

$app->options("{anything}", function () {
        return new \Symfony\Component\HttpFoundation\JsonResponse(null, 204);
    })->assert("anything", ".*");

$app->run();