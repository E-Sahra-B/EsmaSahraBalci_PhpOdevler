<?php
//error_reporting(0);
include("../ayar.php");
include_once("class.php");
$sorgu = $baglan->query("select * from todo", PDO::FETCH_ASSOC);
if ($_POST) {
    $sorgu = $baglan->prepare("insert into todo values(?,?,?,?)");
    $kontrol = new kontroller();
    $baslik = $kontrol->guvenlik($_POST["baslik"]);
    $aciklama = $kontrol->guvenlik($_POST["aciklama"]);
    $tarih = date('Y-m-d', strtotime($_POST['tarih']));
    $ekle = $sorgu->execute(array(NULL, $baslik, $aciklama, $tarih));
    $toplam = $sorgu->rowCount();
    if ($toplam > 0) {
        print '<div class="alert alert-success">NOT KAYIT YAPILDI</div>';
        header("Refresh: 2; url=notlar.php");
    } else {
        print '<div class="alert alert-danger">HATA: NOT KAYIT YAPILAMADI !</div>';
        header("refresh:2", "notekle.php");
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
            ?>
            <form action="notekle.php" method="post">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group row"><label class="col-sm-2 col-form-label">Not Başlığı</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="baslik" placeholder="Başlık Giriniz.">
                                <small>Başlık 50 karakterden uzun olamaz</small>
                            </div>
                        </div>
                        <div class="form-group row"><label class="col-sm-2 col-form-label">Açıklama</label>
                            <div class="col-sm-10">
                                <div class="summernote">
                                    <textarea class="form-control" name="aciklama" id="exampleFormControlTextarea1" rows="5"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row"><label class="col-sm-2 col-form-label">Tarih</label>
                            <div class="col-sm-10">
                                <div class="input-group date">
                                    <input type="date" class="form-control" name="tarih" value="<?php echo date('d-m-Y'); ?>">
                                </div>
                            </div>
                        </div>
                        <div class="form-group row justify-content-between">
                            <div></div>
                            <div class="col-lg-10">
                                <input type="submit" class="btn btn-lg btn-primary btn-block" value="Kaydet">
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <?php
            include_once("footer.php");
            ?>
        </div>
    </div>
    <?php
    include_once("script.php");
    ?>
</body>

</html>