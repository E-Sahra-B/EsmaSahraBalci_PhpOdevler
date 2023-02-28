<?php
require_once 'inc/config.php';
error_reporting(0);
$tur = $guvenlik->sanitize($_GET["t"], 'string')->result();
$sf = $guvenlik->sanitize($_GET["sf"], 'integer')->result();
if ($sf <= 0) {
    $sf = 1;
}
if ($tur == "yeni") {
    $sfbaslik = "Yeni Ürünler";
} else if ($tur == "coksatan") {
    $sfbaslik = "Çok Satan Ürünler";
} else {
    $sfbaslik = "Tüm Ürünler";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Enstitü İstanbul İsmek - Zemin İstanbul PHP Atölyesi">
    <meta name="author" content="Mehmet Selçuk Batal">
    <title><?= $sfbaslik ?> - Eİİ Shop v1.0</title>
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet">
</head>

<body>
    <?php include_once 'tmp_ust.php'; ?>
    <section class="bg-dark py-1">
        <div class="container px-4 px-lg-5 my-5">
            <div class="text-center text-white">
                <h3 class="fw-bolder"><?= $sfbaslik ?></h3>
            </div>
        </div>
    </section>
    <section class="py-5 content">
        <div class="container px-4 px-lg-5 mt-5">
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                <?php
                if ($tur == "yeni") {
                    $sorgux = $baglan->select('urunler', ['count(*) as toplam'])->where('durum', 'aktif', '=')->limit(24)->run();
                    $adres = "t=yeni&";
                } else if ($tur == "coksatan") {
                    $sorgux = $baglan->select('urunler', ['count(*) as toplam'])->where('durum', 'aktif', '=')->limit(24)->run();
                    $adres = "t=coksatan&";
                } else {
                    $sorgux = $baglan->select('urunler', ['count(*) as toplam'])->where('durum', 'aktif', '=')->run();
                    $adres = "";
                }
                $toplam = $sorgux[0]["toplam"];
                $kacar = 8;
                $sayfa = ceil($toplam / $kacar);
                $limit = ($sf - 1) * $kacar;
                if ($sf > $sayfa) {
                    header("Location:urunler.php?" . $adres . "sf=1");
                }
                if ($tur == "yeni") {
                    $sorgu = $baglan->select('urunler', ['no', 'baslik', 'resim', 'fiyat', 'durum', 'ziyaret'])->where('durum', 'aktif', '=')->orderBy('tarih', 'desc')->limit($limit, $kacar)->run();
                } else if ($tur == "coksatan") {
                    $sorgu = $baglan->select('urunler', ['no', 'baslik', 'resim', 'fiyat', 'durum', 'ziyaret'])->where('durum', 'aktif', '=')->orderBy('ziyaret', 'desc')->limit($limit, $kacar)->run();
                    $adres = "t=coksatan&";
                } else {
                    $sorgu = $baglan->select('urunler', ['no', 'baslik', 'resim', 'fiyat', 'durum', 'ziyaret'])->where('durum', 'aktif', '=')->orderBy('fiyat', 'asc')->limit($limit, $kacar)->run();
                    $adres = "";
                }
                if ($sorgu) {
                    foreach ($sorgu as $satir) {
                        $eskifiyat = $satir["fiyat"] * 1.50;
                        $ortalamaHesapla = $baglan->select('urunler', ['avg(ziyaret)'])->run();
                        foreach ($ortalamaHesapla as $key => $value) {
                            $toplamUrunZiyaretOrtalama = $value['avg(ziyaret)'];
                        }
                        $urunZiyaret = $satir["ziyaret"];
                        $urunZiyaret = ($urunZiyaret < 1) ? $urunZiyaret = 1 : $urunZiyaret;
                        $yildiz = ceil($urunZiyaret / $toplamUrunZiyaretOrtalama);
                        echo "<div class='col mb-5'>
                                <div class='card h-100'>
                                <div class='badge bg-dark text-white position-absolute' style='top: 0.5rem; right: 0.5rem'>$satir[durum]</div>
                                <a href='detay.php?no=$satir[no]'><img class='card-img-top' src='$satir[resim]' alt='$satir[baslik]'></a>
                                <div class='card-body p-4'>
                                <div class='text-center'>
                                <h5 class='fw-bolder'>$satir[baslik]</h5>
                                <div class='d-flex justify-content-center small text-warning mb-2'>";
                        for ($i = 1; $i <= $yildiz; $i++) {
                            echo "<div class='bi-star-fill'></div>";
                        }
                        echo "
                                </div>
                                <span class='text-muted text-decoration-line-through'>₺$eskifiyat</span>
                                ₺" . number_format($satir['fiyat'], 2, ',', '.') . "
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
                        <a class='page-link' href='urunler.php?" . $adres . "sf=$geri'>
                        <span aria-hidden='true'>&laquo;</span>
                        </a>
                        </li>";
                for ($i = 1; $i <= $sayfa; $i++) {
                    echo "<li class='page-item'><a class='page-link' href='urunler.php?" . $adres . "sf=$i'>$i</a></li>";
                }
                echo "<li class='page-item'>
                        <a class='page-link' href='urunler.php?" . $adres . "sf=$ileri'>
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