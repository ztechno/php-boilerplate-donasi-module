<form enctype="multipart/form-data" method="post" name="form_individu">
    <?= csrf_field() ?>
    <input type="hidden" name="sebagai" value="Individu">
    <div class="row g-3">
        <div class="col-12">
            <h5>1. Informasi Pribadi</h5>

            <div class="form-group">
                <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                <input type="text" class="form-control" name="nama_lengkap" id="nama_lengkap" placeholder="Nama Lengkap" required>
            </div>
            
            <div class="form-group">
                <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                <select class="form-select" name="jenis_kelamin" id="jenis_kelamin" required>
                    <option>Laki-laki</option>
                    <option>Perempuan</option>
                </select>
            </div>
            
            <div class="form-group">
                <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" placeholder="Tanggal Lahir" required>
            </div>
            
            <div class="form-group">
                <label for="no_telepon" class="form-label">No. WA</label>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">62</span>
                    <input type="text" id="no_telepon" name="no_telepon" class="form-control" placeholder="No. WA" aria-label="No. WA" aria-describedby="basic-addon1">
                </div>
            </div>
            
            <div class="form-group">
                <label for="email" class="form-label">E-mail (opsional)</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="E-mail">
            </div>
            
            <div class="form-group">
                <label for="foto_ktp" class="form-label">Foto KTP</label>
                <input type="file" class="form-control" id="foto_ktp" name="foto_ktp" placeholder="Foto KTP" required>
            </div>
            
            <div class="form-group">
                <label for="NIK" class="form-label">NIK</label>
                <input type="text" class="form-control" id="NIK" name="NIK" placeholder="NIK" required>
            </div>
            
            <div class="form-group">
                <label for="NPWP" class="form-label">NPWP (opsional)</label>
                <input type="text" class="form-control" id="NPWP" name="NPWP" placeholder="NPWP">
            </div>
            
            <div class="form-group">
                <label for="asal_perolehan_dana" class="form-label">Asal Perolehan Dana</label>
                <select class="form-select" id="asal_perolehan_dana" name="asal_perolehan_dana" required>
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
                    <option>Transfer</option>
                    <option>Cash</option>
                </select>
            </div>
        </div>
    </div>

    <div class="form-group">
        <label for="tos" class="mb-3">
            <input type="checkbox" name="tos" id="tos" onchange="enableSubmit(this)">
            Dengan ini, saya setuju untuk memenuhi aturan donasi yang berlaku
        </label>
        <button class="w-100 btn btn-primary btn-lg" id="submit-btn" type="submit" disabled>Donasi Sekarang</button>
    </div>
</form>