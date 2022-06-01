<?php

ini_set('display_errors', 'On');

use Rapido\Http\Header;
use Rapido\Http\Request;
use Rapido\Http\Response;
use Rapido\Http\Router;
use Rapido\Http\Router\RegexRouter;
use Rapido\Http\Uri;

require '../vendor/autoload.php';

$uri = new Uri($_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
$request = new Request($uri);
$request->setServerParams($_SERVER);

$router = new RegexRouter($request);

$container = new Container();

$container->register('app:name', 'Rapido Framework');

$container->register('app', function ($container) {
    echo $container->get('app:name');
});

$container->register('router:class:name', RegexRouter::class);

$container->register('router', function ($container): Router {
    $router = $container->get('router:class:name');
    $request = $container->get('http:request');

    return new $router($request);
});

$container->register('db:driver', 'mysql:host=localhost;');
$container->singleton('db', function () {

});

$container->protected('controller', function () {

});

$container->get('db')->query();

$container->get('router')->addRoute('');

$router->addRoute('GET', '/articles', function ($req, $res) use ($container) {
    $container->get('app');
});

$route = $router->match();

$action = $route->getAction();
$action($request, new Response());

$header = new Header();
$response = new Response();

$response->setHeader($header);

$header->set('Content-Type', 'text/html; charset=utf-8')
    ->set('X-Powered-By', 'Rapido Framework');

$response->setStatus(200)
    ->send($request->getBody() . ' ' . $request->getMethod());
