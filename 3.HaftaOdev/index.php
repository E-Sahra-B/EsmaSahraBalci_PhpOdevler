<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>3.HAftaOdev</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <form action="ekle.php" method="post" class="ortala">
        <strong>Adınız Soyadınız : </strong><br><input type="text" name="adSoyad" value="" size="30"><br><br>
        <strong>Telefon Numaranız : </strong><br><input type="text" name="telefon" value="" size="30"><br><br>
        <input type="hidden" name="id" value="">
        <input type="submit" value="Bilgileri Kaydet">
    </form>
    <br><br><br><br>
    <h3>Liste Sayfası :</h3>
    <?php
    require_once 'liste.php';
    ?>
</body>

</html>