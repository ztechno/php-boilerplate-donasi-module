<?php

$button = "";

if($data->status == 'PENDING')
{
    $button = '<a href="'.routeTo('donasi/confirm', ['id' => $data->id]).'" class="btn btn-sm btn-primary" onclick="if(confirm(\'Apakah anda yakin mengkonfirmasi data ini ?\')){return true}else{return false}"><i class="fas fa-check"></i> Konfirmasi</a> ';
    $button .= '<a href="'.routeTo('donasi/resend', ['id' => $data->id]).'" class="btn btn-sm btn-primary" onclick="if(confirm(\'Apakah anda yakin mengirim ulang notifikasi ?\')){return true}else{return false}"><i class="fas fa-bell"></i> Resend</a> ';
}

return $button;