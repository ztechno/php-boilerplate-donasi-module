<?php

use Core\Database;

$db = new Database;
$id = $_GET['id'];

$data = $db->single('donasi',[
    'id' => $id
]);

sendNotifAfterSubmit($data);

set_flash_msg(['success'=>"Notifikasi berhasil dikirim"]);

header('location:'.routeTo('crud/index',['table' => 'donasi']));
die();