<?php
@session_start();
@ob_start();
error_reporting(0);
include("../ayar.php");
if (isset($_POST)) {
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
            echo '<div class="alert alert-success">RESİM GÜNCELLEME YAPILDI</div>';
        } else {
            echo '<div class="alert alert-danger">HATA: RESİM GÜNCELLEME YAPILAMADI !</div>';
        }
    }
    if ($sifre != "" and $ySifre != "" and $ySifreTekrar != "") {
        if ($ySifre == $ySifreTekrar) {
            if ($satir["sifre"] == sha1(md5($sifre))) {
                $sorgu = $baglan->prepare("update kullanici set kullaniciAdi=?, sifre=? where id=?");
                $guncelle = $sorgu->execute(array($kullaniciAdi, sha1(md5($ySifre)), $id));
                if ($guncelle) {
                    echo '<div class="alert alert-success">ŞİFRE GÜNCELLEME YAPILDI</div>';
                } else {
                    echo '<div class="alert alert-danger">ŞİFRE GÜNCELLEME YAPALAMADI</div>';
                }
            } else {
                echo '<div class="alert alert-danger">Girmiş olduğunuz eski şifre hatalıdır.</div>';
            }
        } else {
            echo '<div class="alert alert-danger">Girmiş olduğunuz şifreler birbiri ile aynı değildir.</div>';
        }
    }
    if ($_POST["kullaniciAdi"] != $_SESSION['adSoyad']) {
        $sorgu = $baglan->prepare("update kullanici set kullaniciAdi=? where id=?");
        $guncelle = $sorgu->execute(array($kullaniciAdi, $id));
        if ($guncelle) {
            echo '<div class="alert alert-success">KULLANICI ADI GÜNCELLEME YAPILDI</div>';
        } else {
            echo '<div class="alert alert-danger">KULLANICI ADI GÜNCELLEME YAPILAMADI</div>';
        }
    }
}
