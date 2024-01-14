<?php

namespace Modules\Donasi\Libraries;

class Ipaymu
{
    private $va         = '';
    private $apiKey     = '';
    private $apiUrl     = '';

    /**
     * initiation private key form .env
     */
    public function __construct()
    {
        $this->va = env('IPAYMU_VA', '');
        $this->apiKey = env('IPAYMU_API_KEY', '');
        $this->apiUrl = env('IPAYMU_API_URL', '');
    }

    public function getPaymentMethod()
    {
        $body = [
            'account' => $this->va
        ];
        $timestamp = Date('YmdHis');
        $signature = $this->createSignature($body, 'GET');
        $ch = curl_init($this->apiUrl . 'payment-method-list');

        $headers = array(
            'Accept: application/json',
            'Content-Type: application/json',
            'va: ' . $this->va,
            'signature: ' . $signature,
            'timestamp: ' . $timestamp
        );

        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        $err = curl_error($ch);
        $ret = curl_exec($ch);
        curl_close($ch);

        if($err) {
            echo $err;
            die();
        } else {

            //Response
            return json_decode($ret);
        }
    }

    /**
     * create signature
     * doc : https://storage.googleapis.com/ipaymu-docs/ipaymu-api/iPaymu-signature-documentation-v2.pdf
     */
    private function createSignature($body, $method)
    {
        $jsonBody     = json_encode($body, JSON_UNESCAPED_SLASHES);
        $requestBody  = strtolower(hash('sha256', $jsonBody));
        $stringToSign = strtoupper($method) . ':' . $this->va . ':' . $requestBody . ':' . $this->apiKey;
        return hash_hmac('sha256', $stringToSign, $this->apiKey);
    }

    public function createTransaction($body)
    {
        $timestamp = Date('YmdHis');
        $signature = $this->createSignature($body, 'POST');
        $jsonBody  = json_encode($body, JSON_UNESCAPED_SLASHES);
        $ch = curl_init($this->apiUrl . 'payment/direct');

        $headers = array(
            'Accept: application/json',
            'Content-Type: application/json',
            'va: ' . $this->va,
            'signature: ' . $signature,
            'timestamp: ' . $timestamp
        );

        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        curl_setopt($ch, CURLOPT_POST, count($body));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonBody);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        $err = curl_error($ch);
        $ret = curl_exec($ch);
        curl_close($ch);

        if($err) {
            echo $err;
            die();
        } else {

            //Response
            return json_decode($ret);
        }
    }
}