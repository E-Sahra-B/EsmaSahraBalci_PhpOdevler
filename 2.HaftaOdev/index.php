<?php
session_start();
require_once 'urunler.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EsmaSahraBalci_2.HaftaOdev</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php
    require_once 'listele.php';
    ?>
    <br><br><br>
    <h3>Sepetiniz :</h3>
    <br>
    <table>
        <tr>
            <th>Ürün Adı</th>
            <th>Adet</th>
            <th>Toplam</th>
        </tr>
        <!-- <?php
                foreach ($_POST as $key => $value) {
                ?>
            <tr>
                <td><?php echo $key['urunAdi']; ?></td>
                <td><?php echo $key['adet']; ?></td>
                <td><?php echo $key['toplam']; ?></td>
            </tr>
        <?php } ?>
        <tr>
            <td colspan="2"> Toplam</td>
            <td><?php echo $toplam += $_POST[$key]['toplam']; ?></td>
        </tr> -->
    </table>
    <?php
    //require_once 'sepet.php';
    var_dump($_POST);
    ?>
</body>

</html>