<?php
session_start();
error_reporting(0);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>2.HaftaOdevMySqlVeriTabaniBaglanti</title>
    <link rel="stylesheet" href="css.css">
</head>

<body>
    <h3 style="text-align:center">ÜRÜN SATIN AL</h3>
    <?php
    $baglan = new PDO("mysql:host=localhost;dbname=deneme", "Sahra", "1234");
    $baglan->query("set charset set utf8");
    $baglan->exec("set names utf8");
    $baglan->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sorgu = $baglan->query("select * from sepet", PDO::FETCH_ASSOC);

    echo "<table width='100%' border='1'>
    <tr>
        <th width='60%'>Ürün Açıklama</th>
        <th width='20%'>Fiyat</th>
        <th width='20%'>Adet</th>
    </tr>";

    foreach ($sorgu as $urun) {
        echo "<tr>
        <td>$urun[urunAdi]</td>
        <td>$urun[fiyat] ₺</td>
        <td>
            <form action='islem.php?hareket=ekle' method='post'>
                <input type='text' name='adet' required>
                <input type='hidden' name='urun' value='$urun[id]'>
                <input type='submit' value='Ekle'>
            </form>
        </td>
        </tr>";
    }
    echo "</table>";

    $sepetsay = count($_SESSION["sepet"]);
    echo "<br><br><h3 style='text-align:center'>SEPET İÇERİĞİ ($sepetsay)</h3>";
    if ($sepetsay > 0) {
        echo "<table width='100%' border='1'>
        <tr>
            <th width='45%'>Ürün Açıklama</th>
            <th width='15%'>Fiyat</th>
            <th width='15%'>Adet</th>
            <th width='15%'>Toplam</th>
            <th width='10%'>Sil</th>
        </tr>";
        $sepettoplam = 0;
        foreach ($_SESSION["sepet"] as $id => $urunadet) {
            $urunsira = $baglan->query("select * from sepet where id=$id")->fetch(PDO::FETCH_ASSOC);
            $urunad = $urunsira["urunAdi"];
            $urunfiyat = $urunsira["fiyat"];
            $uruntoplam = $urunadet * $urunfiyat;
            $sepettoplam += $uruntoplam;
            echo "<tr>
                <td>$urunad</td>
                <td>$urunfiyat ₺</td>
                <td>$urunadet</td>
                <td>$uruntoplam ₺</td>
                <td><a href='islem.php?hareket=sil&id=$id' onclick=\"if (!confirm('Ürünü Silmek İstediğinize Emin misiniz?')) return false;\">Sil</a></td>
                </tr>";
        }
        echo "</table>
            <p style='text-align:right'>
                <a href='islem.php?hareket=bosalt' onclick=\"if (!confirm('Sepetteki Tüm Ürünleri Silmek İstediğinize Emin misiniz?')) return false;\">Sepeti Boşalt</a>
            </p>
            <h4 style='text-align:right'>Sepet Toplamı: $sepettoplam ₺</h4>";
    } else {
        echo "<h5 style='text-align:center'>SEPET İÇERİĞİ BOŞ!</h5>";
    }
    ?>
</body>

</html>