<?php

ini_set('display_errors', 'On');

use Rapido\Http\Header;
use Rapido\Http\Response;
use Rapido\Http\Uri;

require '../vendor/autoload.php';

$uri = new Uri('http://user:pass@localhost:3000/blog/articles?name=joe#hello');

$header = new Header();
$response = new Response();
$response->setHeader($header);

$header->set('Content-Type', 'text/html; charset=utf-8')
    ->set('X-Powered-By', 'Rapido Framework');

$response->setStatus(404)
    ->send('<h1>Hello World</h1>');
