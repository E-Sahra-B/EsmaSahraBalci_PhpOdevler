<?php require_once 'header.php';
// if (empty($_POST)) {
//     Header("Location:404.php");
//     exit;
// }
?>
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
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane fade in active clear products-container" id="list-view">
                            <div class="product-list-view">
                                <?php
                                if (isset($_POST['searchsayfa'])) {
                                    $searchkeyword = $_POST['searchkeyword'];
                                    $sayfada = 5;
                                    $sorgu = $db->prepare("SELECT * from urun where urun_ad like ? or  urun_detay like ?");
                                    $sorgu->execute(array(
                                        "%$searchkeyword%",
                                        "%$searchkeyword%"
                                    ));
                                    $toplam_icerik = $sorgu->rowCount();
                                    $toplam_sayfa = ceil($toplam_icerik / $sayfada);
                                    $sayfa = isset($_GET['sayfa']) ? (int) $_GET['sayfa'] : 1;
                                    if ($sayfa < 1) $sayfa = 1;
                                    if ($sayfa > $toplam_sayfa) $sayfa = $toplam_sayfa;
                                    $limit = ($sayfa - 1) * $sayfada;
                                    // $urunsor = $db->prepare("SELECT urun.*,kategori.*,kullanici.* 
                                    // FROM urun 
                                    // INNER JOIN kategori ON urun.kategori_id=kategori.kategori_id 
                                    // INNER JOIN kullanici ON urun.kullanici_id=kullanici.kullanici_id 
                                    // WHERE urun_durum=:urun_durum and urun.urun_ad 
                                    // LIKE '%$searchkeyword%' 
                                    // order by urun_zaman 
                                    // DESC limit $limit,$sayfada ");
                                    // $urunsor->execute(array(
                                    //     'urun_durum' => 1
                                    // ));
                                    $urunsor = $db->prepare("SELECT * FROM urun 
                                    INNER JOIN kategori ON urun.kategori_id=kategori.kategori_id 
                                    INNER JOIN kullanici ON urun.kullanici_id=kullanici.kullanici_id
                                    WHERE urun.urun_ad LIKE '%$searchkeyword%' ");
                                    $urunsor->execute(array(
                                        'urun_durum' => 1
                                    ));
                                }
                                $say = $sorgu->rowCount();
                                if ($say == 0) {
                                    echo "Aradığınız Ürün Bulunamadı.";
                                }
                                require 'kategoriIcerik.php';
                                ?>
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