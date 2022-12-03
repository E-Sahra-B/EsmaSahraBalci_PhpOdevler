<?php
error_reporting(0);
include("../ayar.php");
$sorgu = $baglan->query("select * from todo", PDO::FETCH_ASSOC);

$kayitNo = $_GET["id"];
if ($_GET) {
    $islem = $_GET["islem"];

    $sorgu = $baglan->prepare("delete from todo where id=?");
    $sil = $sorgu->execute(array($kayitNo));
    if ($islem == "sil") {
        print '<div class="alert alert-success">NOT SİLİNDİ</div>';
        header("Refresh: 2; url=index.php");
    } else {
        print '<div class="alert alert-danger">HATA: KAYIT YAPILAMADI !</div>';
        header("Refresh: 2; url=index.php");
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Sayfası</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>

<body class="">
    <div id="wrapper">
        <?php
        include_once("headerMenu.php");
        ?>
        <div id="page-wrapper" class="gray-bg">
            <?php
            include_once("header.php");
            include_once("notlar.php");
            include_once("footer.php");
            ?>
        </div>
    </div>
    <?php
    include_once("script.php");
    ?>
</body>

</html>