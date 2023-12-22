<?php

use Core\Database;

$db = new Database;
$id = $_GET['id'];

$db->update('donasi',[
    'status' => 'CONFIRM'
], [
    'id' => $id
]);

$data = $db->single('donasi', [
    'id' => $id
]);

sendNotifConfirm($data);

set_flash_msg(['success'=>"Donasi berhasil dikonfirmasi"]);

header('location:'.routeTo('crud/index',['table' => 'donasi']));
die();