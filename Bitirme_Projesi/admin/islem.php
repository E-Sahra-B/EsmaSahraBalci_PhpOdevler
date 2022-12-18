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
