<?php
require_once 'inc/config.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Enstitü İstanbul İsmek - Zemin İstanbul PHP Atölyesi">
    <meta name="author" content="ZeminIstanbul">
    <title>Eİİ Shop v1.0</title>
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet">
</head>

<body>
    <?php include_once 'tmp_ust.php'; ?>
    <header class="bg-dark py-5">
        <div class="container px-4 px-lg-5 my-5">
            <div class="text-center">
                <h1 class="display-4 fw-bolder">Eİİ Shop</h1>
                <p class="lead fw-normal mb-0">Özgür Alışverişin Adresi</p>
            </div>
        </div>
    </header>
    <section class="py-5">
        <div class="container px-4 px-lg-5 mt-5">
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                <?php
                //$sorgu = $baglan->select('urunler', ['no', 'baslik', 'resim', 'fiyat', 'durum'])->where('durum', 'aktif', '=')->orderBy('RAND()')->limit(12)->run();
                $sorgu = $baglan->select('urunler', ['no', 'baslik', 'resim', 'fiyat', 'durum', 'ziyaret'])->where('durum', 'aktif', '=')->orderBy('RAND()')->run();
                $toplamUrun = $baglan->rowCount();
                if ($sorgu) {
                    foreach ($sorgu as $satir) {
                        // $yildiz = ($urunZiyaret * ($toplamUrun * 5)) / $toplamZiyaretci;
                        $urunZiyaret = $satir["ziyaret"];
                        $eskifiyat = $satir["fiyat"] * 1.50;
                        echo "<div class='col mb-5'>
                                <div class='card h-100'>
                                <div class='badge bg-dark text-white position-absolute' style='top: 0.5rem; right: 0.5rem'>$satir[durum]</div>
                                <a href='detay.php?no=$satir[no]'><img class='card-img-top' src='$satir[resim]' alt='$satir[baslik]'></a>
                                <div class='card-body p-4'>
                                <div class='text-center'>
                                <h5 class='fw-bolder'>$satir[baslik]</h5>
                                <div class='d-flex justify-content-center small text-warning mb-2'>";
                        if ($urunZiyaret > 5) {
                            $urunZiyaret = 5;
                            for ($i = 1; $i <= $urunZiyaret; $i++) {
                                echo "<div class='bi-star-fill'></div>";
                            }
                        } elseif ($urunZiyaret < 1) {
                            $urunZiyaret = 1;
                            for ($i = 1; $i <= $urunZiyaret; $i++) {
                                echo "<div class='bi-star-fill'></div>";
                            }
                        } else {
                            for ($i = 1; $i <= $urunZiyaret; $i++) {
                                echo "<div class='bi-star-fill'></div>";
                            }
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
        </div>
    </section>
    <?php include_once 'tmp_alt.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/scripts.js"></script>
</body>

</html>