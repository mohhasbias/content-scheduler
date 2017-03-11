<?php

error_reporting(-1);
ini_set('display_errors', 'On');
date_default_timezone_set('Asia/Jakarta');

require_once __DIR__.'/vendor/autoload.php';

$app = new Silex\Application();

$app->get('/', function() use($app) {
  return $app->json(
    array(
      array(
        'url' => 'http://madingkampus.com/pamflet/17-03-02-madingkampus-kpjlhlefqa-.jpeg',
        'type' => 'image/jpeg',
        'duration' => 1
      ),
      array(
        'url' => 'http://madingkampus.com/pamflet/17-02-21-madingkampus-alkacgapjf-.PNG',
        'type' => 'image/png',
        'duration' => 1
      ),
      array(
        'url' => 'http://madingkampus.com/pamflet/17-01-17-madingkampus-kqdeqhgnne-.png',
        'type' => 'image/png',
        'duration' => 1
      )
    )
  );
});

// enable CORS
$app->after(function ($request, $response) {
        // $response->headers->set('Access-Control-Allow-Origin', '*');
        $clientDomain = $request->getHost();
        $whitelist = array('localhost', 'hasbi.lecturer.pens.ac.id');
        if(in_array($clientDomain, $whitelist)) {
          $response->headers->set('Access-Control-Allow-Origin', $clientDomain);
        }
        $response->headers->set('Access-Control-Allow-Headers', 'Authorization');
        $response->headers->set('Access-Control-Allow-Methods', 'GET, POST, PUT');
        $response->headers->set('Client-Domain', $request->getHost());
    });

$app->options("{anything}", function () {
        return new \Symfony\Component\HttpFoundation\JsonResponse(null, 204);
    })->assert("anything", ".*");

$app->run();