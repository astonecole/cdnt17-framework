<?php

namespace Rapido\Http\Router;

use Rapido\Http\Request;
use Rapido\Http\Router;

class BasicRouter implements Router
{
    private array $routes = [];
    private Request $request;

    public function match(): ?Route
    {
        $path = $this->getRequest()->getUri()->getPath();
        $method = $this->getRequest()->getMethod();

        if (!isset($this->routes[$path])) {
            return null;
        }

        $route = $this->routes[$path];

        if ($route->getMethod() !== $method || !in_array($method, $route->getMethod())) {
            return null;
        }

        return $route;
    }

    public function addRoute(string|array $method, string $path, callable $action): self
    {
        $this->routes[$path] = new Route($method, $path, $action);

        return $this;
    }

    public function setRequest(Request $request): self
    {
        $this->request = $request;

        return $this;
    }

    public function getRequest(): Request
    {
        return $this->request;
    }
}
