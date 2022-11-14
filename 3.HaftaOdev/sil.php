<?php
$kayitNo = $_GET["id"];
include("ayar.php");
$sorgu = $baglan->prepare("delete from ogrenciler where id=?");
$sil = $sorgu->execute(array($kayitNo));
if ($sil) {
    echo "<script>
    alert('Kayıt Silindi');
    window.location.href='index.php';
    </script>";
} else {
    echo "Kayıt Silinemedi";
}
