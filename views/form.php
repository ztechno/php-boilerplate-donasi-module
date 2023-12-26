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
      body {
        background-color: #FFF !important;
      }
      .form-group {
        margin-bottom: 15px;
      }

      .navbar.bg-primary {
        background-color: #e5c20a !important;
      }

      .btn.btn-primary {
        background-color: #ffd701 !important;
        border-color: #ffd701 !important;
      }

      .btn-outline-primary {
        border-color: #ffd701 !important;
        color:#e5c20a !important;
        font-weight: bold;
      }

      .btn-check:checked+.btn, .btn:hover {
        background-color: #ffd701 !important;
        color: #FFF !important;
      }
    </style>
  </head>
  <body>
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
                <div class="row g-3">
                    <div class="col-12">
                        <h4>Berdonasi sebagai donatur :</h4>
                    </div>
                    <div class="col-sm-6">
                        <input type="radio" class="btn-check" name="sebagai" id="individu-outlined" autocomplete="off" checked value="Individu">
                        <label class="btn btn-outline-primary w-100" for="individu-outlined">Individu</label>
                    </div>

                    <div class="col-sm-6">
                        <input type="radio" class="btn-check" name="sebagai" id="perusahaan-outlined" autocomplete="off" value="Perusahaan">
                        <label class="btn btn-outline-primary w-100" for="perusahaan-outlined">Perusahaan</label>
                    </div>

                    <div class="col-12">
                        <h4 class="m-0">Lengkapi Data Donatur</h4>
                        <p>Sesuai Peraturan KPU no.18 Tahun 2023</p>
                    </div>
                </div>
                
                <?php require '_form-individu.php' ?>
                <?php require '_form-perusahaan.php' ?>
            </div>
        </main>
    </div>
    <script src="https://getbootstrap.com/docs/5.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    function enableSubmit(el, target = '#submit-btn')
    {
        document.querySelector(target).disabled = !el.checked
    }

    document.querySelectorAll('input[name="sebagai"]').forEach(el => {
        el.addEventListener('click', function(e) {
            document.querySelectorAll('form').forEach(form => form.style.display = 'none')
            const formName = 'form_'+el.value.toLowerCase()
            document.querySelector('form[name="'+formName+'"]').style.display = 'block'
        })
    });
    </script>
    </body>
</html>
