<?php

use Core\Database;
use Core\Request;

$db   = new Database;

if(Request::isMethod('POST'))
{
    if($_POST['status_code'] && $_POST['status'] == 'berhasil')
    {
        $data = $db->single('donasi',[
            'kode' => $_POST['reference_id'],
            'status' => 'PENDING'
        ]);

        if($data)
        {
            $db->update('donasi',[
                'status' => 'CONFIRM',
                'updated_at' => date('Y-m-d H:i:s'),
            ],[
                'kode' => $_POST['reference_id']
            ]);
    
            sendNotifConfirm($data);
    
            echo json_encode([
                'message' => 'success',
            ]);
        }
    
        die();
    }
}