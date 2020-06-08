<?php

namespace App;

use App\Response;

class Response
{
	protected $body;

	protected $statusCode = 200;

	protected $headers = [];

    public function withBody($body) : Response
    {
        $this->body = $body;

        return $this;
    }

    public function withStatus(int $statusCode) : Response
    {
        $this->statusCode = $statusCode;

        return $this;
    }

    public function withJson($body) : Response
    {
        $this
        	->withHeader("Content-Type", "application/json")
        	->withBody(json_encode($body));

        return $this;
    }

    public function withHeader($name, $value) : Response
    {
        $this->headers[] = [$name, $value];

        return $this;
    }

    public function getBody()
    {
        return $this->body;
    }

    public function getStatusCode() : int
    {
        return (int) $this->statusCode;
    }

    public function getHeaders() : array
    {
        return $this->headers;
    }
}
