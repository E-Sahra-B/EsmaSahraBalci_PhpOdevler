<?php require_once 'header.php' ?>
<!-- Header Area End Here -->
<?php require_once 'search.php' ?>
<!-- Inner Page Banner Area Start Here -->
<div class="pagination-area bg-secondary">
    <div class="container">
        <div class="pagination-wrapper">
        </div>
    </div>
</div>
<!-- Inner Page Banner Area End Here -->
<!-- Product Page Grid Start Here -->
<div class="product-page-list bg-secondary section-space-bottom">
    <div class="container">
        <div class="row">
            <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12 col-lg-push-3 col-md-push-4 col-sm-push-4">
                <div class="inner-page-main-body">
                    <!-- <div class="page-controls">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-8">
                                <div class="page-controls-sorting">
                                    <div class="dropdown">
                                        <button class="btn sorting-btn dropdown-toggle" type="button" data-toggle="dropdown">Default Sorting<i class="fa fa-sort" aria-hidden="true"></i></button>
                                        <ul class="dropdown-menu">
                                            <li><a href="#">Date</a></li>
                                            <li><a href="#">Best Sale</a></li>
                                            <li><a href="#">Rating</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-4">
                                <div class="layout-switcher">
                                    <ul>
                                        <li><a href="#gried-view" data-toggle="tab" aria-expanded="false"><i class="fa fa-th-large"></i></a></li>
                                        <li class="active"><a href="#list-view" data-toggle="tab" aria-expanded="true"><i class="fa fa-list"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div> -->
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane fade in active clear products-container" id="list-view">
                            <div class="product-list-view">
                                <?php
                                if (isset($_GET['kategori_id'])) {
                                    $sayfada = 6;
                                    $sorgu = $db->prepare("select * from urun where kategori_id=:kategori_id");
                                    $sorgu->execute(array(
                                        'kategori_id' => $_GET['kategori_id']
                                    ));
                                    $toplam_icerik = $sorgu->rowCount();
                                    $toplam_sayfa = ceil($toplam_icerik / $sayfada);
                                    $sayfa = isset($_GET['sayfa']) ? (int) $_GET['sayfa'] : 1;
                                    if ($sayfa < 1) $sayfa = 1;
                                    if ($sayfa > $toplam_sayfa) $sayfa = $toplam_sayfa;
                                    $limit = ($sayfa - 1) * $sayfada;
                                    $urunsor = $db->prepare("SELECT urun.*,kategori.*,kullanici.* 
                                    FROM urun 
                                    INNER JOIN kategori ON urun.kategori_id=kategori.kategori_id 
                                    INNER JOIN kullanici ON urun.kullanici_id=kullanici.kullanici_id 
                                    WHERE urun_durum=:urun_durum and kategori.kategori_id=:kategori_id 
                                    order by urun_zaman 
                                    DESC 
                                    limit $limit,$sayfada");
                                    $urunsor->execute(array(
                                        'urun_durum' => 1,
                                        'kategori_id' => $_GET['kategori_id']
                                    ));
                                    $say = $sorgu->rowCount();
                                    if ($say == 0) {
                                        echo "Bu kategoride ürün Bulunamadı";
                                    }
                                } else {
                                    $sayfada = 6;
                                    $sorgu = $db->prepare("select * from urun");
                                    $sorgu->execute();
                                    $toplam_icerik = $sorgu->rowCount();
                                    $toplam_sayfa = ceil($toplam_icerik / $sayfada);
                                    $sayfa = isset($_GET['sayfa']) ? (int) $_GET['sayfa'] : 1;
                                    if ($sayfa < 1) $sayfa = 1;
                                    if ($sayfa > $toplam_sayfa) $sayfa = $toplam_sayfa;
                                    $limit = ($sayfa - 1) * $sayfada;
                                    $urunsor = $db->prepare("SELECT urun.urun_ad,urun.urun_fiyat,urun.urunfoto_resimyol,urun.urun_durum,urun.urun_onecikar,urun.urun_zaman,
                                    urun.urun_id,urun.kategori_id,urun.kullanici_id,
                                    kategori.kategori_ad,
                                    kullanici.kullanici_ad,kullanici.kullanici_soyad,kullanici.kullanici_magazafoto 
                                    FROM urun 
                                    INNER JOIN kategori ON urun.kategori_id=kategori.kategori_id 
                                    INNER JOIN kullanici ON urun.kullanici_id=kullanici.kullanici_id 
                                    WHERE urun_durum=:urun_durum and urun_onecikar=:urun_onecikar 
                                    order by urun_zaman 
                                    DESC limit $limit,$sayfada");
                                    $urunsor->execute(array(
                                        'urun_durum' => 1,
                                        'urun_onecikar' => 1
                                    ));
                                    $say = $sorgu->rowCount();
                                    if ($say == 0) {
                                        echo "Bu kategoride ürün Bulunamadı";
                                    }
                                }
                                while ($uruncek = $urunsor->fetch(PDO::FETCH_ASSOC)) {
                                ?>
                                    <div class="single-item-list">
                                        <div class="item-img">
                                            <img style="width: 238px; height: 178px;" src="<?= $uruncek['urunfoto_resimyol'] ?>" alt="<?= $uruncek['urun_ad'] ?>" class="img-responsive">
                                            <!-- <div class="trending-sign" data-tips="Trending"><i class="fa fa-bolt" aria-hidden="true"></i></div>-->
                                        </div>
                                        <div class="item-content">
                                            <div class="item-info">
                                                <div class="item-title">
                                                    <h3><a href="urun-<?= seo($uruncek['urun_ad']) . "-" . $uruncek['urun_id'] ?>"><?= $uruncek['urun_ad'] ?></a></h3>
                                                    <span><?= $uruncek['kategori_ad'] ?></span>
                                                </div>
                                                <div class="item-sale-info">
                                                    <div class="price"><small><?= number_format($uruncek['urun_fiyat'], 2, ",", ".") ?></small></div>
                                                    <div class="sale-qty">Satış ( 0 )</div>
                                                </div>
                                            </div>
                                            <div class="item-profile">
                                                <div class="profile-title">
                                                    <div class="img-wrapper"><img src="img\profile\1.jpg" alt="profile" class="img-responsive img-circle"></div>
                                                    <span><?= $uruncek['kullanici_ad'] . " " . substr($uruncek['kullanici_soyad'], 0, 1) ?>.</span>
                                                </div>
                                                <div class="profile-rating-info">
                                                    <ul>
                                                        <li>
                                                            <ul class="profile-rating">
                                                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                                <li>(<span> 05</span> )</li>
                                                            </ul>
                                                        </li>
                                                        <li><i class="fa fa-comment-o" aria-hidden="true"></i>( 10 )</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <ul class="pagination-align-left">
                                            <?php
                                            $s = 0;
                                            while ($s < $toplam_sayfa) {
                                                $s++; ?>
                                                <?php
                                                if (!empty($_GET['kategori_id'])) {
                                                    $active = ($s == $sayfa) ? 'background-color: #e74c3c; color:#fff;' : ''; ?>
                                                    <li><a style="<?= $active ?>" href="kategoriler-<?= $_GET['sef']; ?>-<?= $_GET['kategori_id'] ?>?sayfa=<?= $s; ?>"><?= $s; ?></a></li>
                                                <?php
                                                } else { ?>
                                                    <li><a style="<?= $active ?>" href="kategoriler?sayfa=<?= $s; ?>"><?= $s; ?></a></li>
                                                <?php } ?>
                                            <?php } ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12 col-lg-pull-9 col-md-pull-8 col-sm-pull-8">
                <?php require_once 'sidebar.php' ?>
            </div>
        </div>
    </div>
</div>
<!-- Product Page Grid End Here -->
<?php require_once 'footer.php' ?>