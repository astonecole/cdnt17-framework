<?php

namespace Rapido\View\Renderer;

use InvalidArgumentException;
use Rapido\Http\Response;
use Rapido\View\Renderer;

class Json implements Renderer
{
    private $data = [];

    public function setData($data): self
    {
        if (!is_array($data)) {
            throw new InvalidArgumentException('data must be an array');
        }

        $this->data = $data;
        return $this;
    }

    public function getData()
    {
        return $this->data;
    }

    public function render(Response $response)
    {
        $response->getHeader()->set('Content-Type', 'application/json');
        $response->send(json_encode($this->getData()));
    }
}
