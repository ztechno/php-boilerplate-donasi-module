<?php

namespace Modules\Donasi\Libraries;

use Core\Response;

class TriPay
{
    private $privateKey = '';

    /**
     * initiation private key form .env
     */
    public function __construct()
    {
        $this->privateKey = env('TRIPAY_PRIVATE_KEY', '');
    }

    /**
     * create signature
     * doc : https://tripay.co.id/developer?tab=callback
     * 
     * @param $input as json string
     * 
     * @return signature string
     */
    public function createSignature($input)
    {
        return hash_hmac('sha256', $input, $this->privateKey);
    }

    /**
     * validate callback signature
     * 
     * @param $input as json string
     * 
     * @return boolean
     */
    public function doCallback($input, $callback)
    {
        $response  = null;
        $signature = $this->createSignature($input);
        $callbackSignature = isset($_SERVER['HTTP_X_CALLBACK_SIGNATURE'])
            ? $_SERVER['HTTP_X_CALLBACK_SIGNATURE']
            : '';

        if($callbackSignature != $signature)
        {
            $response = [
                'success' => false,
                'message' => 'Invalid signature',
            ];
        }

        $data = json_decode($input);

        if(JSON_ERROR_NONE !== json_last_error())
        {
            $response = [
                'success' => false,
                'message' => 'Invalid data sent by payment gateway',
            ];
        }

        if ('payment_status' !== $_SERVER['HTTP_X_CALLBACK_EVENT']) {
            $response = [
                'success' => false,
                'message' => 'Unrecognized callback event: ' . $_SERVER['HTTP_X_CALLBACK_EVENT'],
            ];
        }

        if($response)
        {
            return $response;
        }

        return $callback($data);
    }

}