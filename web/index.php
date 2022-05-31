<?php

use Rapido\Http\Header;

require '../vendor/autoload.php';

$header = new Header();

$header->set('Content-Type', 'text/plain; charset=utf-8')
    ->set('X-Powered-By', 'Rapido Framework')
    ->remove('Content-Type');

echo $header;
