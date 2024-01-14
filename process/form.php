<?php

use Core\Database;
use Core\Request;
use Core\Storage;
use Modules\Donasi\Libraries\Ipaymu;
use Modules\Donasi\Libraries\TriPay;

$success_msg = get_flash_msg('success');

if(Request::isMethod('POST'))
{
    // return Response::json($_POST, '');
    $data = $_POST;
    
    unset($data['_token']);
    unset($data['tos']);

    if(isset($data['metadata']))
    {
        $data['metadata'] = json_encode($data['metadata']);
    }

    $data['status'] = 'PENDING';
    $data['kode']   = strtotime('now') . '-' .rand(1000, 9999);

    $filePath = Storage::upload($_FILES['foto_ktp']);

    $data['foto_ktp'] = $filePath;

    $db = new Database;
    $donasi = $db->insert('donasi', $data);

    $message = "Data telah terkirim. Cek WA untuk informasi pembayaran";

    if(!in_array($donasi->metode_pembayaran, ['Transfer','Cash']))
    {
        try {
            //code...
            $transaction = createTransaction($donasi);

            // if($transaction['response']->Message == 'success')
            // {
                // $message .= " atau klik <a href='".$transaction['response']->Data->Url."'>link</a> berikut untuk melakukan pembayaran";
            // }
    
            $donasi = $db->update('donasi', [
                'payment_request' => json_encode($transaction['payload']),
                'payment_response' => json_encode($transaction['response'])
            ],[
                'id' => $donasi->id
            ]);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    sendNotifAfterSubmit($donasi);

    set_flash_msg(['success'=> $message]);

    header('location:'.routeTo('donasi/form'));
    die();
}

$day = hari_ini(date('D'));
$date = tgl_indo(date('Y-m-d'));
$ipaymu = new Ipaymu;
$channel = $ipaymu->getPaymentMethod();

return view('donasi/views/form', compact('success_msg','day', 'date','channel'));