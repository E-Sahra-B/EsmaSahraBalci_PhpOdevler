<?php
require_once 'header.php';
$urunsor = $db->prepare("SELECT urun.*,kullanici.* 
FROM urun INNER JOIN kullanici ON urun.kullanici_id=kullanici.kullanici_id 
where urun_id=:id and urun_durum=:durum");
$urunsor->execute(array(
    'id' => $_POST['urun_id'],
    'durum' => 1
));
$uruncek = $urunsor->fetch(PDO::FETCH_ASSOC);
?>
<!-- Header Area End Here -->
<!-- Main Banner 1 Area Start Here -->
<div class="inner-banner-area">
    <div class="container">
        <div class="inner-banner-wrapper">
            <h2 style="color:white;">Ödeme Yapılacak Ürün: <?= $uruncek['urun_ad'] ?></h2>
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
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="inner-page-main-body">
                    <div class="single-banner">
                        <table id="cart" class="table table-hover table-condensed">
                            <thead>
                                <tr>
                                    <th style="width:50%">Ürün Bilgisi</th>
                                    <th style="width:22%" class="text-center">Satıcı</th>
                                    <th style="width:10%">Fiyat</th>
                                    <th style="width:8%">Miktar</th>
                                    <th style="width:10%"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td data-th="Product">
                                        <div class="row">
                                            <div class="col-sm-2 hidden-xs"><img style="width: 60px; height: 60px; " src="<?= $uruncek['urunfoto_resimyol']; ?>" alt="<?= $uruncek['urun_ad']; ?>" class="img-responsive" /></div>
                                            <div class="col-sm-10">
                                                <h4 class="nomargin"><?= $uruncek['urun_ad']; ?></h4>
                                                <p><?= mb_substr($uruncek['urun_detay'], 0, 150, 'UTF-8'); ?></p>
                                            </div>
                                        </div>
                                    </td>
                                    <td data-th="Subtotal" class="text-center"><?= $uruncek['kullanici_ad'] . " " . $uruncek['kullanici_soyad'] ?></td>
                                    <td data-th="Price"><?= number_format($uruncek['urun_fiyat'], 2, ',', '.'); ?> TL</td>
                                    <td data-th="Quantity"><input type="number" class="form-control text-center" value="1"></td>
                                    <td class="actions" data-th="">
                                        <button class="btn btn-info btn-sm"><i class="fa fa-refresh"></i></button>
                                        <button class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i></button>
                                    </td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr class="visible-xs">
                                    <td class="text-center"><strong>Total 1.99</strong></td>
                                </tr>
                                <tr>
                                    <!-- <td><button onclick="geridon()" class="btn btn-warning"><i class="fa fa-angle-left"></i> Geri Dön</button></td> -->
                                    <!-- <td><a href="javascript:window.history.back();" class="btn btn-warning"><i class="fa fa-angle-left"></i> Geri Dön</a></td> -->
                                    <td><button onclick="history.back();" class="btn btn-warning"><i class="fa fa-angle-left"></i> Geri Dön</button></td>
                                    <td colspan="2" class="hidden-xs"></td>
                                    <form action="admin/netting/kullanici.php" method="POST">
                                        <input type="hidden" name="kullanici_idsatici" value="<?= $uruncek['kullanici_id'] ?>">
                                        <td class="hidden-xs text-center"><strong>Toplam <?= number_format($uruncek['urun_fiyat'], 2, ',', '.') ?></strong></td>
                                        <input type="hidden" name="urun_id" value="<?= $uruncek['urun_id'] ?>">
                                        <input type="hidden" name="urun_fiyat" value="<?= $uruncek['urun_fiyat'] ?>">
                                        <td><button name="sipariskaydet" type="submit" class="btn btn-success btn-block">Siparişi Tamamla <i class="fa fa-angle-right"></i></button></td>
                                    </form>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Product Details Page End Here -->
    <?php require_once 'footer.php'; ?>
    <!-- <script type="text/javascript">
        function geridon() {
            window.history.back();
        }
    </script> -->