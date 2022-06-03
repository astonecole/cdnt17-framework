<?php

ini_set('display_errors', 'On');

use Rapido\App\Service;
use Rapido\Http\Request;
use Rapido\Http\Response;
use Rapido\App\Rapido;

require '../vendor/autoload.php';
require './config/services.php';

$container = initServices(new Service());
$app = new Rapido($container);

$app->get('/blog/articles/add', function (Request $req, Response $res) use ($container) {
    $db = $container->get('db');

    $res->send('<h1>Hello World</h1>');
});

try {
    $app->run();
} catch (Exception $e) {
    echo $e->getMessage();
}
