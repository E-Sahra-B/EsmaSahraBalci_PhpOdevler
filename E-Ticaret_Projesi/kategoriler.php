<?php
require_once 'inc/config.php';
error_reporting(0);
$katno = $guvenlik->sanitize($_GET["no"], 'integer')->result();
$sf = $guvenlik->sanitize($_GET["sf"], 'integer')->result();
if ($sf <= 0) {
    $sf = 1;
}
$icerik = $baglan->select('kategoriler')->where('durum', 'aktif', '=')->where('no', $katno, '=')->run();
if ($icerik[0]["no"] == "") {
    header("Location:index.php");
    die();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Enstitü İstanbul İsmek - Zemin İstanbul PHP Atölyesi">
    <meta name="author" content="Mehmet Selçuk Batal">
    <title><?= $icerik[0]["baslik"] ?> - Eİİ Shop v1.0</title>
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet">
</head>

<body>
    <?php include_once 'tmp_ust.php'; ?>
    <section class="bg-dark py-1">
        <div class="container px-4 px-lg-5 my-5">
            <div class="text-center text-white">
                <h3 class="fw-bolder"><?= $icerik[0]["baslik"] ?></h3>
            </div>
        </div>
    </section>
    <section class="py-5 content">
        <div class="container px-4 px-lg-5 mt-5">
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                <?php
                $sorgux = $baglan->select('urunler', ['count(*) as toplam'])->where('durum', 'aktif', '=')->where('kategori', $katno, '=')->run();
                $adres = "no=$katno&";

                $toplam = $sorgux[0]["toplam"];
                $kacar = 8;
                $sayfa = ceil($toplam / $kacar);
                $limit = ($sf - 1) * $kacar;

                if ($sf > $sayfa) {
                    header("Location:kategoriler.php?" . $adres . "sf=1");
                }

                $sorgu = $baglan->select('urunler', ['no', 'baslik', 'resim', 'fiyat'])->where('durum', 'aktif', '=')->where('kategori', $katno, '=')->orderBy('fiyat', 'asc')->limit($limit, $kacar)->run();
                if ($sorgu) {
                    foreach ($sorgu as $satir) {
                        echo "<div class='col mb-5'>
                                <div class='card h-100'>
                                <a href='detay.php?no=$satir[no]'><img class='card-img-top' src='$satir[resim]' alt='$satir[baslik]'></a>
                                <div class='card-body p-4'>
                                <div class='text-center'>
                                <h5 class='fw-bolder'>$satir[baslik]</h5>
                                ₺" . number_format($satir["fiyat"], 2, ',', '.') . "
                                </div>
                                </div>
                                <div class='card-footer p-4 pt-0 border-top-0 bg-transparent'>
                                <div class='text-center'><a class='btn btn-outline-dark mt-auto' href='detay.php?no=$satir[no]'>İncele</a></div>
                                </div>
                                </div>
                                </div>";
                    }
                }
                ?>
            </div>
            <?php
            if ($sayfa > 1) {
                $geri = $sf - 1;
                $ileri = $sf + 1;
                if ($geri <= 0) {
                    $geri = 1;
                }
                if ($ileri >= $sayfa) {
                    $ileri = $sayfa;
                }
                echo "<div class='row mt-3'>
                        <nav>
                        <ul class='pagination justify-content-center'>
                        <li class='page-item'>
                        <a class='page-link' href='kategoriler.php?" . $adres . "sf=$geri'>
                        <span aria-hidden='true'>&laquo;</span>
                        </a>
                        </li>";
                for ($i = 1; $i <= $sayfa; $i++) {
                    echo "<li class='page-item'><a class='page-link' href='kategoriler.php?" . $adres . "sf=$i'>$i</a></li>";
                }
                echo "<li class='page-item'>
                        <a class='page-link' href='kategoriler.php?" . $adres . "sf=$ileri'>
                        <span aria-hidden='true'>&raquo;</span>
                        </a>
                        </li>
                        </ul>
                        </nav>
                        </div>";
            }
            ?>
        </div>
    </section>
    <?php include_once 'tmp_alt.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/scripts.js"></script>
</body>

</html>