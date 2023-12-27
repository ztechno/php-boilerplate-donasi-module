<img src="assets/donasi/images/kop.jpg" alt="" style="width: 100%;">
<p>
    Pada hari <?=$day?> tanggal <?=$date?> yang bertanda tangan di bawah ini: <br><br>

    <div id="form-data-perusahaan">
        <div><b>Nama Perusahaan/Badan Usaha : </b> <?=$data->nama_lengkap?></div>
        <div><b>Nomor Akta Pendirian Perusahaan : </b> <?=$data->NIK?></div>
        <div><b>NPWP Perusahaan : </b> <?=$data->NPWP?></div>
        <div><b>No. Telepon Perusahaan : </b> <?=$data->metadata->no_telepon?> </div>
        <div><b>Email : </b> <?=$data->email?></div>
        <div><b>Keterangan Status : </b> <?=$data->metadata->keterangan_status?></div>
        <div><b>Asal Perolehan Dana : </b> <?=$data->asal_perolehan_dana?></div>
    </div>

    <br>
    Dengan ini menyatakan bahwa:<br>
    <ul>
        <li>
            Kami tidak dalam keadaan menunggak pajak
        </li>
        <li>
            Kami tidak dinyatakan dalam keadaan penundaan kewajiban pembayaran utang atau dalam keadaan pailit berdasarkan putusan pengadilan yang telah memperoleh kekuatan hukum tetap
        </li>
        <li>
            Sumber dana tidak berasal dari tindak pidana yang telah terbukti berdasarkan putusan pengadilan yang telah memperoleh kekuatan hukum tetap dan/atau bertujuan menyembunyikan atau menyamarkan hasil tindak pidana dan
        </li>
        <li>
            Sumbangan bersifat tidak mengikat.
        </li>
    </ul>
    Selanjutnya, kami melampirkan salinan akta pendirian Perusahaan atau Badan Usaha.<br><br>

    Demikian kami sampaikan semua informasi tersebut di atas dan saya buat dengan sebenar-benarnya agar dapat disampaikan kepada KPU.
</p>
<div class="canvas-container" style="text-align: center">
    <?php if($data->metadata?->signature): ?>
    <img src="<?=$data->metadata?->signature?>" alt=""><br>
    <?=$data->nama_lengkap?>
    <?php endif ?>
</div>