<?php

namespace Rapido\Http\Router;

class Route
{
    private string|array $method;
    private $path = '';
    private array $params = [];
    private $action;

    public function getAction(): callable
    {
        return $this->action;
    }

    public function setAction(callable $action): self
    {
        $this->action = $action;

        return $this;
    }

    public function getParams(): array
    {
        return $this->params;
    }

    public function setParams(array $params)
    {
        $this->params = $params;

        return $this;
    }

    public function getPath(): string
    {
        return $this->path;
    }

    public function setPath(string $path): self
    {
        $this->path = $path;

        return $this;
    }

    public function getMethod(): string|array
    {
        return $this->method;
    }

    public function setMethod(string|array $method): self
    {
        $this->method = $method;

        return $this;
    }
}