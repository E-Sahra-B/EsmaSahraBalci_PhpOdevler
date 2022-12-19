<?php
@session_start();
@ob_start();
error_reporting(0);
include("../ayar.php");
if (isset($_POST["kullaniciduzen"])) {
    $id = $_POST["id"];
    $sorgu = $baglan->query("select * from kullanici where id=$id");
    $satir = $sorgu->fetch(PDO::FETCH_ASSOC);
    $kullaniciAdi = $_POST["kullaniciAdi"];
    $sifre = $_POST["sifre"];
    $ySifre = $_POST["ySifre"];
    $ySifreTekrar = $_POST["ySifreTekrar"];
    $resim = "img/" . $_FILES["resim"]["name"];
    $resim_tmp = $_FILES["resim"]["tmp_name"];
    if ($resim_tmp != "") {
        move_uploaded_file($resim_tmp, $resim);
        $sorgu = $baglan->prepare("update kullanici set kullaniciAdi=?, resim=? where id=?");
        $guncelle = $sorgu->execute(array($kullaniciAdi, $resim, $id));
        if ($guncelle) {
            print '<div class="alert alert-success">RESİM GÜNCELLEME YAPILDI</div>';
            header("Refresh: 2; url=kullaniciduzen.php");
        } else {
            print '<div class="alert alert-danger">HATA: RESİM GÜNCELLEME YAPILAMADI !</div>';
            header("refresh:2", "kullaniciduzen.php");
        }
    }
    if ($sifre != "" and $ySifre != "" and $ySifreTekrar != "") {
        if ($ySifre == $ySifreTekrar) {
            if ($satir["sifre"] == sha1(md5($sifre))) {
                $sorgu = $baglan->prepare("update kullanici set kullaniciAdi=?, sifre=? where id=?");
                $guncelle = $sorgu->execute(array($kullaniciAdi, sha1(md5($ySifre)), $id));
                if ($guncelle) {
                    print '<div class="alert alert-success">ŞİFRE GÜNCELLEME YAPILDI</div>';
                    header("Refresh: 2; url=kullaniciduzen.php");
                } else {

                    print '<div class="alert alert-danger">ŞİFRE GÜNCELLEME YAPALAMADI</div>';
                    header("Refresh: 2; url=kullaniciduzen.php");
                }
            } else {
                print '<div class="alert alert-danger">Girmiş olduğunuz eski şifre hatalıdır.</div>';
                header("refresh:2", "kullaniciduzen.php");
            }
        } else {
            print '<div class="alert alert-danger">Girmiş olduğunuz şifreler birbiri ile aynı değildir.</div>';
            header("refresh:2", "kullaniciduzen.php");
        }
    }
    if ($_POST["kullaniciAdi"] != $_SESSION['adSoyad']) {
        $sorgu = $baglan->prepare("update kullanici set kullaniciAdi=? where id=?");
        $guncelle = $sorgu->execute(array($kullaniciAdi, $id));
        if ($guncelle) {
            print '<div class="alert alert-success">KULLANICI ADI GÜNCELLEME YAPILDI</div>';
            header("Refresh: 2; url=kullaniciduzen.php");
        } else {
            print '<div class="alert alert-danger">KULLANICI ADI GÜNCELLEME YAPILAMADI</div>';
            header("Refresh: 2; url=kullaniciduzen.php");
        }
    }
} else {
    $cek = $baglan->prepare("SELECT * FROM kullanici WHERE kullaniciAdi =:kAdi");
    $cek->execute(array('kAdi' => $_SESSION['adSoyad']));
    $satir = $cek->fetch(PDO::FETCH_ASSOC);
    extract($satir);
}
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
    <div id="wrapper">
        <?php
        include_once("headerMenu.php");
        ?>
        <div id="page-wrapper" class="gray-bg">
            <?php
            include_once("header.php");
            ?>
            <form action="kullaniciduzen.php" method="post" enctype="multipart/form-data">
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
                                <input type="submit" name="kullaniciduzen" class="btn btn-lg btn-primary btn-block" value="Güncelle">
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
</body>

</html>