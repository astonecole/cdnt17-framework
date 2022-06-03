<?php

use Rapido\Container\Container;

function initServices(Container $container): Container
{
    // App
    $container->register('app:name', 'Rapido');

    // Database
    $container->register('db:dsn', 'mysql:host=dbtest;dbname=blogger;charset=utf8');

    $container->singleton('db', function ($c): PDO {
        return new PDO($c->get('db:dsn'), 'root', 'root');
    });

    return $container;
}
