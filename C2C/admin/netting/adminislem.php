<?php
ob_start();
session_start();
require_once 'baglan.php';
include '../production/fonksiyon.php';

if (isset($_POST['logoduzenle'])) {
    if ($_FILES['ayar_logo']['size'] > 1048576) {
        echo "Bu dosya boyutu çok büyük";
        Header("Location:../production/genel-ayar.php?durum=dosyabuyuk");
    }
    $izinli_uzantilar = array('jpg', 'png');
    $ext = strtolower(substr($_FILES['ayar_logo']["name"], strpos($_FILES['ayar_logo']["name"], '.') + 1));
    if (in_array($ext, $izinli_uzantilar) === false) {
        echo "Bu uzantı kabul edilmiyor";
        Header("Location:../production/genel-ayar.php?durum=formathata");
        exit;
    }
    $uploads_dir = '../../dimg';
    @$tmp_name = $_FILES['ayar_logo']["tmp_name"];
    @$name = $_FILES['ayar_logo']["name"];
    $benzersizsayi4 = rand(20000, 32000);
    $refimgyol = substr($uploads_dir, 6) . "/" . $benzersizsayi4 . $name;
    @move_uploaded_file($tmp_name, "$uploads_dir/$benzersizsayi4$name");
    $duzenle = $db->prepare("UPDATE ayar SET
		ayar_logo=:logo
		WHERE ayar_id=0");
    $update = $duzenle->execute(array(
        'logo' => $refimgyol
    ));
    if ($update) {
        $resimsilunlink = $_POST['eski_yol'];
        unlink("../../$resimsilunlink");
        Header("Location:../production/genel-ayar.php?durum=ok");
    } else {
        Header("Location:../production/genel-ayar.php?durum=no");
    }
}

if (isset($_POST['adminkullaniciduzenle'])) {
    $kullanici_id = $_POST['kullanici_id'];
    $kullaniciguncelle = $db->prepare("UPDATE kullanici SET
		kullanici_ad=:kullanici_ad,
		kullanici_soyad=:kullanici_soyad,
		kullanici_gsm=:kullanici_gsm,
		kullanici_tc=:kullanici_tc,
		kullanici_adres=:kullanici_adres,
		kullanici_il=:kullanici_il,
		kullanici_ilce=:kullanici_ilce,
		kullanici_durum=:kullanici_durum
		WHERE kullanici_id={$_POST['kullanici_id']}");
    $update = $kullaniciguncelle->execute(array(
        'kullanici_ad' => htmlspecialchars($_POST['kullanici_ad']),
        'kullanici_soyad' => htmlspecialchars($_POST['kullanici_soyad']),
        'kullanici_gsm' => htmlspecialchars($_POST['kullanici_gsm']),
        'kullanici_tc' => htmlspecialchars($_POST['kullanici_tc']),
        'kullanici_adres' => htmlspecialchars($_POST['kullanici_adres']),
        'kullanici_il' => htmlspecialchars($_POST['kullanici_il']),
        'kullanici_ilce' => htmlspecialchars($_POST['kullanici_ilce']),
        'kullanici_durum' => htmlspecialchars($_POST['kullanici_durum'])
    ));
    if ($update) {
        Header("Location:../production/kullanici-duzenle.php?durum=ok&kullanici_id=$kullanici_id");
    } else {
        Header("Location:../production/kullanici-duzenle.php?durum=no&kullanici_id=$kullanici_id");
    }
}
