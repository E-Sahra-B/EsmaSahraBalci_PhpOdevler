<?php
include("ayar.php");

$sorgu = $baglan->prepare("insert into ogrenciler values(?,?,?,?)");
$adSoyad = $_POST["adSoyad"];
$tc = "";
$telefon = $_POST["telefon"];
$ekle = $sorgu->execute(array(NULL, $adSoyad, $tc, $telefon));
$toplam = $sorgu->rowCount();
if ($toplam > 0) {
    header("Location:index.php");
} else {
    echo "Kayıt Eklenemedi";
}
