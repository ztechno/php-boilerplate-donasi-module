<!-- Modal -->
<div class="modal fade" id="modalPerusahaan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Pernyataan harus dimengerti dan ditandatangani oleh donatur</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>
                    Pada hari <?=$day?> tanggal <?=$date?> yang bertanda tangan di bawah ini:

                    <div id="form-data-perusahaan">
                        <div><b>Nama Perusahaan/Badan Usaha : </b> <span class="perusahaan-nama-perusahaan"></span></div>
                        <div><b>Nomor Akta Pendirian Perusahaan : </b> <span class="perusahaan-no-akta"></span></div>
                        <div><b>NPWP Perusahaan : </b> <span class="perusahaan-npwp"></span></div>
                        <div><b>No. Telepon Perusahaan : </b> <span class="perusahaan-no-telepon"></span></div>
                        <div><b>Email : </b> <span class="perusahaan-email"></span></div>
                        <div><b>Keterangan Status : </b> <span class="perusahaan-keterangan-status"></span></div>
                        <div><b>Asal Perolehan Dana : </b> <span class="perusahaan-asal-dana"></span></div>
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

                    Demikian kami sampaikan semua informasi tersebut di atas dan kami buat dengan sebenar-benarnya agar dapat disampaikan kepada KPU.
                </p>
                <div class="canvas-container">
                    <canvas id="canvas2"></canvas>
                    <p class="text-center">Tanda Tangan Disini</p>
                    
                </div>
                <div class="text-center">
                    <button class="btn btn-warning" onclick="saveSignature('#sign-perusahaan', form_perusahaan)">SETUJU</button>
                    <button class="btn btn-danger" onclick="resetSignature('#sign-perusahaan')">RESET TANDA TANGAN</button>
                </div>
            </div>
        </div>
    </div>
</div>

<form enctype="multipart/form-data" method="post" name="form_perusahaan" style="display: none;">
    <?= csrf_field() ?>
    <input type="hidden" name="sebagai" value="Perusahaan">
    <div class="row g-3">
        <div class="col-12">
            <h5>1. Informasi perusahaan atau badan usaha</h5>

            <div class="form-group">
                <label for="nama_lengkap" class="form-label">Nama Perusahaan/Badan Usaha</label>
                <input type="text" class="form-control" name="nama_lengkap" id="nama_lengkap" placeholder="Nama Perusahaan/Badan Usaha" required data-watch=".perusahaan-nama-perusahaan">
            </div>

            <div class="form-group">
                <label for="akta" class="form-label">Nomor Akta Pendirian Perusahaan</label>
                <input type="text" class="form-control" id="akta" name="NIK" placeholder="Nomor Akta Pendirian Perusahaan" required data-watch=".perusahaan-no-akta">
            </div>

            <div class="form-group">
                <label for="NPWP" class="form-label">NPWP Perusahaan/Badan Usaha</label>
                <input type="text" class="form-control" id="NPWP" name="NPWP" placeholder="NPWP Perusahaan/Badan Usaha" required data-watch=".perusahaan-npwp">
            </div>

            <div class="form-group">
                <label for="no_telepon" class="form-label">No. Telepon Perusahaan</label>
                <input type="text" id="no_telepon" name="metadata[no_telepon]" class="form-control" placeholder="No. Telepon Perusahaan" data-watch=".perusahaan-no-telepon">
            </div>

            <div class="form-group">
                <label for="email" class="form-label">E-mail (opsional)</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="E-mail" data-watch=".perusahaan-email">
            </div>
            
            <div class="form-group">
                <label for="keterangan_status" class="form-label">Keterangan Status Perusahaan</label>
                <select class="form-select" name="metadata[keterangan_status]" id="keterangan_status" required data-watch=".perusahaan-keterangan-status">
                    <option>PT</option>
                    <option>CV</option>
                    <option>YAYASAN</option>
                    <option>FIRMA</option>
                    <option>KOPERASI</option>
                </select>
            </div>

            <div class="form-group">
                <label for="asal_perolehan_dana" class="form-label">Asal Perolehan Dana</label>
                <select class="form-select" id="asal_perolehan_dana" name="asal_perolehan_dana" required data-watch=".perusahaan-asal-dana">
                    <option value="">Choose...</option>
                    <option>Penghasilan sendiri</option>
                    <option>Hibah</option>
                    <option>Warisan</option>
                    <option>Hasil penjualan harta kekayaan</option>
                </select>
            </div>

            <div class="form-group">
                <label for="salinan_akta" class="form-label">Salinan Akta</label>
                <input type="file" class="form-control" id="salinan_akta" name="foto_ktp" placeholder="Salinan Akta" required>
            </div>
            
        </div>

        <div class="col-12">
            <h5>2. Informasi Direksi atau pimpinan perusahaan</h5>

            <div class="form-group">
                <label for="nama_direksi" class="form-label">Nama Direksi/Pimpinan Perusahaan</label>
                <input type="text" class="form-control" name="metadata[nama_direksi]" id="nama_direksi" placeholder="Nama Direksi/Pimpinan Perusahaan" required>
            </div>
            
            <div class="form-group">
                <label for="no_telepon_direksi" class="form-label">No. WA Direksi/Pimpinan</label>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">62</span>
                    <input type="text" id="no_telepon_direksi" name="no_telepon" class="form-control" placeholder="8xxxx">
                </div>
            </div>

            <div class="form-group">
                <label for="alamat_direksi">Alamat Direksi</label>
                <textarea name="metadata[alamat_direksi]" id="alamat_direksi" cols="30" rows="5" class="form-control" required></textarea>
            </div>
        </div>
        
        <div class="col-12">
            <h5>3. Informasi Pemegang saham mayoritas</h5>

            <div class="form-group">
                <label for="nama_pemegang_saham" class="form-label">Nama Pemegang Saham Mayoritas</label>
                <input type="text" class="form-control" name="metadata[nama_pemegang_saham]" id="nama_pemegang_saham" placeholder="Nama Pemegang Saham Mayoritas" required>
            </div>

            <div class="form-group">
                <label for="alamat_pemegang_saham">Alamat Pemegang Saham</label>
                <textarea name="metadata[alamat_pemegang_saham]" id="alamat_pemegang_saham" cols="30" rows="5" class="form-control" required></textarea>
            </div>
        </div>

        <div class="col-12">
            <h5>4. Informasi alamat perusahaan atau badan usaha</h5>

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
                <label for="alamat">Alamat</label>
                <textarea name="alamat" id="alamat" cols="30" rows="5" class="form-control" required></textarea>
            </div>
        </div>

        <div class="col-12">
            <h5>5. Informasi Pembayaran</h5>

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
                    <option>Transfer</option>
                    <option>Cash</option>
                    <?php foreach($channel->data as $paymentMethod): ?>
                    <option value="<?=$paymentMethod->code?>">(<?=$paymentMethod->group?>) <?=$paymentMethod->name?></option>
                    <?php endforeach ?>
                </select>
            </div>
        </div>
    </div>

    <div class="form-group">
        <label for="tos-2" class="mb-3">
            <input type="checkbox" name="tos" id="tos-2" onchange="showModal(this, '#modalPerusahaan')">
            Dengan ini, saya setuju untuk memenuhi aturan donasi yang berlaku
        </label>
        <input type="hidden" name="metadata[signature]" id="sign-perusahaan">
    </div>
</form>