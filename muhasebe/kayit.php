<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Muhasebe Kayıt</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="index2.html"><b>Muhasebe </b>ESB</a>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <?php if (@$_GET['durum'] == "no") { ?>
                    <p style="color:red" class="login-box-msg">Lütfen yönetici ile iletişime geçin</p>
                <?php } elseif (@$_GET['durum'] == "kvar") { ?>
                    <p style="color:red" class="login-box-msg">Bu kullanıcı sistemde kayıtlı</p>
                <?php } else { ?>
                    <p class="login-box-msg">Lütfen bilgileri eksiksiz ve doğru girin</p>
                <?php } ?>
                <form action="islem.php" method="post">
                    <div class="input-group mb-3">
                        <input required="" name="email" type="email" class="form-control" placeholder="Email giriniz.">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input required="" name="sifre" type="password" class="form-control" placeholder="Şifre giriniz.">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input required="" name="firmaismi" type="text" class="form-control" placeholder="Firma ismini giriniz..">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input required="" name="yetkili" type="text" class="form-control" placeholder="Firma yetkili giriniz.">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <button name="kullanicikaydet" type="submit" class="btn btn-primary btn-block">Kayıt Ol</button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.min.js"></script>
</body>

</html>