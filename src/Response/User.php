<?php

namespace Alexzvn\Speedsms\Response;

use Alexzvn\Speedsms\BaseResponse;

class User extends BaseResponse
{
    protected bool $decodeBody = true;

    /**
     * Get current user email
     *
     * @return string|null
     */
    public function email()
    {
        return $this->email;
    }

    /**
     * Get user balance
     *
     * @return int|null
     */
    public function balance()
    {
        return $this->balance;
    }

    /**
     * Get user currency
     *
     * @return string|null
     */
    public function currency()
    {
        return $this->currency;
    }
}
