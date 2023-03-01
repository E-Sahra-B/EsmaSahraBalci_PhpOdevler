<?php
require_once 'header.php';

$urunsor = $db->prepare("SELECT urun.*,kullanici.* 
FROM urun 
INNER JOIN kullanici ON urun.kullanici_id=kullanici.kullanici_id 
where urun_id=:id and urun_durum=:durum");
$urunsor->execute(array(
    'id' => $_GET['urun_id'],
    'durum' => 1
));

$uruncek = $urunsor->fetch(PDO::FETCH_ASSOC);
?>
<!-- Header Area End Here -->
<!-- Main Banner 1 Area Start Here -->
<div class="inner-banner-area">
    <div class="container">
        <div class="inner-banner-wrapper">
            <p style="font-size: 32px;"><?= $uruncek['urun_ad'] ?></p>
        </div>
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
<!-- Product Details Page Start Here -->
<div class="product-details-page bg-secondary">
    <div class="container">
        <div class="row">
            <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12">
                <div class="inner-page-main-body">
                    <div class="single-banner">
                        <img src="<?= $uruncek['urunfoto_resimyol'] ?>" alt="product" class="img-responsive">
                    </div>
                    <div class="product-details-tab-area">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <ul class="product-details-title">
                                    <li class="active"><a href="#description" data-toggle="tab" aria-expanded="false">Ürün Açıklaması</a></li>
                                    <li><a href="#review" data-toggle="tab" aria-expanded="false">Yorumlar</a></li>
                                </ul>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="tab-content">
                                    <div class="tab-pane fade active in" id="description">
                                        <p><?= $uruncek['urun_detay'] ?></p>
                                    </div>
                                    <div class="tab-pane fade" id="review">
                                        <p>Porem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <div class="fox-sidebar">
                    <div class="sidebar-item">
                        <div class="sidebar-item-inner">
                            <h3 class="sidebar-item-title">
                                <p class="text-center">Ürün Fiyatı</p>
                            </h3>
                            <div class="text-center">
                                <b style="font-size:30px;"><?= number_format($uruncek['urun_fiyat'], 2, ",", ".") ?><span style="font-size:12px;"> TL</span></b>
                                <hr>
                            </div>
                            <ul class="sidebar-product-btn">
                                <li><a class="add-to-cart-btn" id="cart-button"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Satın Al</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="sidebar-item">
                        <div class="sidebar-item-inner">
                            <ul class="sidebar-sale-info">
                                <li><i class="fa fa-shopping-cart" aria-hidden="true"></i></li>
                                <li>05</li>
                                <li>Satış</li>
                            </ul>
                        </div>
                    </div>
                    <div class="sidebar-item">
                        <div class="sidebar-item-inner">
                            <h3 class="sidebar-item-title">Satıcı</h3>
                            <div class="sidebar-author-info">
                                <img src="img\profile\avatar.jpg" alt="product" class="img-responsive">
                                <div class="sidebar-author-content">
                                    <h3><?= $uruncek['kullanici_ad'] . " " . substr($uruncek['kullanici_soyad'], 0, 1) ?>.</h3>
                                    <a href="satici-<?= seo($uruncek['kullanici_ad'] . "-" . $uruncek['kullanici_soyad']) . "-" . $uruncek['kullanici_id'] ?>" class="view-profile">Profil Sayfası</a>
                                </div>
                            </div>
                            <!-- <ul class="sidebar-badges-item">
                                <li><img src="img\profile\badges1.png" alt="badges" class="img-responsive"></li>
                                <li><img src="img\profile\badges2.png" alt="badges" class="img-responsive"></li>
                                <li><img src="img\profile\badges3.png" alt="badges" class="img-responsive"></li>
                                <li><img src="img\profile\badges4.png" alt="badges" class="img-responsive"></li>
                                <li><img src="img\profile\badges5.png" alt="badges" class="img-responsive"></li>
                            </ul> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Product Details Page End Here -->
    <?php require_once 'footer.php' ?>