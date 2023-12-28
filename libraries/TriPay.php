<?php

namespace Modules\Donasi\Libraries;

use Core\Response;

class TriPay
{
    private $privateKey = '';
    private $apiKey     = '';
    private $apiUrl     = 'https://tripay.co.id/';

    /**
     * initiation private key form .env
     */
    public function __construct()
    {
        $this->privateKey = env('TRIPAY_PRIVATE_KEY', '');
        $this->apiKey = env('TRIPAY_API_KEY', '');
        $tripayEnv = env('TRIPAY_ENV', 'sandbox');
        if($tripayEnv == 'sandbox')
        {
            $this->apiUrl .= 'api-sandbox/';
        }
        else
        {
            $this->apiUrl .= 'api/';
        }
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

    function getChannel()
    {

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_FRESH_CONNECT  => true,
            CURLOPT_URL            => $this->apiUrl . 'merchant/payment-channel',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER         => false,
            CURLOPT_HTTPHEADER     => ['Authorization: Bearer '.$this->apiKey],
            CURLOPT_FAILONERROR    => false,
            CURLOPT_IPRESOLVE      => CURL_IPRESOLVE_V4
        ));

        $response = curl_exec($curl);
        $error = curl_error($curl);

        curl_close($curl);

        // echo empty($error) ? $response : $error;
        if(empty($error))
        {
            return json_decode($response);
        }

        return json_decode($error);
    }

    function createTransaction($data)
    {
        $merchantCode = env('TRIPAY_MERCHANT_CODE','');
        $merchantRef  = $data['merchant_ref'];
        $amount       = $data['amount'];

        $signature    = $this->createSignature($merchantCode.$merchantRef.$amount);
        $data['signature'] = $signature;

        
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_FRESH_CONNECT  => true,
            CURLOPT_URL            => $this->apiUrl . 'transaction/create',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER         => false,
            CURLOPT_HTTPHEADER     => ['Authorization: Bearer '.$this->apiKey],
            CURLOPT_FAILONERROR    => false,
            CURLOPT_POST           => true,
            CURLOPT_POSTFIELDS     => http_build_query($data),
            CURLOPT_IPRESOLVE      => CURL_IPRESOLVE_V4
        ]);

        $response = curl_exec($curl);
        $error = curl_error($curl);

        curl_close($curl);

        if(empty($error))
        {
            return json_decode($response);
        }

        return json_decode($error);
    }

}