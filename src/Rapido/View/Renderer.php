<?php

namespace Rapido\View;

use Rapido\Http\Response;

interface Renderer
{
    public function setData($data): self;

    public function getData();

    public function render(Response $response);
}
