<?php

namespace View\Renderer;

use InvalidArgumentException;

class Service
{
    private $renderer;

    public function __construct(string $type)
    {
        if (!class_exists($type)) {
            throw new InvalidArgumentException("class $type does not exists");
        }

        $this->renderer = new $type();
    }
}
