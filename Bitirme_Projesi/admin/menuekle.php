<?php
error_reporting(0);
include("../ayar.php");
$sorgu = $baglan->query("select * from menuler", PDO::FETCH_ASSOC);
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
            <form action="islem.php" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group row"><label class="col-sm-2 col-form-label">Menü Adı</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="menuadi" placeholder="Menü Adı Giriniz">
                                <small>Menü adı 50 karakterden uzun olamaz</small>
                            </div>
                        </div>
                        <div class="form-group row"><label class="col-sm-2 col-form-label">Menü Linki</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="menulink" placeholder="Menü Linki Giriniz">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="formFile" class="col-sm-2 col-form-label">Resim Ekle</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="file" name="resim" id="formFile">
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
                                    <input type="date" class="form-control" value="<?php echo date('d-m-Y'); ?>">
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