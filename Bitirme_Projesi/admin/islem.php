<?php
error_reporting(0);
$kayitNo = $_GET["id"];
$islem = $_GET["islem"];
include("../ayar.php");
$sorgu = $baglan->prepare("delete from menuler where id=?");
$sil = $sorgu->execute(array($kayitNo));
if ($islem == "sil") {
    print '<div class="alert alert-success">KAYIT SİLİNDİ</div>';
    header("Refresh: 2; url=menuliste.php");
} else {
    print '<div class="alert alert-danger">HATA: KAYIT YAPILAMADI !</div>';
    header("Refresh: 2; url=menuliste.php");
}

$kayitNo = $_POST["id"];

if ($_POST) {
    $sorgu = $baglan->prepare("insert into menuler values(?,?,?,?,?,?,?)");
    $kontrol = new kontroller();
    $menuAdi = $kontrol->guvenlik($_POST["menuadi"]);
    $menuLink = $_POST["menulink"];
    $resim = "img/" . $_FILES["resim"]["name"];
    move_uploaded_file($_FILES["resim"]["tmp_name"], $resim);
    $aciklama = $kontrol->guvenlik($_POST["aciklama"]);
    $tarih = date('Y-m-d');
    $ziyaret = "0";
    $ekle = $sorgu->execute(array(NULL, $menuAdi, $menuLink, $resim, $aciklama, $tarih, $ziyaret));
    $toplam = $sorgu->rowCount();
    if ($toplam > 0) {
        print '<div class="alert alert-success">KAYIT YAPILDI</div>';
        header("Refresh: 2; url=menuliste.php");
    } else {
        print '<div class="alert alert-danger">HATA: KAYIT YAPILAMADI !</div>';
        header("refresh:2", "menuekle.php");
    }
}
