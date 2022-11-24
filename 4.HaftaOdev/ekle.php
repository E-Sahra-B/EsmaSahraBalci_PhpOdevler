<?php
require_once 'baglan.php';
require_once 'kontrol.php';

$sorgu = $baglan->prepare("insert into tcKontrol values(?,?,?,?)");
$adSoyad = $_POST["adSoyad"];
$kontrol = new TcKontrol();
$tc = $_POST["tc"];

$durum = $kontrol->tcKontrol($_POST["tc"]);
$ekle = $sorgu->execute(array(NULL, $adSoyad, $tc, $durum));
$toplam = $sorgu->rowCount();
if ($toplam > 0) {
    header("Location:index.php");
} else {
    echo "Kayıt Eklenemedi";
}
