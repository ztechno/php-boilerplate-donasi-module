<?php

use Core\Database;
use Modules\Donasi\Libraries\TriPay;

$db     = new Database;
$tripay = new TriPay;
$input  = file_get_contents('php://input');

$response = $tripay->doCallback($input, function($data) use ($db){
    $reference = $data->reference;
    $db->query = "SELECT * FROM donasi WHERE JSON_EXTRACT(payment_response, '$.reference')  = '$reference' AND `status` = 'PENDING'";
    $donasi    = $db->exec('single');
    if($donasi)
    {
        $db->update('donasi', [
            'status' => strtoupper($data->status == 'PAID' ? 'CONFIRM' : $data->status)
        ], [
            'id' => $donasi->id
        ]);

        if($data->status == 'PAID')
        {
            sendNotifConfirm($donasi);
        }

        return ['success' => true];
    }
    return ['success' => false, 'message' => 'Invoice not found or already paid'];
});

if(!$response['success'])
{
    http_response_code(400);
}

return json_encode($response);