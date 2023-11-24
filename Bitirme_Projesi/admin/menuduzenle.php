<?php
error_reporting(0);
include("../ayar.php");

if ($_POST) {
    $kayitNo = $_POST["id"];
    $satirlar = $baglan->query("select * from menuler where id=$kayitNo");
    $menuAdi = $_POST["menuAdi"];
    $menuLink = $_POST["menuLink"];
    $aciklama = $_POST["aciklama"];
    $tarih = date('Y-m-d', strtotime($_POST['tarih']));
    $resim = "img/" . $_FILES["resim"]["name"];
    $resim_tmp = $_FILES["resim"]["tmp_name"];
    if ($resim_tmp != "") {
        move_uploaded_file($resim_tmp, $resim);
        $sorgu = $baglan->prepare("update menuler set menuAdi=?, menuLink=?, resim=?, aciklama=?, tarih=? where id=?");
        $guncelle = $sorgu->execute(array($menuAdi, $menuLink, $resim, $aciklama, $tarih, $kayitNo));
        if ($guncelle) {
            print '<div class="alert alert-success">RESİM GÜNCELLEME YAPILDI</div>';
            header("Refresh: 2; url=menuliste.php");
        } else {
            print '<div class="alert alert-danger">HATA: KAYIT GÜNCELLEME YAPILAMADI !</div>';
            header("refresh:2", "menuduzenle.php");
        }
    } else {
        $sorgu = $baglan->prepare("update menuler set menuAdi=?, menuLink=?, aciklama=?, tarih=? where id=?");
        $guncelle = $sorgu->execute(array($menuAdi, $menuLink, $aciklama, $tarih, $kayitNo));
        print '<div class="alert alert-success">GÜNCELLEME YAPILDI</div>';
        header("Refresh: 2; url=menuliste.php");
    }
    // $query = $connect->prepare("UPDATE images SET
    // imageTitle=:title,
    // imageurl=:img 
    // WHERE id=$ID");
    // $updateImage = $query->execute([
    //     'title' => $title,
    //     'img' => ($image_tmp != "") ? $image : $oldImageUrl
    // ]);
    // //($resim_tmp != "") ? move_uploaded_file($resim_tmp, $resim) && unlink($oldImageUrl) : "";
    // move_uploaded_file($resim_tmp, $resim);
    // unlink($oldImageUrl);
} else {
    $kayitNo = $_GET["id"];
    $satirlar = $baglan->query("select * from menuler where id=$kayitNo");
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
    <script src="https://cdn.ckeditor.com/4.20.1/standard/ckeditor.js"></script>
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
            <form action="menuduzenle.php" method="post" enctype="multipart/form-data">
                <div class="row">
                    <?php
                    foreach ($satirlar as $satir) {
                    ?>
                        <div class="col-lg-12">
                            <div class="form-group row"><label class="col-lg-2 col-form-label">Menü Adı</label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control" name="menuAdi" placeholder="Menü Adı Giriniz" value="<?php echo $satir["menuAdi"]; ?>">
                                    <small>Menü adı 50 karakterden uzun olamaz</small>
                                </div>
                            </div>
                            <div class="form-group row"><label class="col-lg-2 col-form-label">Menü Linki</label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control" name="menuLink" placeholder="Menü Linki Giriniz" value="<?php echo $satir["menuLink"]; ?>">
                                </div>
                            </div>
                            <div class="form-group row"><label class="col-lg-2 col-form-label">Resim</label>
                                <div class="col-lg-10">
                                    <img src="<?php echo $satir["resim"]; ?>" width="100" height="100%" name="resim2" value="<?php echo $satir["resim"]; ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="formFile" class="col-lg-2 col-form-label">Resim Güncelle</label>
                                <div class="col-lg-10">
                                    <input class="form-control" type="file" name="resim" id="formFile" value="<?php echo $satir["resim"]; ?>">
                                </div>
                            </div>
                            <div class="form-group row"><label class="col-lg-2 col-form-label">Açıklama</label>
                                <div class="col-lg-10">
                                    <div class="summernote">
                                        <textarea class="ckeditor" name="aciklama"><?php echo $satir["aciklama"]; ?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row"><label class="col-lg-2 col-form-label">Tarih</label>
                                <div class="col-lg-10">
                                    <div class="input-group date">
                                        <input type="date" class="form-control" name="tarih" value="<?php echo $satir["tarih"]; ?>">
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="id" value="<?php echo $satir["id"]; ?>">
                            <div class="form-group row justify-content-between">
                                <div></div>
                                <div class="col-lg-10">
                                    <input type="submit" class="btn btn-lg btn-primary btn-block" value="Güncelle">
                                </div>
                            </div>
                        </div>
                    <?php
                    } ?>
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
    <script>
        CKEDITOR.replace('editor1');
    </script>
</body>

</html>