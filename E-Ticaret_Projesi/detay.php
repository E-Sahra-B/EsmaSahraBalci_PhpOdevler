<?php
require_once 'inc/config.php';
$urunno = $guvenlik->sanitize($_GET["no"], 'integer')->result();
$icerik = $baglan->select('urunler')->where('durum', 'aktif', '=')->where('no', $urunno, '=')->run();
if ($icerik[0]["no"] == "") {
    header("Location:urunler.php");
    die();
}
$baglan->update('urunler', ['ziyaret' => $icerik[0]["ziyaret"]+1])->where('no', $urunno, '=')->run();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="Enstitü İstanbul İsmek - Zemin İstanbul PHP Atölyesi">
        <meta name="author" content="Mehmet Selçuk Batal">
        <title><?=$icerik[0]["baslik"] ?> - Eİİ Shop v1.0</title>
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet">
        <link href="owlcarousel/owl.carousel.min.css" rel="stylesheet">
        <link href="owlcarousel/owl.theme.default.min.css" rel="stylesheet">
        <link href="css/styles.css" rel="stylesheet">
    </head>
    <body>
        <?php include_once 'tmp_ust.php'; ?>
        <section class="bg-dark py-1">
            <div class="container px-4 px-lg-5 my-5">
                <div class="text-center text-white">
                    <h3 class="fw-bolder"><?=$icerik[0]["baslik"] ?></h3>
                </div>
            </div>
        </section>
        <section class="py-5 content">
            <div class="container px-4 px-lg-5 my-5">
                <div class="row gx-4 gx-lg-5 align-items-center">
                    <div class="col-md-6">
                        <img class="mb-5 mb-md-0" src="<?=$icerik[0]["resim"] ?>" alt="<?=$icerik[0]["baslik"] ?>">
                    </div>
                    <div class="col-md-6">
                        <div class="small mb-1">KOD: <?=$icerik[0]["kod"] ?></div>
                        <h1 class="display-5 fw-bolder"><?=$icerik[0]["baslik"] ?></h1>
                        <div class="fs-5 mb-5">
                            <?php
                                $eskifiyat = $icerik[0]["fiyat"]*1.50;
                            ?>
                            <span class="text-decoration-line-through">₺<?php echo number_format($eskifiyat,2,',','.'); ?></span>
                            <span>₺<?php echo number_format($icerik[0]["fiyat"],2,',','.'); ?></span>
                        </div>
                        <?=$icerik[0]["aciklama"] ?><p><br></p>
                            <form method="post" class="form-horizontal" action="kontrol.php?islem=ekle">
                            <div class="row">
                                <div class="col-2">
                                    <input class="form-control text-center" type="text" value="1" name="adet" style="max-width: 3rem">
                                    <input type="hidden" name="urun" value="<?=$icerik[0]["no"] ?>">
                                </div>
                                <div class="col-10">
                                    <button class="btn btn-outline-dark flex-shrink-0" type="submit"><i class="bi-cart-fill me-1"></i>Sepete Ekle</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        <section class="py-5 bg-light">
            <div class="container px-4 px-lg-5 mt-5">
                <h2 class="fw-bolder mb-4">İlişkili Ürünler</h2>
                <div class="row">
                    <div class="owl-carousel owl-theme">
                        <?php
                            $sorgu = $baglan->select('urunler', ['no','baslik','resim','fiyat'])->where('durum', 'aktif', '=')->where('kategori', $icerik[0]["kategori"], '=')->orderBy('RAND()')->limit(12)->run();
                            if ($sorgu) {
                                foreach ($sorgu as $satir) { 
                                    echo "<div class='col mb-5 item'>
                                    <div class='card h-100'>
                                    <a href='detay.php?no=$satir[no]'><img class='card-img-top' src='$satir[resim]' alt='$satir[baslik]'></a>
                                    <div class='card-body p-4'>
                                    <div class='text-center'>
                                    <h5 class='fw-bolder'>$satir[baslik]</h5>
                                    ₺".number_format($satir["fiyat"], 2, ',', '.')."
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
            </div>
        </section>
        <?php include_once 'tmp_alt.php'; ?>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="js/jquery.min.js"></script>
        <script src="owlcarousel/owl.carousel.min.js"></script>
        <script>
            $(document).ready(function() {
                $('.owl-carousel').owlCarousel({
                    loop:true,
                    nav:false,
                    margin:10,
                    responsiveClass:true,
                    responsive:{
                        0:{
                            items:1,
                            nav:false
                        },
                        480:{
                            items:2,
                            nav:false
                        },
                        600:{
                            items:2,
                            nav:false
                        },
                        1000:{
                            items:5,
                            nav:false,
                        }
                    }
                });
            });
        </script>
    </body>
</html>