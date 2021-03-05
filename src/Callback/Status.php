<?php

namespace Alexzvn\Speedsms\Callback;

use Alexzvn\Speedsms\Callback\JsonCallback;

class Status extends JsonCallback
{
    /**
     * Get type callback
     *
     * @return string|null
     */
    public function type()
    {
        return $this->type;
    }

    /**
     * Get transaction id
     *
     * @return string|null
     */
    public function tranId()
    {
        return $this->tranId;
    }

    /**
     * Get phone number
     *
     * @return string|null
     */
    public function phone()
    {
        return $this->phone;
    }

    /**
     * Get status code
     *
     * @return int|null
     */
    public function status()
    {
        return $this->status;
    }

    /**
     * Check is if sms has receive success or not
     *
     * @return boolean
     */
    public function success()
    {
        return $this->status() === 0;
    }
}
