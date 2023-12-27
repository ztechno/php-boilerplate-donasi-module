<img src="assets/donasi/images/kop.jpg" alt="" style="width: 100%;">
<p>
    Pada hari <?=$day?> tanggal <?=$date?> yang bertanda tangan di bawah ini: <br><br>

    <div id="form-data-individu">
        <div><b>Nama Lengkap : </b> <?=$data->nama_lengkap?></div>
        <div><b>Jenis Kelamin : </b> <?=$data->jenis_kelamin?></div>
        <div><b>Tanggal Lahir : </b> <?=$data->tanggal_lahir?></div>
        <div><b>No. WA : </b> <?=$data->no_telepon?></div>
        <div><b>Email : </b> <?=$data->email?></div>
        <div><b>NIK : </b> <?=$data->NIK?></div>
        <div><b>NPWP : </b> <?=$data->NPWP?></div>
        <div><b>Asal Perolehan Dana : </b> <?=$data->asal_perolehan_dana?></div>
    </div>

    <br>
    Dengan ini menyatakan bahwa:<br>
    <ul>
        <li>
            Penyumbang tidak menunggak pajak
        </li>
        <li>
            Penyumbang tidak dinyatakan dalam keadaan penundaan kewajiban pembayaran utang atau dalam keadaan pailit berdasarkan putusan pengadilan yang telah memperoleh kekuatan hukum tetap
        </li>
        <li>
            Dana tidak berasal dari tindak pidana yang telah terbukti berdasarkan putusan pengadilan yang telah memperoleh kekuatan hukum tetap dan/atau bertujuan menyembunyikan atau menyamarkan hasil tindak pidana dan
        </li>
        <li>
            Sumbangan bersifat tidak mengikat.
        </li>
    </ul>
    
    Selanjutnya, saya lampirkan salinan KTP.<br><br>

    Demikian kami sampaikan semua informasi tersebut di atas dan saya buat dengan sebenar-benarnya agar dapat disampaikan kepada KPU.
</p>
<div class="canvas-container" style="text-align: center">
    <?php if($data->metadata?->signature): ?>
    <img src="<?=$data->metadata?->signature?>" alt=""><br>
    <?=$data->nama_lengkap?>
    <?php endif ?>
</div>