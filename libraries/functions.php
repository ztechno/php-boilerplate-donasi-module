<?php

\Core\Request::addPublicRoute('donasi/form');
\Core\Request::addPublicRoute('donasi/pdf');

function getProvince()
{
    return json_decode('[{"id":"11","name":"ACEH"},{"id":"12","name":"SUMATERA UTARA"},{"id":"13","name":"SUMATERA BARAT"},{"id":"14","name":"RIAU"},{"id":"15","name":"JAMBI"},{"id":"16","name":"SUMATERA SELATAN"},{"id":"17","name":"BENGKULU"},{"id":"18","name":"LAMPUNG"},{"id":"19","name":"KEPULAUAN BANGKA BELITUNG"},{"id":"21","name":"KEPULAUAN RIAU"},{"id":"31","name":"DKI JAKARTA"},{"id":"32","name":"JAWA BARAT"},{"id":"33","name":"JAWA TENGAH"},{"id":"34","name":"DI YOGYAKARTA"},{"id":"35","name":"JAWA TIMUR"},{"id":"36","name":"BANTEN"},{"id":"51","name":"BALI"},{"id":"52","name":"NUSA TENGGARA BARAT"},{"id":"53","name":"NUSA TENGGARA TIMUR"},{"id":"61","name":"KALIMANTAN BARAT"},{"id":"62","name":"KALIMANTAN TENGAH"},{"id":"63","name":"KALIMANTAN SELATAN"},{"id":"64","name":"KALIMANTAN TIMUR"},{"id":"65","name":"KALIMANTAN UTARA"},{"id":"71","name":"SULAWESI UTARA"},{"id":"72","name":"SULAWESI TENGAH"},{"id":"73","name":"SULAWESI SELATAN"},{"id":"74","name":"SULAWESI TENGGARA"},{"id":"75","name":"GORONTALO"},{"id":"76","name":"SULAWESI BARAT"},{"id":"81","name":"MALUKU"},{"id":"82","name":"MALUKU UTARA"},{"id":"91","name":"PAPUA BARAT"},{"id":"94","name":"PAPUA"}]');
}

function sendNotifAfterSubmit($data)
{
    $message = "Halo *[Nama]*,

Terima kasih atas kontribusimu dalam mendukung Lurus Dalane. Berikut adalah rincian tagihan donasi yang harus dibayarkan:

Jumlah Tagihan: Rp. *[Jumlah Tagihan]*
Nomor Tagihan: *[Nomor Tagihan]*
Metode : Transfer ke

BANK MANDIRI - SENAYAN
a.n. SONI FAHRURI
no.rekening: 12200-310379-58

BNI-KAMPUNG AMBON - Jakarta
a.n. SONI FAHRURI
No.rek.: 3103197953

Lakukan konfirmasi dengan mereplay WA ini.

Terima kasih atas perhatian dan dukunganmu. Semoga Allah membalas kebaikanmu.";

    $message = str_replace("[Nama]", $data->nama_lengkap, $message);
    $message = str_replace("[Jumlah Tagihan]", number_format($data->jumlah_donasi), $message);
    $message = str_replace("[Nomor Tagihan]", $data->kode, $message);

    sendWa(62 . $data->no_telepon, $message);
}

function sendNotifConfirm($data)
{
    $message = "Halo *[Nama]*,

Terima kasih atas konfirmasi pembayaranmu untuk tagihan donasi [Nomor Tagihan] sebesar Rp. *[Jumlah Pembayaran]*. Kami sangat menghargai dukungan dan kepercayaanmu.

Semoga Allah membalas kebaikanmu dengan berlipat ganda.

Jangan ragu untuk menghubungi kami jika ada pertanyaan lebih lanjut atau jika kamu membutuhkan informasi tambahan. Terus dukung kami dalam menyebarkan kebaikan.

Salam hangat,

_Tim Lurus Dalane_

".routeTo('donasi/pdf', ['id' => $data->id]);

    $message = str_replace("[Nama]", $data->nama_lengkap, $message);
    $message = str_replace("[Jumlah Pembayaran]", number_format($data->jumlah_donasi), $message);
    $message = str_replace("[Nomor Tagihan]", $data->kode, $message);

    sendWa(62 . $data->no_telepon, $message);
}

function sendWa($to, $message)
{
    try {
        $data = [
            'api_key' => env('WA_API_KEY'),
            'sender'  => env('WA_SENDER_NUMBER'),
            'number'  => $to,
            'message' => $message
        ];
        
        $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://wa2.sonifahruri.com/app/api/send-message",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_POSTFIELDS => json_encode($data))
        );
        
        curl_exec($curl);
        
        curl_close($curl);
    } catch (\Throwable $th) {
        // throw $th;
    }
}

function hari_ini($hari = false){
	$hari = $hari ?? date ("D");
 
	switch($hari){
		case 'Sun':
			$hari_ini = "Minggu";
		break;
 
		case 'Mon':			
			$hari_ini = "Senin";
		break;
 
		case 'Tue':
			$hari_ini = "Selasa";
		break;
 
		case 'Wed':
			$hari_ini = "Rabu";
		break;
 
		case 'Thu':
			$hari_ini = "Kamis";
		break;
 
		case 'Fri':
			$hari_ini = "Jumat";
		break;
 
		case 'Sat':
			$hari_ini = "Sabtu";
		break;
		
		default:
			$hari_ini = "Tidak di ketahui";		
		break;
	}
 
	return $hari_ini;
 
}

function tgl_indo($tanggal){
	$bulan = array (
		1 =>   'Januari',
		'Februari',
		'Maret',
		'April',
		'Mei',
		'Juni',
		'Juli',
		'Agustus',
		'September',
		'Oktober',
		'November',
		'Desember'
	);
	$pecahkan = explode('-', $tanggal);
	
	return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
}