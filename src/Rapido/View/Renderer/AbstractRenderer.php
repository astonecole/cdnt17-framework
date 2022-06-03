<?php

namespace Rapido\View\Renderer;

use Rapido\Http\Response;
use Rapido\View\Renderer;

abstract class AbstractRenderer implements Renderer
{
    private array $options;
    private Response $response;

    public function __construct(array $options = [])
    {
        $options = array_merge([
            'content-type' => 'application/json',
            'charset' => 'charset=utf-8',
            'flags' => 0,
            'depth' => 512,
        ], $options);

        $this->setOptions($options);
    }

    public function setOption(string $key, $value): self
    {
        $this->options[$key] = $value;

        return $this;
    }

    public function getOption(string $key)
    {
        return $this->options[$key] ?? null;
    }

    public function setOptions(array $options): self
    {
        foreach ($options as $key => $value) {
            $this->setOption($key, $value);
        }

        return $this;
    }

    public function getOptions(): array
    {
        return $this->options;
    }

    public function setResponse(Response $response): self
    {
        $this->response = $response;

        return $this;
    }

    protected function getResponse(): Response
    {
        return $this->response;
    }
}
