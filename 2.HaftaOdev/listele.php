<form action="index.php" method="post">
    <table>
        <tr>
            <th>Ürün Adı</th>
            <th>Ürün Fiyatı</th>
            <th>Adet</th>
        </tr>
        <?php
        foreach ($urunler as $urun) {
            $toplam = $urun["adet"] * $urun['urunFiyati']
        ?>
            <tr>
                <td>
                    <?php echo $urun['urunAdi']; ?>
                    <input type="hidden" name="<?php echo $urun['urunAdi']; ?>" value="<?php echo $urun['urunAdi']; ?>">
                </td>
                <td>
                    <?php echo $urun['urunFiyati']; ?> TL
                    <input type="hidden" name="<?php echo $urun['adet']; ?>" value="<?php echo $urun['urunFiyati']; ?>">
                </td>
                <td>
                    <input style="width: 40px;" type="number" name="<?php echo $toplam; ?>" min="0" value="<?php echo $urun['adet'];  ?>">
                </td>
            </tr>
        <?php }
        ?>
    </table>
    <br>
    <input type="submit" name="sepetEkle" value="Ürünü Sepete Ekle">
</form>