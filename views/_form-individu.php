<!-- Modal -->
<div class="modal fade" id="modalIndividu" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Pernyataan harus dimengerti dan ditandatangani oleh donatur</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>
                    Pada hari <?=$day?> tanggal <?=$date?> yang bertanda tangan di bawah ini:

                    <div id="form-data-individu">
                        <div><b>Nama Lengkap : </b> <span class="individu-nama-lengkap"></span></div>
                        <div><b>Jenis Kelamin : </b> <span class="individu-jenis-kelamin">Laki-laki</span></div>
                        <div><b>Tanggal Lahir : </b> <span class="individu-tanggal-lahir"></span></div>
                        <div><b>No. WA : </b> <span class="individu-no-wa"></span></div>
                        <div><b>Email : </b> <span class="individu-email"></span></div>
                        <div><b>NIK : </b> <span class="individu-nik"></span></div>
                        <div><b>NPWP : </b> <span class="individu-npwp"></span></div>
                        <div><b>Asal Perolehan Dana : </b> <span class="individu-asal-dana"></span></div>
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
                <div class="canvas-container">
                    <canvas id="canvas"></canvas>
                    <p class="text-center">Tanda Tangan Disini</p>
                </div>
                <div class="text-center">
                    <button class="btn btn-warning" onclick="saveSignature('#sign-individu', form_individu)">SETUJU</button>
                    <button class="btn btn-danger" onclick="resetSignature('#sign-individu')">RESET TANDA TANGAN</button>
                </div>
            </div>
        </div>
    </div>
</div>

<form enctype="multipart/form-data" method="post" name="form_individu">
    <?= csrf_field() ?>
    <input type="hidden" name="sebagai" value="Individu">
    <div class="row g-3">
        <div class="col-12">
            <h5>1. Informasi Pribadi</h5>

            <div class="form-group">
                <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                <input type="text" class="form-control" name="nama_lengkap" id="nama_lengkap" placeholder="Nama Lengkap" required data-watch=".individu-nama-lengkap">
            </div>
            
            <div class="form-group">
                <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                <select class="form-select" name="jenis_kelamin" id="jenis_kelamin" required data-watch=".individu-jenis-kelamin">
                    <option>Laki-laki</option>
                    <option>Perempuan</option>
                </select>
            </div>
            
            <div class="form-group">
                <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" placeholder="Tanggal Lahir" required data-watch=".individu-tanggal-lahir">
            </div>
            
            <div class="form-group">
                <label for="no_telepon" class="form-label">No. WA</label>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">62</span>
                    <input type="text" id="no_telepon" name="no_telepon" class="form-control" placeholder="No. WA" aria-label="No. WA" aria-describedby="basic-addon1" data-watch=".individu-no-wa">
                </div>
            </div>
            
            <div class="form-group">
                <label for="email" class="form-label">E-mail (opsional)</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="E-mail" data-watch=".individu-email">
            </div>
            
            <div class="form-group">
                <label for="foto_ktp" class="form-label">Foto KTP</label>
                <input type="file" class="form-control" id="foto_ktp" name="foto_ktp" placeholder="Foto KTP" required>
            </div>
            
            <div class="form-group">
                <label for="NIK" class="form-label">NIK</label>
                <input type="text" class="form-control" id="NIK" name="NIK" placeholder="NIK" required data-watch=".individu-nik">
            </div>
            
            <div class="form-group">
                <label for="NPWP" class="form-label">NPWP (opsional)</label>
                <input type="text" class="form-control" id="NPWP" name="NPWP" placeholder="NPWP" data-watch=".individu-npwp">
            </div>
            
            <div class="form-group">
                <label for="asal_perolehan_dana" class="form-label">Asal Perolehan Dana</label>
                <select class="form-select" id="asal_perolehan_dana" name="asal_perolehan_dana" required data-watch=".individu-asal-dana">
                    <option value="">Choose...</option>
                    <option>Penghasilan sendiri</option>
                    <option>Hibah</option>
                    <option>Warisan</option>
                    <option>Hasil penjualan harta kekayaan</option>
                </select>
            </div>
        </div>

        <div class="col-12">
            <h5>2. Informasi Alamat</h5>

            <div class="form-group">
                <label for="provinsi" class="form-label">Provinsi</label>
                <select class="form-select" id="provinsi" name="provinsi" required>
                    <option value="">Choose...</option>
                    <?php foreach(getProvince() as $province): ?>
                    <option><?=$province->name?></option>
                    <?php endforeach ?>
                </select>
            </div>

            <div class="form-group">
                <label for="alamat">Alamat Rumah</label>
                <textarea name="alamat" id="alamat" cols="30" rows="5" class="form-control" required></textarea>
            </div>
        </div>

        <div class="col-12">
            <h5>3. Informasi Pembayaran</h5>

            <div class="form-group">
                <label for="jumlah_donasi">Jumlah Donasi</label>
                <div class="input-group mb-2">
                    <div class="col-sm-3">
                        <button type="button" class="btn btn-outline-primary w-100" onclick="jumlah_donasi.value=20000">Rp. 20.000</button>
                    </div>
                    <div class="col-sm-3">
                        <button type="button" class="btn btn-outline-primary w-100" onclick="jumlah_donasi.value=50000">Rp. 50.000</button>
                    </div>
                    <div class="col-sm-3">
                        <button type="button" class="btn btn-outline-primary w-100" onclick="jumlah_donasi.value=100000">Rp. 100.000</button>
                    </div>
                    <div class="col-sm-3">
                        <button type="button" class="btn btn-outline-primary w-100" onclick="jumlah_donasi.value=200000">Rp. 200.000</button>
                    </div>
                </div>
                <input type="number" class="form-control" name="jumlah_donasi" id="jumlah_donasi">
            </div>

            <div class="form-group">
                <label for="metode_pembayaran" class="form-label">Metode Pembayaran</label>
                <select class="form-select" id="metode_pembayaran" name="metode_pembayaran" required>
                    <!-- <option>Transfer</option>
                    <option>Cash</option> -->
                    <?php foreach($channel->data as $paymentMethod): ?>
                    <option value="<?=$paymentMethod->code?>">(<?=$paymentMethod->group?>) <?=$paymentMethod->name?></option>
                    <?php endforeach ?>
                </select>
            </div>
        </div>
    </div>

    <div class="form-group">
        <label for="tos" class="mb-3">
            <input type="checkbox" name="tos" id="tos" onchange="showModal(this, '#modalIndividu')">
            Dengan ini, saya setuju untuk memenuhi aturan donasi yang berlaku
        </label>
        <input type="hidden" name="metadata[signature]" id="sign-individu">
    </div>
</form>