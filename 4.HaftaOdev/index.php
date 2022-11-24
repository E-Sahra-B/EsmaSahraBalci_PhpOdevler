<?php
require_once 'baglan.php';
include_once("kontrol.php");
error_reporting(0);
//https://tcnumarasi.com/tcuret
?>
<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>4.HaftaOdev</title>
    <link rel="stylesheet" href="araclar/css.css">
</head>

<body>
    <form action="ekle.php" method="post" class="ortala">
        <strong>Ad Soyad : </strong><br><input type="text" name="adSoyad" value="" size="30"><br><br>
        <strong>TC Kimlik Numaranız : </strong><br><input type="number" name="tc" value="" size="30"><br><br>
        <input type="hidden" name="id" value="">
        <input type="submit" name="kontrol" value="Doğrula Kaydet">
    </form>
    <br><br><br><br>
    <h3>Liste Sayfası :</h3>
    <?php
    require_once 'liste.php';
    ?>
</body>

</html>