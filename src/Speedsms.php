<?php

namespace Alexzvn\Speedsms;

use Alexzvn\Speedsms\Response\Sms as SmsResponse;
use Alexzvn\Speedsms\Response\SmsCheck as SmsCheckResponse;
use Alexzvn\Speedsms\Response\User as UserResponse;
use Alexzvn\Speedsms\Callback\Incoming;
use Alexzvn\Speedsms\Callback\Status;

class Speedsms extends Base
{
    /**
     * Advertising message type
     */
    const SMS_ADS = 1;

    /**
     * Support message type
     * Send from random phone number
     */
    const SMS_SUPPORT = 2;

    /**
     * Using brandname to send
     */
    const SMS_BRANDNAME = 3;

    /**
     * SMS send by default brandname "Notify"
     */
    const SMS_BRANDNAME_NOTIFY = 4;

    /**
     * Sms send by personal phone number
     * @see https://play.google.com/store/apps/details?id=com.speedsms.gateway
     */
    const SMS_GATEWAY = 5;

    /**
     * Send by fixed number "0901756186"
     */
    const SMS_FIXED_NUMBER = 6;

    /**
     * Send by private number has register in SpeedSMS
     */
    const SMS_OWN_NUMBER = 7;

    /**
     * Send by fixed number two way
     */
    const SMS_TWO_WAY_NUMBER = 8;

    public function __construct(string $endpointKey) {
        $this->endpointKey = $endpointKey;
    }

    /**
     * Get info current user
     *
     * @return \Alexzvn\Speedsms\Response\User
     */
    public function getUserInfo()
    {
        return new UserResponse(
            $this->client()->get("index.php/user/info")
        );
    }

    /**
     * Send sms to a phone number
     *
     * @param array $phone phone number to send
     * @param string $message content of message
     * @param integer $type 
     * @param string $sender brandname or phone number has register in SpeedSMS
     * 
     * @return \Alexzvn\Speedsms\Response\Sms
     */
    public function sendSms(string $phone, string $message, int $type = 2, string $sender = '')
    {
        return $this->sendListSms([$phone], $message, $type, $sender);
    }

    /**
     * Send sms to list phone number
     *
     * @param array $to list number to send
     * @param string $message content of message
     * @param integer $type 
     * @param string $sender brandname or phone number has register in SpeedSMS
     * 
     * @return \Alexzvn\Speedsms\Response\Sms
     */
    public function sendListSms(array $listPhone, string $message, int $type = 2, string $sender = '')
    {
        if (count($listPhone) > 100) {
            throw new \Exception("Can be sent only 100 phone numbers in a times", 1);
        }

        $this->validateMessage($message);

        $response = $this->client()->post('index.php/sms/send', [
            'body' => json_encode([
                'to'       => $listPhone,
                'content'  => $message,
                'sms_type' => $type,
                'sender'   => $sender
            ])
        ]);

        return new SmsResponse($response);
    }

    /**
     * Check list sms status from transaction ID
     *
     * @param string $tranId
     * 
     * @return \Alexzvn\Speedsms\Response\SmsCheck
     */
    public function checkSms(string $transId)
    {
        return new SmsCheckResponse(
            $this->client()->get("sms/status/$transId")
        );
    }

    protected function validateMessage(string $message)
    {
        if (mb_detect_encoding($message) !== 'ASCII' && mb_strlen($message, 'UTF-8') > 70) {
            throw new MessageLengthException(
                "Message contain unicode maximum length is 70"
            );
        }

        if (strlen($message) > 160) {
            throw new MessageLengthException(
                "Message maximum length is 160"
            );
        }

        if (strlen($message) === 0) {
            throw new MessageLengthException("Message can't empty");
        }
    }

    /**
     * Get body request incoming callback
     *
     * @return \Alexzvn\Speedsms\Callback\Incoming
     */
    public static function incoming()
    {
        return new Incoming;
    }

    /**
     * Get body request status callback
     *
     * @return \Alexzvn\Speedsms\Callback\Status
     */
    public static function status()
    {
        return new Status;
    }
}
