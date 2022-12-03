<?php
//error_reporting(0);
include("../ayar.php");
if (isset($_POST["blogKaydet"])) {
    $sorgu = $baglan->prepare("insert into bloglar values(?,?,?,?,?,?,?)");
    $resim = "img/" . $_FILES["resim"]["name"];
    move_uploaded_file($_FILES["resim"]["tmp_name"], $resim);
    $kontrol = new kontroller();
    $baslik = $kontrol->guvenlik($_POST["baslik"]);
    $icerik = $kontrol->guvenlik($_POST["icerik"]);
    $tarih = date('Y-m-d');
    $ziyaret = "0";
    $durum = $_POST["durum"];
    $ekle = $sorgu->execute(array(NULL, $resim, $baslik, $icerik, $tarih, $ziyaret, $durum));
    $toplam = $sorgu->rowCount();
    if ($toplam > 0) {
        print '<div class="alert alert-success">KAYIT YAPILDI</div>';
        header("Refresh: 2; url=blogliste.php");
    } else {
        print '<div class="alert alert-danger">HATA: KAYIT YAPILAMADI !</div>';
        header("refresh:2", "blogekle.php");
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
            <form action="blogekle.php" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group row">
                            <label for="formFile" class="col-sm-2 col-form-label">Resim Ekle</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="file" name="resim" id="formFile">
                            </div>
                        </div>
                        <div class="form-group row"><label class="col-sm-2 col-form-label">Blog Başlığı</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="baslik" placeholder="Blog Adı Giriniz">
                                <small>Blog adı 50 karakterden uzun olamaz</small>
                            </div>
                        </div>
                        <div class="form-group row"><label class="col-sm-2 col-form-label">İçerik</label>
                            <div class="col-sm-10">
                                <div class="summernote">
                                    <textarea class="form-control" name="icerik" id="exampleFormControlTextarea1" rows="5"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row"><label class="col-sm-2 col-form-label">Durum</label>
                            <div class="col-sm-10">
                                <select class="form-control" name="durum">
                                    <option value="1">Aktif</option>
                                    <option value="0">Pasif</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row"><label class="col-sm-2 col-form-label">Tarih</label>
                            <div class="col-sm-10">
                                <div class="input-group date">
                                    <input type="date" class="form-control" value="<?php echo date('d-m-Y'); ?>">
                                </div>
                            </div>
                        </div>
                        <div class="form-group row justify-content-between">
                            <div></div>
                            <div class="col-lg-10">
                                <input type="submit" name="blogKaydet" class="btn btn-lg btn-primary btn-block" value="Kaydet">
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