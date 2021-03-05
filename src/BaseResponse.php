<?php

namespace Alexzvn\Speedsms;

use Psr\Http\Message\ResponseInterface;

abstract class BaseResponse
{
    protected ResponseInterface $response;

    protected bool $decodeBody = false;

    protected $data;

    public function __construct(ResponseInterface $response) {
        $this->response = $response;

        $this->decodeBody === true && $this->decodeBody();
    }

    private function decodeBody()
    {
        $this->data = json_decode($this->response->getBody()->__toString());

        if ($this->data->status !== 'success') {
            throw new \Exception($this->data->message, 1);
        }

        $this->data = $this->data->data;
    }

    public function stream()
    {
        return $this->response;
    }

    /**
     * Get data by key from relative variable $data
     *
     * @param string $key
     * @return mixed
     */
    public function __get(string $key)
    {
        return $this->data->$key ?? null;
    }
}
