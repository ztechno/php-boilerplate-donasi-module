<?php

use Core\Database;
use Core\Request;
use Core\Storage;

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

    sendNotifAfterSubmit($donasi);

    set_flash_msg(['success'=>"Data telah terkirim. Cek WA untuk informasi pembayaran"]);

    header('location:'.routeTo('donasi/form'));
    die();
}

$day = hari_ini();
$date = tgl_indo(date('Y-m-d'));
return view('donasi/views/form', compact('success_msg','day', 'date'));