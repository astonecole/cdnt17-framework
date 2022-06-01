<?php

use Rapido\Container\Container;
use Rapido\Http\Request;
use Rapido\Http\Response;

function initServices(Container $container): Container
{
    // App
    $container->register('app:name', 'Rapido');

    // Database
    $container->register('db:dsn', 'mysql:host=localhost;dbname=blogger;charset=utf8');
    $container->singleton('db', funcwtion ($c) {
        return new PDO($c->get('dsn'), 'root', 'root');
    });

    // HTTP
    $container->protected('router:error', function (Request $req, Response $res){
        $res->setStatus('404')
            ->send('<h1>Not Found</h1>');
    });

    return $container;
}
