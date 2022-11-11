<?php
session_start();
if (isset($_SESSION["oturum"]) && isset($_COOKIE["cerez"])) {
    if ($_SESSION["oturum"] != "var" && $_COOKIE["cerez"] != "var") {
        header("Location: index.php");
    }
} else {
    header("Location: index.php");
}
//error_reporting(0);
?>
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