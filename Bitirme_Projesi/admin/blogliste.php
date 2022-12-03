<?php
include("../ayar.php");
$sorgu = $baglan->query("select * from bloglar", PDO::FETCH_ASSOC);

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
            <div class="row">
                <div class="col-lg-12">
                    <div class="wrapper wrapper-content animated fadeInUp">
                        <div class="ibox">
                            <div class="ibox-title">
                                <h5>Bütün Bloglar</h5>
                                <div class="ibox-tools">
                                    <a href="blogekle.php" class="btn btn-primary btn-sm">Blog Ekle</a>
                                </div>
                            </div>
                            <div class="ibox-content">
                                <div class="row m-b-sm m-t-sm">
                                    <div class="col-md-1">
                                        <button type="button" id="loading-example-btn" class="btn btn-white btn-sm"><i class="fa fa-refresh"></i>Yenile</button>
                                    </div>
                                    <div class="col-md-11">
                                        <div class="input-group"><input type="text" placeholder="Arama Yap" class="form-control-sm form-control"><span class="input-group-btn">
                                                <button type="button" class="btn btn-sm btn-success">Getir</button></span></div>
                                    </div>
                                </div>
                                <div class="project-list">
                                    <table class="table table-hover">
                                        <tbody>
                                            <?php
                                            foreach ($sorgu as $satir) {
                                                echo "<tr>
                                                <td class='project-people'>
                                                <a href=''><img alt='image' class='rounded-circle' src='$satir[resim]'></a>
                                                </td>
                                                <td class='project-title'>
                                                    <p>" . date('d-m-Y', strtotime($satir['tarih'])) . "</p>
                                                </td>
                                                
                                                <td class='project-title'>
                                                    <a href='project_detail.html'>$satir[baslik]</a>
                                                </td>
                                                <td class='project-title'>
                                                <a href='project_detail.html'>" . mb_substr($satir["icerik"], 0, 50, "utf-8") . "</a>
                                                </td>
                                                <td class='project-title'>
                                                    <a href='project_detail.html'>$satir[ziyaret]</a>
                                                </td>
                                                <td class='project-title'>
                                                    <a href='project_detail.html'>$satir[durum]</a>
                                                </td>
                                                
                                                <td class='project-actions'>
                                                    <a href='menuduzenle.php?id=$satir[id]' class='btn btn-info btn-sm'><i class='fa fa-folder'></i> Düzenle</a>
                                                    <a href='islem.php?islem=sil&id=$satir[id]'  onclick=\"if (!confirm('Menüyü Silmek İstediğinize Emin misiniz?')) return false;\" class='btn btn-danger btn-sm'><i class='fa fa-pencil'></i> Sil</a>
                                                </td></tr>
                                                ";
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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