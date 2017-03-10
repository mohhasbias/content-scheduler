<?php

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

$app->run();