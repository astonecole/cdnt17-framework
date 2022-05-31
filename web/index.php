<?php

ini_set('display_errors', 'On');

use Rapido\Http\Header;
use Rapido\Http\Response;

require '../vendor/autoload.php';

$header = new Header();
$response = new Response();
$response->setHeader($header);

$header->set('Content-Type', 'text/html; charset=utf-8')
    ->set('X-Powered-By', 'Rapido Framework');

$response->setStatus(404)->send('<h1>Hello World</h1>');
