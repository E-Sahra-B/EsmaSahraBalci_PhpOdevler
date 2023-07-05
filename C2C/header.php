<?php
ob_start();
session_start();
error_reporting(0);
date_default_timezone_set('Europe/Istanbul');
require_once 'admin/netting/baglan.php';
require_once 'admin/production/fonksiyon.php';
require_once 'admin/netting/auth.php';
$user = new Auth();

$ayarcek = siteAyar();
$url = "http://" . $_SERVER["SERVER_NAME"] . dirname($_SERVER["PHP_SELF"]);
define("URL", $url);

if (isset($_SESSION['userkullanici_mail'])) {
    $kullanicisor = $db->prepare("SELECT * FROM kullanici where kullanici_mail=:mail");
    $kullanicisor->execute(array(
        'mail' => $_SESSION['userkullanici_mail']
    ));
    $say = $kullanicisor->rowCount();
    $kullanicicek = $kullanicisor->fetch(PDO::FETCH_ASSOC);
    if (!isset($_SESSION['userkullanici_id'])) {
        $_SESSION['userkullanici_id'] = $kullanicicek['kullanici_id'];
    }
}
if (basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
    exit("Bu sayfaya erişim yasak");
}
/*
if (basename($_SERVER['PHP_SELF'])==basename(__FILE__)) {
    echo basename($_SERVER['PHP_SELF']);
    echo basename(__FILE__);
    exit("Bu sayfaya erişim yasak");
} else {//index.php çağrıldığında
    echo basename($_SERVER['PHP_SELF']);//index.php 
    echo basename(__FILE__);//header.php eklenen dosya include edilen
}
*/
if (isset($_SESSION['userkullanici_sonzaman'])) {
    $kullanici_sonzaman = $_SESSION['userkullanici_sonzaman'];
    $suan = time();
    $fark = ($suan - $kullanici_sonzaman);
    if ($fark > 600) {
        $zamanguncelle = $db->prepare("UPDATE kullanici SET
        kullanici_sonzaman=:kullanici_sonzaman
        WHERE kullanici_id={$_SESSION['userkullanici_id']}");
        $update = $zamanguncelle->execute(array(
            'kullanici_sonzaman' => date("Y-m-d H:i:s")
        ));
        $kullanici_sonzaman = $_SESSION['userkullanici_sonzaman'];
    }
}
?>
<!doctype html>
<html class="no-js" lang="">

<head>
    <title>
        <?php if (empty($title)) {
            //echo $ayarcek['ayar_title']; 
            echo ucfirst(basename($_SERVER['PHP_SELF'], '.php')) . ' | ' . $ayarcek['ayar_title'];
        } else {
            echo $title . ' | ' . $ayarcek['ayar_title'];
        }
        ?>
    </title>
    <!-- <title><?= ucfirst(basename($_SERVER['PHP_SELF'], '.php')) . ' | ' . $ayarcek['ayar_title']; ?></title> -->
    <meta charset="utf-8"><!-- Türkçe karakter sorunu olmasın diye eklenmeli -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="<?= $ayarcek['ayar_description'] ?>">
    <meta name="keywords" content="<?= $ayarcek['ayar_keywords'] ?>">
    <meta name="author" content="<?= $ayarcek['ayar_author'] ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="img\favicon.png">

    <!-- Normalize CSS -->
    <link rel="stylesheet" href="css\normalize.css">

    <!-- Main CSS -->
    <link rel="stylesheet" href="css\main.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css\bootstrap.min.css">

    <!-- Animate CSS -->
    <link rel="stylesheet" href="css\animate.min.css">

    <!-- Font-awesome CSS-->
    <link rel="stylesheet" href="css\font-awesome.min.css">

    <!-- Owl Caousel CSS -->
    <link rel="stylesheet" href="vendor\OwlCarousel\owl.carousel.min.css">
    <link rel="stylesheet" href="vendor\OwlCarousel\owl.theme.default.min.css">

    <!-- Main Menu CSS -->
    <link rel="stylesheet" href="css\meanmenu.min.css">

    <!-- Datetime Picker Style CSS -->
    <link rel="stylesheet" href="css\jquery.datetimepicker.css">

    <!-- ReImageGrid CSS -->
    <link rel="stylesheet" href="css\reImageGrid.css">

    <!-- Switch Style CSS -->
    <link rel="stylesheet" href="css\hover-min.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="style.css">

    <!-- Modernizr Js -->
    <script src="js\modernizr-2.8.3.min.js"></script>

    <!-- Select2 CSS -->
    <link rel="stylesheet" href="css\select2.min.css">

    <!-- Ck Editör -->
    <!-- <script src="https://cdn.ckeditor.com/4.7.1/standard/ckeditor.js"></script> -->
    <script src="admin/production/ckeditor/ckeditor.js"></script>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <!-- SweetAlert2 -->
    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>

    <!-- Datatables -->
    <link href="admin/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="admin/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="admin/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="admin/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="admin/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">

</head>

<body>
    <?php
    if ($ayarcek['ayar_bakim'] == 1) {
        exit("Şuan Bakımdayız...");
    }
    ?>
    <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

    <!-- Add your site or application content here -->
    <!-- Preloader Start Here -->
    <div id="preloader"></div>
    <!-- Preloader End Here -->
    <!-- Main Body Area Start Here -->
    <div id="wrapper">
        <!-- Header Area Start Here -->
        <header>
            <div id="header2" class="header2-area right-nav-mobile">
                <div class="header-top-bar">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-2 col-md-2 col-sm-2 hidden-xs">
                                <div class="logo-area">
                                    <a href="index.php"><img class="img-responsive" src="<?= $ayarcek['ayar_logo'] ?>" alt="logo"></a>
                                </div>
                            </div>
                            <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                                <ul class="profile-notification">
                                    <!--<li>
                                            <div class="notify-contact"><span>Need help?</span> Talk to an expert: +61 3 8376 6284</div>
                                        </li>-->
                                    <?php
                                    if (isset($_SESSION['userkullanici_mail'])) { ?>
                                        <li>
                                            <div class="notify-notification">
                                                <a href="yeni-siparisler"><i class="fa fa-bell-o" aria-hidden="true"></i><span>
                                                        <?php
                                                        $sc = $user->orderCount($user->guvenlik($_SESSION['userkullanici_id']));
                                                        echo $sc['ordercount'];

                                                        $siparissor = $db->prepare("SELECT siparis.*,siparis_detay.*,kullanici.*,urun.*
                                                        FROM siparis 
                                                        INNER JOIN siparis_detay ON siparis.siparis_id=siparis_detay.siparis_id 
                                                        INNER JOIN kullanici ON kullanici.kullanici_id=siparis_detay.kullanici_id 
                                                        INNER JOIN urun ON urun.urun_id=siparis_detay.urun_id 
                                                        where siparis.kullanici_idsatici=:kullanici_idsatici 
                                                        order by siparis_zaman DESC");
                                                        $siparissor->execute(array(
                                                            'kullanici_idsatici' => $_SESSION['userkullanici_id']
                                                        ));
                                                        ?>
                                                    </span></a>
                                                <ul>
                                                    <?php while ($sipariscek = $siparissor->fetch(PDO::FETCH_ASSOC)) : ?>
                                                        <li>
                                                            <div class="notify-notification-img">
                                                                <img class="img-responsive" src="<?= $sipariscek['urunfoto_resimyol'] ?>" alt="<?= $sipariscek['urun_ad'] ?>">
                                                            </div>
                                                            <div class="notify-notification-info">
                                                                <div class="notify-notification-subject"><?= $sipariscek['urun_ad'] ?></div>
                                                                <div class="notify-notification-date"><?= tarih($sipariscek['siparis_zaman']) ?></div>
                                                            </div>
                                                            <div class="notify-notification-sign">
                                                                <i class="fa fa-bell-o" aria-hidden="true"></i>
                                                            </div>
                                                        </li>
                                                    <?php endwhile ?>
                                                </ul>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="notify-message">
                                                <a href="gelen-mesajlar"><i class="fa fa-envelope-o" aria-hidden="true"></i>
                                                    <span id="showmessagecount"><?= $user->messageCount($user->guvenlik($_SESSION['userkullanici_id']))['say'] ?></span>
                                                </a>
                                                <ul>
                                                    <?php
                                                    $mesajsor = $db->prepare("SELECT mesaj.*,kullanici.* FROM mesaj INNER JOIN kullanici ON mesaj.kullanici_gon=kullanici.kullanici_id where mesaj.kullanici_gel=:id and mesaj.mesaj_okunma=:okunma order by mesaj_okunma,mesaj_zaman DESC limit 5");
                                                    $mesajsor->execute(array(
                                                        'id' => $_SESSION['userkullanici_id'],
                                                        'okunma' => 0
                                                    ));
                                                    if ($mesajsor->rowCount() == 0) { ?>
                                                        <li>
                                                            <div class="notify-message-info">
                                                                <div style="color:black !important" class="notify-message-subject">Hiç Mesajınız Yok</div>
                                                            </div>
                                                        </li>
                                                    <?php }
                                                    while ($mesajcek = $mesajsor->fetch(PDO::FETCH_ASSOC)) { ?>
                                                        <li>
                                                            <div class="notify-message-img">
                                                                <img class="img-responsive" src="<?= $mesajcek['kullanici_magazafoto']; ?>" alt="profile">
                                                            </div>
                                                            <div class="notify-message-info">
                                                                <div class="notify-message-sender"><?= $mesajcek['kullanici_ad'] . " " . $mesajcek['kullanici_soyad'] ?></div>
                                                                <div class="notify-message-subject"><?= guvenlik(metinKirp($mesajcek['mesaj_detay'], 15)) . "..."; ?></div>
                                                                <div class="notify-message-date"><?= uzuntarih($mesajcek['mesaj_zaman']); ?></div>
                                                            </div>
                                                            <div class="notify-message-sign">
                                                                <!-- <a href="mesaj-detay?mesaj_id=<?= $mesajcek['mesaj_id'] ?>&kullanici_gon=<?= $mesajcek['kullanici_gon'] ?>"><i style="color:#ef6c00; !important" class="fa fa-envelope-o" aria-hidden="true"></i></a> -->
                                                                <a href="" id="<?= $mesajcek['mesaj_id'] ?>" class="detailBtn" data-toggle="modal" data-target="#detailMessage"><i style="color:#ef6c00 !important;" class="fa fa-envelope-o" aria-hidden="true"></i></a>
                                                            </div>
                                                        </li>
                                                    <?php } ?>
                                                </ul>
                                            </div>
                                        </li>
                                    <?php } ?>
                                    <?php
                                    if (isset($_SESSION['userkullanici_mail'])) { ?>
                                        <li>
                                            <div class="user-account-info">
                                                <div class="user-account-info-controler">
                                                    <div class="user-account-img">
                                                        <img style="border-radius: 30px; width:32px; height:32px;" class="img-responsive" src="<?= $kullanicicek['kullanici_magazafoto'] ?>" alt="profile">
                                                    </div>
                                                    <div class="user-account-title">
                                                        <div class="user-account-name"><?= $kullanicicek['kullanici_ad'] . " " . substr($kullanicicek['kullanici_soyad'], 0, 1) ?>.</div>
                                                        <div class="user-account-balance">
                                                            <?php
                                                            $siparissor = $db->prepare("SELECT SUM(urun_fiyat) as toplam FROM siparis_detay where kullanici_idsatici=:kullanici_id ");
                                                            $siparissor->execute(array(
                                                                'kullanici_id' => $_SESSION['userkullanici_id']
                                                            ));
                                                            $sipariscek = $siparissor->fetch(PDO::FETCH_ASSOC);
                                                            if (isset($sipariscek['toplam'])) {
                                                                echo fiyat($sipariscek['toplam']) . " ₺";
                                                            } else {
                                                                echo "0,00 ₺";
                                                            }
                                                            ?>
                                                        </div>
                                                    </div>
                                                    <div class="user-account-dropdown">
                                                        <i class="fa fa-angle-down" aria-hidden="true"></i>
                                                    </div>
                                                </div>
                                                <ul>
                                                    <li><a href="siparislerim">Siparişlerim</a></li>
                                                    <li><a href="gelen-mesajlar">Gelen Mesajlar</a></li>
                                                    <li><a href="giden-mesajlar">Giden Mesajlar</a></li>
                                                    <li><a href="hesabim">Hesap Bilgilerim</a></li>
                                                    <li><a href="adres-bilgileri">Adres Bilgilerim</a></li>
                                                    <li><a href="profil-resim-guncelle">Resim Güncelle</a></li>
                                                    <li><a href="sifre-guncelle">Şifre Güncelle</a></li>
                                                    <hr>
                                                    <li><a href="urunlerim">Ürünlerim</a></li>
                                                    <li><a href="urun-ekle">Ürün Ekle</a></li>
                                                    <li><a href="yeni-siparisler">Yeni Siparişler</a></li>
                                                    <li><a href="tamamlanan-siparisler">Tamamlanan Siparişler</a></li>
                                                </ul>
                                            </div>
                                        </li>
                                        <li><a class="apply-now-btn" href="logout" id="logout-button">Çıkış</a></li>
                                    <?php } else { ?>
                                        <li> <a class="apply-now-btn hidden-on-mobile" href="login">Üye Girişi</a></li>
                                        <li><a class="apply-now-btn-color hidden-on-mobile" href="register">Kayıt</a></li>
                                    <?php }
                                    ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="main-menu-area bg-primaryText" id="sticker">
                    <div class="container">
                        <nav id="desktop-nav">
                            <ul>
                                <li class="<?= (basename($_SERVER['PHP_SELF'], '.php') == "index") ? "active" : ""; ?>"><a href="index">Anasayfa</a></li>
                                <li class="<?= (basename($_SERVER['PHP_SELF'], '.php') == "kategoriler") ? "active" : ""; ?>"><a href="kategoriler">Kategoriler</a></li>
                                <?php
                                $kategorisor = $db->prepare("SELECT * FROM kategori where kategori_onecikar=:onecikar order by kategori_sira ASC");
                                $kategorisor->execute(array(
                                    'onecikar' => 1
                                ));
                                while ($kategoricek = $kategorisor->fetch(PDO::FETCH_ASSOC)) { ?>
                                    <li><a href="kategoriler-<?= seo($kategoricek['kategori_ad']) . "-" . $kategoricek['kategori_id'] ?>"><?= $kategoricek['kategori_ad'] ?></a></li>
                                <?php } ?>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
            <!-- Mobile Menu Area Start -->
            <div class="mobile-menu-area">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mobile-menu">
                                <nav id="dropdown">
                                    <ul><!-- Mobile / Responsive Web Design Tester Chrome Eklentisi -->
                                        <li class="active"><a href="index.php">Anasayfa</a></li>
                                        <li><a href="login">Üye Giriş</a></li>
                                        <li><a href="register">Üye Kayıt</a></li>
                                        <li><a href="kategoriler">Kategoriler</a></li>
                                        <?php
                                        $kategorisor = $db->prepare("SELECT * FROM kategori where kategori_onecikar=:onecikar order by kategori_sira ASC");
                                        $kategorisor->execute(array(
                                            'onecikar' => 1
                                        ));
                                        while ($kategoricek = $kategorisor->fetch(PDO::FETCH_ASSOC)) { ?>
                                            <li><a href="kategoriler-<?= seo($kategoricek['kategori_ad']) . "-" . $kategoricek['kategori_id'] ?>"><?php echo $kategoricek['kategori_ad'] ?></a></li>
                                        <?php } ?>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Mobile Menu Area End -->
        </header>