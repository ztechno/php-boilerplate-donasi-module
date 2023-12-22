<!doctype html>
<html lang="en" data-bs-theme="auto">
  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Donasi">
    <title>Donasi</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@docsearch/css@3">

    <link href="https://getbootstrap.com/docs/5.3/dist/css/bootstrap.min.css" rel="stylesheet">

        <!-- Favicons -->
    <link rel="manifest" href="https://getbootstrap.com/docs/5.3/assets/img/favicons/manifest.json">
    <meta name="theme-color" content="#712cf9">


    <style>
      .form-group {
        margin-bottom: 15px;
      }
    </style>
  </head>
  <body class="bg-body-tertiary">
    <nav class="navbar bg-primary fixed-top" data-bs-theme="dark">
        <div class="container">
            <div class="col-lg-7 col-md-6 mx-auto">
                <a class="navbar-brand" href="#">Donasi</a>
            </div>
        </div>
    </nav>
    
    <div class="container" style="padding-top:70px">
        <main>
            <div class="col-lg-7 col-md-6 mx-auto">
                <?php if ($success_msg) : ?>
                <div class="alert alert-success"><?= $success_msg ?></div>
                <?php endif ?>
                <form class="needs-validation" enctype="multipart/form-data" method="post">
                    <?= csrf_field() ?>
                    <div class="row g-3">
                        <div class="col-12">
                            <h4>Berdonasi sebagai donatur :</h4>
                        </div>
                        <div class="col-sm-6">
                            <input type="radio" class="btn-check" name="sebagai" id="individu-outlined" autocomplete="off" checked value="Individu">
                            <label class="btn btn-outline-success w-100" for="individu-outlined">Individu</label>
                        </div>

                        <div class="col-sm-6">
                            <input type="radio" class="btn-check" name="sebagai" id="perusahaan-outlined" autocomplete="off" value="Perusahaan">
                            <label class="btn btn-outline-success w-100" for="perusahaan-outlined">Perusahaan</label>
                        </div>

                        <div class="col-12">
                            <h4 class="m-0">Lengkapi Data Donatur</h4>
                            <p>Sesuai Peraturan KPU no.18 Tahun 2023</p>
                        </div>
                            
                        <div class="col-12 mt-0">
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
            </div>
            </div>
        </main>
    </div>
    <script src="https://getbootstrap.com/docs/5.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    function enableSubmit(el)
    {
        document.querySelector('#submit-btn').disabled = !el.checked
    }
    </script>
    </body>
</html>
