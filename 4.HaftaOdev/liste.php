<?php
require_once 'baglan.php';
$sorgu = $baglan->query("select * from tcKontrol", PDO::FETCH_ASSOC);
echo "<table border='1' width='100%'>
<tr align='center'>
<th>Id</th>
<th>Adı Soyadı</th>
<th>TC Kimlik Numarası</th>
<th>Durum</th>
</tr>";
foreach ($sorgu as $satir) {
    echo "
    <tr align='center'>
<td>" . $satir['id'] . "</td>
<td>" . $satir['adSoyad'] . "</td>
<td>" . $satir['tc'] . "</td>
<td>" . $satir['durum'] . "</td>

</tr>";
}
echo "</table>";
