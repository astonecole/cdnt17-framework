<?php

namespace Rapido\Http;

use Rapido\View\Renderer;
use Rapido\View\Renderer\Json;

class Response
{
    private Header $header;
    private Renderer $renderer;
    private int $status = 200;
    private string $body = '';

    public function send(string $body = '')
    {
        if ($body !== '') {
            $this->setBody($body);
        }

        http_response_code($this->getStatus());

        foreach ($this->getHeader()->getValues() as $key => $values) {
            foreach ($values as $value) {
                header(sprintf('%s: %s', $key, $value));
            }
        }

        $stream = fopen('php://output', 'w');
        $octets = fwrite($stream, $this->getBody());

        fclose($stream);
        return $octets;
    }

    public function getHeader(): Header
    {
        return $this->header;
    }

    public function setHeader(Header $header): self
    {
        $this->header = $header;

        return $this;
    }

    public function setRenderer(Renderer $rendered):self
    {
        $this->renderer = $rendered;

        return $this;
    }

    public function getRenderer(): Renderer
    {
        return $this->renderer;
    }

    public function render($data, array $options = [])
    {
        $this->renderer->setResponse($this);
        $this->renderer->render($data, $options);
    }

    public function getStatus(): int
    {
        return $this->status;
    }

    public function setStatus(int $status)
    {
        $this->status = $status;

        return $this;
    }

    public function getBody(): string
    {
        return $this->body;
    }

    public function setBody(string $body): self
    {
        $this->body = $body;

        return $this;
    }

    public function redirect(string $url, int $code = 302)
    {
        $this->setStatus($code)
            ->getHeader()->set('Location', $url);

        $this->send();
    }
}
