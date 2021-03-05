<?php

namespace Alexzvn\Speedsms\Callback;

class JsonCallback
{
    /**
     * Body Request
     *
     * @var mixed
     */
    protected $body;

    public function __construct() {
        $this->body = json_decode($this->getBody());
    }

    /**
     * Get body content request
     *
     * @return string|false
     */
    protected function getBody()
    {
        return file_get_contents('php://input');
    }

    public function __get(string $name)
    {
        return $this->body->$name ?? null;
    }

    public function __toString()
    {
        return json_encode($this->body);
    }
}

