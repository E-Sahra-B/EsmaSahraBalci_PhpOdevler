<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Php 1.Hafta Ödev</title>
</head>

<body>
    <?php
    $agilSayisi = 5;
    $toplamKapasite = 150;
    $toplamKoyun = 90;
    $agilKapasite = $toplamKapasite / $agilSayisi;
    $artanKoyunSayisi = $toplamKoyun - $toplamKapasite;
    $modKoyunSayisi = $toplamKoyun % $agilKapasite;

    echo "Toplam Ağıl : $agilSayisi <br>";
    echo "Toplam Kapasite : $toplamKapasite <br>";
    echo "Toplam Koyun : $toplamKoyun<br><br>";

    if ($modKoyunSayisi == 0 && $toplamKoyun <= $toplamKapasite) { //eşit olma durumunda çalışacak
        for ($i = $toplamKoyun; $i >= 0; $i -= $agilKapasite) {
            if ($i >= $agilKapasite) { //bazı ağılların dolu olduğu durumunda çalışacak
                echo $agilSayisi-- . ". Ağıl : $agilKapasite Koyun <br>";
            } elseif ($i == $toplamKapasite) { //bütün ağılların tam dolu olduğu durumda çalışacak
                echo $agilSayisi-- . ". Ağıl : $agilKapasite Koyun <br>";
            }
        }
        while ($agilSayisi > 0) {
            echo $agilSayisi-- . ". Ağıl : 0 Koyun <br>"; // sıfır olan agıllar durumunda çalışacak
        }
    } elseif ($toplamKoyun <= $toplamKapasite) { //az olma durumunda çalışacak
        for ($i = $toplamKoyun; $i >= 0; $i -= $agilKapasite) {
            if ($i >= $agilKapasite) { //bazı ağılların dolu olduğu durumunda çalışacak
                echo $agilSayisi-- . ". Ağıl : $agilKapasite Koyun <br>";
            } elseif ($i >= 0) {
                echo $agilSayisi-- . ". Ağıl : $modKoyunSayisi Koyun <br>"; //bazı ağıllarda eksik koyun olma durumunda çalışacak
                while ($agilSayisi > 0) {
                    echo $agilSayisi-- . ". Ağıl : 0 Koyun <br>"; // sıfır olan agıllar durumunda çalışacak
                }
            }
        }
    } else { //Fazla olma durumda çalışacak
        for ($i = $agilSayisi; $i > 0; $i--) {
            echo "$i . Ağıl : $agilKapasite Koyun <br>";
        }
        echo "<br>Dışarıda Kalan : $artanKoyunSayisi Koyun";
    }
    ?>
</body>

</html>