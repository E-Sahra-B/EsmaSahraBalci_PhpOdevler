<?php
$problem = array(
    "agilSayisi" => 5,
    "agilKapasite" => 30,
    "toplamKoyun" => 900
);

$toplamKapasite = $problem["agilSayisi"] * $problem["agilKapasite"];
$artanKoyunSayisi = $problem["toplamKoyun"] - $toplamKapasite;
$kalanKoyun = $problem["toplamKoyun"];

echo "Ağıl Sayısı : " . $problem["agilSayisi"] . "<br>
Ağıl Kapasite : " . $problem["agilKapasite"] . "<br>
Toplam Kapasite : $toplamKapasite<br>
Koyun Sayısı : " . $problem["toplamKoyun"] . "<br><br>";


for ($i = $problem["agilSayisi"]; $i >= 1; $i--) {
    if ($kalanKoyun >= $problem["agilKapasite"]) {
        echo "$i . Ağıl : " . $problem["agilKapasite"] . " Koyun<br>";
    } else {
        if ($kalanKoyun >= 0) {
            echo "$i . Ağıl : $kalanKoyun Koyun<br>";
        } else {
            echo "$i . Ağıl : 0 Koyun <br>";
        }
    }
    $kalanKoyun = $kalanKoyun - $problem["agilKapasite"];
}
if ($artanKoyunSayisi > 0) {
    echo "<br>Dışarıda Kalan : $artanKoyunSayisi Koyun";
}
