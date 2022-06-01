<?php

namespace Rapido\App;

use Rapido\Container\Container;
use Rapido\Http\Header;
use Rapido\Http\Request;
use Rapido\Http\Response;
use Rapido\Http\Uri;
use Rapido\Http\Router\RegexRouter;

class Rapido
{
    private Container $container;

    public function __construct(Container $container)
    {
        $this->container = $container;

        if (!$container->has('router')) {
            $container->singleton('router', function () {
                $uri = new Uri($_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
                $request = new Request($uri);
                $request->setServerParams($_SERVER);
    
                return new RegexRouter($request);
            });
        }
    }

    public function run()
    {
        $router = $this->container->get('router');
        $request = $router->getRequest();

        $response = new Response();
        $response->setHeader(new Header());

        if (($route = $router->match()) !== null) {
            $action = $route->getAction();
        } else {
            $action = $this->container->get('router:error');
        }

        $action($request, $response);
        exit(0);
    }

    public function get(string $path, callable $action)
    {
        return $this->setRoute('GET', $path, $action);
    }

    public function post(string $path, callable $action)
    {
        return $this->setRoute('POST', $path, $action);
    }

    public function put(string $path, callable $action)
    {
        return $this->setRoute('PUT', $path, $action);
    }

    public function delete(string $path, callable $action)
    {
        return $this->setRoute('DELETE', $path, $action);
    }

    protected function setRoute(string|array $method, string $path, callable $action): self
    {
        $this->container->get('router')->addRoute($method, $path, $action);

        return $this;
    }
}
