<?php

namespace Alexzvn\Speedsms\Response;

use Alexzvn\Speedsms\BaseResponse;

class Sms extends BaseResponse
{
    protected bool $decodeBody = true;

    /**
     * Get transaction ID
     *
     * @return int|null
     */
    public function tranId()
    {
        return $this->tranId;
    }

    /**
     * Undocumented function
     *
     * @return string|null
     */
    public function name()
    {
        return $this->name;
    }

    /**
     * Count total sms has send
     *
     * @return int
     */
    public function total()
    {
        return $this->totalSMS;
    }

    /**
     * Total price
     *
     * @return int
     */
    public function price()
    {
        return $this->totalPrice;
    }

    /**
     * Get list invalid phone number can't send
     *
     * @return string[]|array
     */
    public function invalidPhone()
    {
        return $this->invalidPhone;
    }
}

