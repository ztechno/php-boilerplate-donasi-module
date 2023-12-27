<?php

use Core\Database;
use Spipu\Html2Pdf\Html2Pdf;
use Spipu\Html2Pdf\Exception\Html2PdfException;
use Spipu\Html2Pdf\Exception\ExceptionFormatter;

$db = new Database;
$id = $_GET['id'];

$data = $db->single('donasi',[
    'id' => $id
]);

$data->metadata = json_decode($data->metadata);
$day = hari_ini(date('D', strtotime($data->created_at)));
$date = tgl_indo(date('Y-m-d', strtotime($data->created_at)));

$html = view('donasi/views/pdf/individu', compact('data', 'day', 'date'));

try {
    $html2pdf = new Html2Pdf('P', 'A4', 'fr');
    $html2pdf->setDefaultFont('Arial');
    $html2pdf->writeHTML($html);
    $html2pdf->output($data->nama_lengkap.'.pdf');
} catch (Html2PdfException $e) {
    $html2pdf->clean();

    $formatter = new ExceptionFormatter($e);
    echo $formatter->getHtmlMessage();
}