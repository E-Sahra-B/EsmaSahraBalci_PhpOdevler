<?php
require_once 'inc/config.php';
error_reporting(0);
if ($sepet->urunsay() < 1) {
    header("Location: urunler.php");
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
    <title>Alışveriş Sepeti - Eİİ Shop v1.0</title>
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet">
</head>

<body>
    <?php include_once 'tmp_ust.php'; ?>
    <section class="bg-dark py-1">
        <div class="container px-4 px-lg-5 my-5">
            <div class="text-center text-white">
                <h3 class="fw-bolder">Alışveriş Sepeti</h3>
            </div>
        </div>
    </section>
    <div class="container content py-5">
        <div class="row">
            <div class="col-12">
                <table class="table table-responsive table-striped table-bordered">
                    <tr>
                        <th class="text-center">Resim</th>
                        <th>Ürün Açıklama</th>
                        <th class="text-center">Adet</th>
                        <th class="text-center">B. Fiyat</th>
                        <th class="text-center">Tutar</th>
                        <th class="text-center">Sil</th>
                    </tr>
                    <?php
                    foreach ($_SESSION["sepet"] as $urun => $adet) {
                        $icerik = $baglan->select('urunler')->where('durum', 'aktif', '=')->where('no', $urun, '=')->run();

                        $utoplam = $adet * $icerik[0]["fiyat"];
                        $atoplam += $utoplam;

                        echo "<tr>
                                <td class='text-center'><a href='detay.php?no=$urun'><img src='" . $icerik[0]["resim"] . "' style='height:30px'></a></td>
                                <td>" . $icerik[0]["baslik"] . "</td>
                                <td class='text-center'>$adet</td>
                                <td class='text-center'>₺" . number_format($icerik[0]["fiyat"], 2, ',', '.') . "</td>
                                <td class='text-center'>₺" . number_format($utoplam, 2, ',', '.') . "</td>
                                <td class='text-center'><a href='kontrol.php?islem=sil&urun=$urun' class='btn btn-outline-danger btn-sm' onclick='if (!confirm(\"Ürün kaldırılacaktır. Emin misiniz?\")) return false'>x</a></td>
                                </tr>";
                    }

                    $gtoplam = $atoplam * 1.18;
                    $ktoplam = $gtoplam - $atoplam;
                    ?>
                    <tr>
                        <th class="text-end" colspan="4">Ara Toplam&nbsp;&nbsp;</th>
                        <td class="text-center" colspan="2"><?php echo "₺" . number_format($atoplam, 2, ',', '.'); ?></td>
                    </tr>
                    <tr>
                        <th class="text-end" colspan="4">KDV (%18)&nbsp;&nbsp;</th>
                        <td class="text-center" colspan="2"><?php echo "₺" . number_format($ktoplam, 2, ',', '.'); ?></td>
                    </tr>
                    <tr>
                        <th class="text-end" colspan="4">Genel Toplam&nbsp;&nbsp;</th>
                        <td class="text-center" colspan="2"><?php echo "₺" . number_format($gtoplam, 2, ',', '.'); ?></td>
                    </tr>
                </table>
                <br>
                <h5 class="text-center text-dark">~~ &nbsp;Sipariş Bilgileri&nbsp; ~~</h5>
                <form method="post" action="kontrol.php?islem=kaydet">
                    <div class="row mt-5">
                        <div class="col-sm-6 col-12"><input type="text" class="form-control" placeholder="Adınız Soyadınız" name="adsoyad" required></div>
                        <div class="col-sm-6 col-12"><input type="email" class="form-control" placeholder="E-posta Adresiniz" name="email" required></div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-sm-6 col-12"><input type="number" class="form-control" placeholder="Telefon Numaranız" name="telefon" required></div>
                        <div class="col-sm-6 col-12"><input type="text" class="form-control" placeholder="Kargo Adresiniz" name="adres" required></div>
                    </div>
                    <div class="row mt-5">
                        <div class="col-12 text-center">
                            <button type="submit" class="btn btn-success me-3">Siparişi Kaydet</button>
                            <a href="kontrol.php?islem=temizle" class="btn btn-outline-secondary" onclick='if (!confirm("Sepet içeriği temizlenecektir. Emin misiniz?")) return false'>İptal Et</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php include_once 'tmp_alt.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/scripts.js"></script>
</body>

</html>