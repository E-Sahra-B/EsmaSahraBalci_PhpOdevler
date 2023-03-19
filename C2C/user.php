<?php
require_once 'header.php';
$kullanicisor = $db->prepare("SELECT * FROM kullanici where kullanici_id=:id and kullanici_magaza=:magaza");
$kullanicisor->execute(array(
    'id' => $_GET['kullanici_id'],
    'magaza' => 2
));
$say = $kullanicisor->rowCount();
if ($say == 0) {
    Header("Location:404.php");
}
$kullanicicek = $kullanicisor->fetch(PDO::FETCH_ASSOC);
?>
<!-- Header Area End Here -->
<!-- Main Banner 1 Area Start Here -->
<div class="inner-banner-area">
    <div class="container">
    </div>
</div>
<!-- Main Banner 1 Area End Here -->
<!-- Inner Page Banner Area Start Here -->
<div class="pagination-area bg-secondary">
    <div class="container">
        <div class="pagination-wrapper">
        </div>
    </div>
</div>
<!-- Inner Page Banner Area End Here -->
<!-- Profile Page Start Here -->
<div class="profile-page-area bg-secondary section-space-bottom">
    <div class="container">
        <div class="row">
            <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12 col-lg-push-3 col-md-push-4 col-sm-push-4">
                <div class="inner-page-main-body">
                    <div class="single-banner">
                        <img src="img\banner\1.jpg" alt="product" class="img-responsive">
                    </div>
                    <div class="author-summery">
                        <div class="single-item">
                            <div class="item-title">Bölge:</div>
                            <div class="item-details"><?= $kullanicicek['kullanici_ilce'] . " / " . $kullanicicek['kullanici_il'] ?></div>
                        </div>
                        <div class="single-item">
                            <div class="item-title">Kayıt Tarihi</div>
                            <div class="item-details"><?= tarih($kullanicicek['kullanici_zaman']) ?></div>
                        </div>
                        <div class="single-item">
                            <div class="item-title">Puan:</div>
                            <div class="item-details">
                                <?php
                                $puansay = $db->prepare("SELECT 
                                COUNT(yorumlar.yorum_puan) as say,
                                SUM(yorumlar.yorum_puan) as topla, 
                                yorumlar.*,urun.* 
                                FROM yorumlar 
                                INNER JOIN urun ON yorumlar.urun_id=urun.urun_id
                                WHERE urun.kullanici_id=:id");
                                $puansay->execute(array(
                                    'id' => $_GET["kullanici_id"]
                                ));
                                $puancek = $puansay->fetch(PDO::FETCH_ASSOC);
                                $deger = round($puancek['topla'] / $puancek['say']);
                                ?>
                                <ul class="default-rating">
                                    <?php
                                    for ($i = 1; $i <= $deger; $i++) { ?>
                                        <li><i class='fa fa-star' aria-hidden='true'></i></li>
                                    <?php }
                                    for ($j = 1; $j <= 5 - $deger; $j++) { ?>
                                        <li><i class="fa fa-star-o" aria-hidden="true"></i></li>
                                    <?php } ?>
                                    <li>(<span> <?= $deger ?></span> )</li>
                                </ul>
                            </div>
                        </div>
                        <div class="text-center single-item">
                            <div class="item-title">Toplam Satış:</div>
                            <div class="item-name">
                                <?php
                                $urunsay = $db->prepare("SELECT 
                                COUNT(kullanici_idsatici) as say 
                                FROM siparis_detay where kullanici_idsatici=:id");
                                $urunsay->execute(array(
                                    'id' => $_GET['kullanici_id']
                                ));
                                $saycek = $urunsay->fetch(PDO::FETCH_ASSOC);
                                echo $saycek['say'];
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12 col-lg-pull-9 col-md-pull-8 col-sm-pull-8">
                <div class="fox-sidebar">
                    <div class="sidebar-item">
                        <div class="sidebar-item-inner">
                            <h3 class="sidebar-item-title">Satıcı</h3>
                            <div class="sidebar-author-info">
                                <div class="sidebar-author-img">
                                    <img src="<?= $kullanicicek['kullanici_magazafoto'] ?>" alt="product" class="img-responsive">
                                </div>
                                <div class="sidebar-author-content">
                                    <h3><?= $kullanicicek['kullanici_ad'] . " " . $kullanicicek['kullanici_soyad'] ?></h3>
                                    <a href="#" class="view-profile"><i class="fa fa-circle" aria-hidden="true"></i>Online</a>
                                </div>
                            </div>
                            <ul class="sidebar-badges-item">
                                <?php
                                $rozetsay = $db->prepare("SELECT 
                                COUNT(kullanici_idsatici) as rozet 
                                FROM siparis_detay 
                                where kullanici_idsatici=:id");
                                $rozetsay->execute(array(
                                    'id' =>  $_GET["kullanici_id"]
                                ));
                                $saycek = $rozetsay->fetch(PDO::FETCH_ASSOC);
                                if ($saycek['rozet'] > 1 and $saycek['rozet'] <= 9) { ?>
                                    <li><img src="img\profile\badges1.png" alt="badges" class="img-responsive"></li>
                                <?php } else if ($saycek['rozet'] > 9 and $saycek['rozet'] <= 99) { ?>
                                    <li><img src="img\profile\badges1.png" alt="badges" class="img-responsive"></li>
                                    <li><img src="img\profile\badges2.png" alt="badges" class="img-responsive"></li>
                                <?php } else if ($saycek['rozet'] > 99 and $saycek['rozet'] <= 999) { ?>
                                    <li><img src="img\profile\badges1.png" alt="badges" class="img-responsive"></li>
                                    <li><img src="img\profile\badges2.png" alt="badges" class="img-responsive"></li>
                                    <li><img src="img\profile\badges3.png" alt="badges" class="img-responsive"></li>
                                <?php } else if ($saycek['rozet'] > 999 and $saycek['rozet'] <= 9999) { ?>
                                    <li><img src="img\profile\badges1.png" alt="badges" class="img-responsive"></li>
                                    <li><img src="img\profile\badges2.png" alt="badges" class="img-responsive"></li>
                                    <li><img src="img\profile\badges3.png" alt="badges" class="img-responsive"></li>
                                    <li><img src="img\profile\badges4.png" alt="badges" class="img-responsive"></li>
                                <?php } else if ($saycek['rozet'] > 9999) { ?>
                                    <li><img src="img\profile\badges1.png" alt="badges" class="img-responsive"></li>
                                    <li><img src="img\profile\badges2.png" alt="badges" class="img-responsive"></li>
                                    <li><img src="img\profile\badges3.png" alt="badges" class="img-responsive"></li>
                                    <li><img src="img\profile\badges4.png" alt="badges" class="img-responsive"></li>
                                    <li><img src="img\profile\badges5.png" alt="badges" class="img-responsive"></li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                    <ul class="social-default">
                        <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                        <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                        <li><a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
                        <li><a href="#"><i class="fa fa-pinterest" aria-hidden="true"></i></a></li>
                    </ul>
                    <ul class="sidebar-product-btn">
                        <li><a href="#" class="buy-now-btn" id="buy-button"><i class="fa fa-envelope-o" aria-hidden="true"></i> Mesaj Gönder</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row profile-wrapper">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <ul class="profile-title">
                    <li><a href="#Products" data-toggle="tab" aria-expanded="false"><i class="fa fa-briefcase" aria-hidden="true"></i> Ürünleri (
                            <?php
                            $urunsay = $db->prepare("SELECT COUNT(kategori_id) as say FROM urun where kullanici_id=:id");
                            $urunsay->execute(array(
                                'id' => $kullanicicek['kullanici_id']
                            ));
                            $saycek = $urunsay->fetch(PDO::FETCH_ASSOC);
                            echo $saycek['say'];
                            ?>
                            )</a></li>
                    <!-- <li><a href="#Message" data-toggle="tab" aria-expanded="false"><i class="fa fa-envelope-o" aria-hidden="true"></i> Menü Adı</a></li>-->
                </ul>
            </div>
            <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12">
                <div class="tab-content">
                    <div class="tab-pane fade active in" id="Products">
                        <h3 class="title-inner-section">Ürünleri</h3>
                        <div class="inner-page-main-body">
                            <div class="row more-product-item-wrapper">
                                <?php
                                $urunsor = $db->prepare("SELECT urun.*,kategori.* FROM urun INNER JOIN kategori ON urun.kategori_id=kategori.kategori_id where urun.kullanici_id=:kullanici_id ");
                                $urunsor->execute(array(
                                    'kullanici_id' => $_GET['kullanici_id']
                                ));
                                while ($uruncek = $urunsor->fetch(PDO::FETCH_ASSOC)) { ?>
                                    <div class="col-lg-4 col-md-6 col-sm-4 col-xs-6">
                                        <div class="more-product-item">
                                            <div class="more-product-item-img">
                                                <img style="width: 100px; height: 90px;" src="<?= $uruncek['urunfoto_resimyol'] ?>" alt="<?= $uruncek['urunfoto_ad'] ?>" class="img-responsive">
                                            </div>
                                            <div class="more-product-item-details">
                                                <h4><a href="urun-<?= seo($uruncek['urun_ad']) . "-" . $uruncek['urun_id'] ?>"><?= mb_substr($uruncek['urun_ad'], 0, 20, 'UTF-8') ?></a></h4>
                                                <div class="p-title"><?= $uruncek['kategori_ad'] ?></div>
                                                <div class="p-price"><?= fiyat($uruncek['urun_fiyat']) ?> TL</div>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                            <!--<div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <ul class="pagination-align-left">
                                    <li class="active"><a href="#">1</a></li>
                                    <li><a href="#">2</a></li>
                                    <li><a href="#">3</a></li>
                                </ul>
                            </div>  
                        </div>-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Profile Page End Here -->
<?php require_once 'footer.php' ?>