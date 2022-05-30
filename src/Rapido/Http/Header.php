<?php

namespace Rapido\Http;

class Header
{
    private array $values = [];

    public function set(string $key, string $value)
    {
        $this->values[$key] = [$value];

        return $this;
    }

    public function add(string $key, string $value)
    {
        $this->values[$key][] = $value;

        return $this;
    }

    public function has(string $key): bool
    {
        return isset($this->values[$key]);
    }

    public function get(string $key): array
    {
        return $this->values[$key];
    }
}
