<?php
require_once 'inc/config.php';

$islem = $guvenlik->sanitize($_GET["islem"], 'string')->result();

if ($islem == "ekle") {
    $adet = $guvenlik->sanitize($_POST["adet"], 'integer')->result();
    $urun = $guvenlik->sanitize($_POST["urun"], 'integer')->result();
    $icerik = $baglan->select('urunler', ['no'])->where('durum', 'aktif', '=')->where('no', $urun, '=')->run();
    if ($icerik[0]["no"] == "") {
        header("Location:urunler.php");
        die();
    }
    $sepet->ekle($urun, $adet);
    header("Location:detay.php?no=$urun");
}

else if ($islem == "sil") {
    $urun = $guvenlik->sanitize($_GET["urun"], 'integer')->result();
    $icerik = $baglan->select('urunler', ['no'])->where('durum', 'aktif', '=')->where('no', $urun, '=')->run();
    if ($icerik[0]["no"] == "") {
        header("Location:sepet.php");
        die();
    }
    $sepet->sil($urun);
    header("Location:sepet.php");
}

else if ($islem == "temizle") {
    $sepet->temizle();
    header("Location:index.php");
}

else if ($islem == "kaydet") {
    $urunler = array();
    $sepet = $_SESSION["sepet"];
    $adsoyad = $guvenlik->sanitize($_POST["adsoyad"], 'string')->result();
    $email = $guvenlik->sanitize($_POST["email"], 'string')->result();
    $telefon = $guvenlik->sanitize($_POST["telefon"], 'string')->result();
    $adres = $guvenlik->sanitize($_POST["adres"], 'string')->result();
    foreach ($sepet as $urun => $adet) {
        $urunler[] = "$urun-$adet";
        $icerik = $baglan->select('urunler')->where('durum', 'aktif', '=')->where('no', $urun, '=')->run();
        $utoplam = $adet * $icerik[0]["fiyat"];
        $atoplam += $utoplam;
    }
    $gtoplam = $atoplam * 1.18;
    $ktoplam = $gtoplam - $atoplam;
    $urunler = implode(',', $urunler);

    $veriler = [
        'adsoyad' => $adsoyad,
        'email' => $email,
        'telefon' => $telefon,
        'adres' => $adres,
        'kod' => rand(11111,99999),
        'urunler' => $urunler,
        'aratoplam' => $atoplam,
        'kdvtoplam' => $ktoplam,
        'gentoplam' => $gtoplam,
        'tarih' => date("Y-m-d H:i:s"),
        'durum' => 'aktif'
    ];
    
    $ekle = $baglan->insert("siparisler", $veriler)->run();
    if ($ekle) {
        echo "<script>
        alert('Siparişiniz Kaydedildi, Teşekkür Ederiz!');
        window.location.href='kontrol.php?islem=temizle';
        </script>";
    }
}

else {
    header("Location:urunler.php");
}
?>