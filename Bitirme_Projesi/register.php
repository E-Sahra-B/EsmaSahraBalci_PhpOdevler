<?php
session_start();
include("ayar.php");

if ($_POST) {
    $kullanici = $_POST["kullanici"];
    $sifre = sha1(md5($_POST["sifre"]));
    $sifreTekrar = sha1(md5($_POST["sifreTekrar"]));

    if (!$kullanici) {
        print '<div class="alert alert-danger">Lütfen Kullanıcı Adı Giriniz.</div>';
        header("refresh:2", "register.php");
    } else if (!$sifre || !$sifreTekrar) {
        print '<div class="alert alert-danger">Lütfen Kullanıcı Şifrenizi Giriniz.</div>';
        header("refresh:2", "register.php");
    } else if ($sifre != $sifreTekrar) {
        print '<div class="alert alert-danger">Girmiş olduğunuz şifreler birbiri ile aynı değildir.</div>';
        header("refresh:2", "register.php");
    } else {
        $password = password_hash($_POST["sifre"], PASSWORD_DEFAULT);
        $resim = "img/default.png";
        $sorgu = $baglan->prepare('insert into kullanici set kullaniciAdi=?, sifre=?, resim=?');
        $ekle = $sorgu->execute([
            $kullanici, $password, $resim
        ]);
        if ($ekle) {
            print '<div class="alert alert-success">KULLANICI KAYDI BAŞARILI</div>';
            header("refresh:2", "login.php");
        }
    }
}
?>
<!DOCTYPE html>
<html lang="tr">

<head>
    <?php
    include_once("head.php");
    ?>
</head>

<body>
    <header>
        <?php
        include_once("header.php");
        include_once("headerMenu.php");
        ?>
    </header>
    <section class="main-content-w3layouts-agileits">
        <div class="container">
            <h3 class="tittle">Kayıt Ol</h3>
            <div class="row inner-sec">
                <div class="login p-5 bg-light mx-auto mw-100">
                    <form action="register.php" method="post">
                        <div class="form-group">
                            <label for="exampleInputEmail1 mb-2">Kullanıcı Adı</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="kullanici" required="">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1 mb-2">Şifre</label>
                            <input type="password" class="form-control" id="exampleInputPassword1" name="sifre" required="">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1 mb-2">Şifre Tekrar</label>
                            <input type="password" class="form-control" id="exampleInputPassword1" name="sifreTekrar" required="">
                        </div>
                        <button type="submit" class="btn btn-primary submit mb-4">Kayıt Ol</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <?php
    include_once("footer.php");
    include_once("script.php");
    ?>
</body>

</html>