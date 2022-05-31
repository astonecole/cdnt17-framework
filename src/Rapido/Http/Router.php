<?php

namespace Rapido\Http;

interface Router
{
    public function match(): ?Route;

    public function addRoute(string|array $method, string $path, callable $action);

    public function setRequest(Request $request): self;

    public function getRequest(): Request;
}
