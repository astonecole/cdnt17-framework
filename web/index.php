<?php

ini_set('display_errors', 'On');

use Rapido\Http\Header;
use Rapido\Http\Response;
use Rapido\Http\Uri;

require '../vendor/autoload.php';

$uri = new Uri($_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
$header = new Header();
$response = new Response();
$response->setHeader($header);

$header->set('Content-Type', 'text/html; charset=utf-8')
->set('X-Powered-By', 'Rapido Framework');

$response->setStatus(404)
->send('<h1>Hello World</h1>');

// var_dump($_SERVER);

echo $uri->getHost(), '<br>';
echo $uri->getPath(), '<br>';
echo $uri->getPort(), '<br>';
echo $uri->getUser(), '<br>';
echo $uri->getPass(), '<br>';
echo $uri->getFragment(), '<br>';
echo $uri->getQuery(), '<br>';
