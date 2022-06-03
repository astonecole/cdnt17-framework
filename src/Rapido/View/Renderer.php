<?php

namespace Rapido\View;

use Rapido\Http\Response;

interface Renderer
{
    public function setOption(string $key, $value): self;

    public function getOption(string $key);

    public function setOptions(array $options): self;

    public function getOptions(): array;

    public function setResponse(Response $response): self;

    public function render($data, array $options = []);
}
