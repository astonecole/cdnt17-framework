<?php

namespace Rapido\Http;

class Response
{
    private Header $header;
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

    /**
     * Get the value of header
     */ 
    public function getHeader(): Header
    {
        return $this->header;
    }

    /**
     * Set the value of header
     *
     * @return self
     */ 
    public function setHeader(Header $header): self
    {
        $this->header = $header;

        return $this;
    }

    /**
     * Get the value of status
     */ 
    public function getStatus(): int
    {
        return $this->status;
    }

    /**
     * Set the value of status
     *
     * @return self
     */ 
    public function setStatus(int $status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get the value of body
     */ 
    public function getBody(): string
    {
        return $this->body;
    }

    /**
     * Set the value of body
     *
     * @return self
     */ 
    public function setBody(string $body): self
    {
        $this->body = $body;

        return $this;
    }
}
