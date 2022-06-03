<?php

namespace Rapido\App;

use Rapido\Container\Container;
use Rapido\Http\Uri;
use Rapido\Http\Request;
use Rapido\Http\Response;
use Rapido\Http\Router;
use Rapido\Http\Router\RegexRouter;
use Rapido\View\Renderer;
use Rapido\View\Renderer\Json;

class Service extends Container
{
    public function __construct()
    {
        if (!$this->has('render:class')) {
            $this->register('render:class', Json::class);
        }

        if (!$this->has('render')) {
            $this->register('render', function ($c): Renderer {
                $type = $c->get('render:class');

                $instance = new $type();

                if ($c->has('render:options')) {
                    $instance->setOptions($c->get('render:options'));
                };

                return $instance;
            });
        }

        if (!$this->has('http:uri')) {
            $this->register('http:uri', new Uri());
        }

        if (!$this->has('router:class')) {
            $this->register('router:class', RegexRouter::class);
        }

        if (!$this->has('router:error')) {
            $this->protected('router:error', function (Request $req, Response $res): void {
                $res->setStatus(404)
                    ->send('<h1>Not Found</h1>');
            });
        }

        if (!$this->has('router')) {
            $this->singleton('router', function ($c): Router {
                $uri = $c->get('http:uri');
                $req = new Request($uri);
                $req->setServerParams($_SERVER);

                $url = $req->getServerParam('HTTP_HOST') .
                    $req->getServerParam('REQUEST_URI');

                $uri->parse($url);

                $instance = $c->get('router:class');
                return new $instance($req);
            });
        }
    }
}
