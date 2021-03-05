<?php

namespace Alexzvn\Speedsms;

use GuzzleHttp\Client;

abstract class Base
{
    /**
     * Endpoint API URL SMS
     *
     * @var string
     */
    protected string $endpoint = 'https://api.speedsms.vn';

    /**
     * Api access token
     *
     * @var string
     */
    protected string $endpointKey;

    /**
     * Create new http client based api
     *
     * @return \GuzzleHttp\Client
     */
    public function client()
    {
        return new Client([
            'base_uri' => $this->endpoint,
            'headers' => [
                'Authorization' => 'Basic ' . base64_encode("$this->endpointKey:x"),
                'Content-type'  => 'application/json',
                'Accept'        => 'application/json'
            ]
        ]);
    }
}
