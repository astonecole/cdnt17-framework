<?php

namespace Rapido\Http;

class Request {
    private array $params = [];       // /cart/product/{20}
    private array $queryParams = [];  // ?name=toto&age=30
    private array $serverParams = []; // $_SERVER
    private string $method = 'GET';
    private ?string $body;
    private Uri $uri;

    public function __construct(Uri $uri)
    {
        $this->setUri($uri);
    }

    public function getUri(): Uri
    {
        return $this->uri;
    }

    public function setUri(Uri $uri): self
    {
        $queryParams = [];
        parse_str($uri->getQuery(), $queryParams);
        $this->setQueryParams($queryParams);

        $this->uri = $uri;

        return $this;
    }
 
    public function getBody(): string
    {
        if (is_null($this->body)) {
            $this->body = stream_get_contents('php://input');
        }

        return $this->body;
    }

    public function setBody(string $body): self
    {
        $this->body = $body;

        return $this;
    }

    public function getMethod(): string
    {
        return $this->method;
    }

    public function setMethod(string $method): self
    {
        $this->method = $method;

        return $this;
    }

    public function getQueryParams(): array
    {
        return $this->queryParams;
    }

    public function setQueryParams(array $queryParams): self
    {
        $this->queryParams = $queryParams;

        return $this;
    }

    public function getServerParams(): array
    {
        return $this->serverParams;
    }

    public function setServerParams(array $serverParams): self
    {
        $this->setMethod($serverParams['REQUEST_METHOD'] ?? 'GET');
        $this->serverParams = $serverParams;

        return $this;
    }

    public function getParams(): array
    {
        return $this->params;
    }

    public function setParams(array $params): self
    {
        $this->params = $params;

        return $this;
    }
}
