<?php

namespace Rapido\App;

use Rapido\Container\Container;
use Rapido\Http\Header;
use Rapido\Http\Response;

class Rapido
{
    private Container $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    public function run()
    {
        $router = $this->container->get('router');
        $renderer = $this->container->get('render');
        $request = $router->getRequest();

        $response = new Response();
        $response->setHeader(new Header())
            ->setRenderer($renderer);

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

    public function all(array $methods, string $path, callable $action)
    {
        return $this->setRoute($methods, $path, $action);
    }

    protected function setRoute(string|array $method, string $path, callable $action): self
    {
        $this->container->get('router')->addRoute($method, $path, $action);

        return $this;
    }
}
