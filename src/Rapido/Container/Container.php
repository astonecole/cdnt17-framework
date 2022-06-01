<?php

namespace Rapido\Container;

use Exception;

class Container 
{
    private $services = [];

    public function register(string $id, $value): self
    {
        $this->services[$id] = $value;

        return $this;
    }

    public function singleton(string $id, callable $func): self
    {
        return $this->register($id, function () use ($func) {
            static $service = null;

            if ($service === null) {
                $service = $func($this);
            }

            return $service;
        }); 
    }

    public function protected(string $id, callable $value): self
    {
        return $this->register($id, function () use ($value) {
            return $value;
        });
    }

    public function get(string $id)
    {
        if (!$this->has($id)) {
            throw new Exception("service $id not found");
        }

        $service = $this->services[$id];

        if (!is_callable($service)) {
            return $service;
        }

        return $service($this); // return $service($container);
    }

    public function has(string $id): bool
    {
        return isset($this->services[$id]);
    }
}