<?php

namespace Alexzvn\Speedsms\Callback;

use Alexzvn\Speedsms\Callback\JsonCallback;

class Incoming extends JsonCallback
{
    /**
     * Get type
     *
     * @return string|null
     */
    public function type()
    {
        return $this->type;
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
     * Get content of message
     *
     * @return string|null
     */
    public function message()
    {
        return $this->content;
    }
}
