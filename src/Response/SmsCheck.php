<?php

namespace Alexzvn\Speedsms\Response;

use Alexzvn\Speedsms\BaseResponse;

class SmsCheck extends BaseResponse
{
    protected bool $decodeBody = true;

    /**
     * Get all list element phone and status
     *
     * @return array
     */
    public function all()
    {
        return (array) $this->data ?? [];
    }
}
