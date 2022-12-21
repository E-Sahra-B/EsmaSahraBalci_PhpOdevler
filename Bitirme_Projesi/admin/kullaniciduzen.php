<?php
@session_start();
@ob_start();
error_reporting(0);
include("../ayar.php");
$cek = $baglan->prepare("SELECT * FROM kullanici WHERE kullaniciAdi =:kAdi");
$cek->execute(array('kAdi' => $_SESSION['adSoyad']));
$satir = $cek->fetch(PDO::FETCH_ASSOC);
extract($satir);
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kullanıcı Ayarları</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>

<body class="">
    <div id="sonuc"></div>
    <div id="wrapper">
        <?php
        include_once("headerMenu.php");
        ?>
        <div id="page-wrapper" class="gray-bg">
            <?php
            include_once("header.php");
            ?>
            <form id="ajaxForm" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group row"><label class="col-lg-2 col-form-label">Kullanıcı Adı</label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control" name="kullaniciAdi" value="<?= $kullaniciAdi ?>">
                            </div>
                        </div>
                        <div class="form-group row"><label class="col-lg-2 col-form-label">Eski Şifrenizi Giriniz</label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control" name="sifre">
                            </div>
                        </div>
                        <div class="form-group row"><label class="col-lg-2 col-form-label">Şifre Giriniz</label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control" name="ySifre">
                            </div>
                        </div>
                        <div class="form-group row"><label class="col-lg-2 col-form-label">Şifre Tekrar</label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control" name="ySifreTekrar">
                            </div>
                        </div>
                        <div class="form-group row"><label class="col-lg-2 col-form-label">Resim</label>
                            <div class="col-lg-10">
                                <img src="<?= $satir["resim"]; ?>" width="100" height="100%" name="resim2" value="<?= $resim ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="formFile" class="col-lg-2 col-form-label">Resim Güncelle</label>
                            <div class="col-lg-10">
                                <input class="form-control" type="file" name="resim" id="formFile" value="<?= $resim ?>">
                            </div>
                        </div>
                        <input type="hidden" name="id" value="<?= $id ?>">
                        <div class="form-group row justify-content-between">
                            <div></div>
                            <div class="col-lg-10">
                                <input type="button" id="ajaxButton" class="btn btn-lg btn-primary btn-block" value="Güncelle">
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <?php
            include_once("footer.php");
            ?>
        </div>
    </div>
    <?php
    include_once("script.php");
    ?>
    <script src="https://code.jquery.com/jquery-3.6.2.min.js" integrity="sha256-2krYZKh//PcchRtd+H+VyyQoZ/e3EcrkxhM8ycwASPA=" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            $("#ajaxButton").click(function() {
                $.ajax({
                    type: "POST",
                    url: "ajax.php",
                    data: $("#ajaxForm").serialize(),
                    success: function(cevap) {
                        $("#sonuc").fadeIn(1000);
                        $("#sonuc").html(cevap);
                        $("#sonuc").fadeOut(5000);
                    },
                    error: function(sonuc) {
                        $("#sonuc").fadeIn(1000);
                        $("#sonuc").html(sonuc);
                        $("#sonuc").fadeOut(5000);
                    }
                });
            });
        });
    </script>
</body>

</html>