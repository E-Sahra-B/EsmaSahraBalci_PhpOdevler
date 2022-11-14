<?php
include("ayar.php");
$sorgu = $baglan->query("select * from ogrenciler", PDO::FETCH_ASSOC);
echo "<table border='1' width='100%'>
<tr align='center'>
<th>Adı Soyadı</th>
<th>Telefon Numarası</th>
<th>İşlem</th>
</tr>";
foreach ($sorgu as $satir) {
    echo "
    <tr align='center'>
<td>" . $satir['adSoyad'] . "</td>
<td>" . $satir['telefon'] . "</td>
<td>
<a href='sil.php?id=" . $satir['id'] . "'>Sil</a>
</td>
</tr>";
}
$toplam = $sorgu->rowCount();
echo "<tr><td class='ortala' colspan='3'>
Sistemde Toplam :<b> $toplam</b> Kayıt Bulunmaktadır.
</td>
</tr>
</table>";
