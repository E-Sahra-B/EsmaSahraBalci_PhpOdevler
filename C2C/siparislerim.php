<?php
require_once 'header.php';
giriskontrol();
?>
<!-- Header Area End Here -->
<!-- Inner Page Banner Area Start Here -->
<div class="pagination-area bg-secondary">
    <div class="container">
        <div class="pagination-wrapper">
        </div>
    </div>
</div>
<!-- Inner Page Banner Area End Here -->
<!-- Settings Page Start Here -->
<div class="settings-page-area bg-secondary section-space-bottom">
    <div class="container">
        <div class="row settings-wrapper">
            <?php require_once 'hesap-sidebar.php' ?>
            <div class="col-lg-9 col-md-9 col-sm-8 col-xs-12">
                <div class="settings-details tab-content">
                    <div class="tab-pane fade active in" id="Personal">
                        <h2 class="title-section">Siparişlerim</h2>
                        <div class="personal-info inner-page-padding">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Sipariş Tarihi</th>
                                        <th scope="col">Ürün Adı</th>
                                        <th scope="col">Ürün Fiyatı</th>
                                        <th scope="col">Sipariş Durumu</th>
                                        <th scope="col">Detay</th>
                                        <th scope="col">Puan / Yorum</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $siparissor = $db->prepare("SELECT siparis.*, siparis_detay.*,urun.* FROM siparis
                                    INNER JOIN siparis_detay ON siparis.siparis_id=siparis_detay.siparis_id
                                    INNER JOIN urun ON urun.urun_id=siparis_detay.urun_id 
                                    WHERE siparis.kullanici_id=:kullanici_id order by siparis_zaman DESC");
                                    $siparissor->execute(array(
                                        'kullanici_id' => $_SESSION['userkullanici_id']
                                    ));
                                    $say = 0;
                                    while ($sipariscek = $siparissor->fetch(PDO::FETCH_ASSOC)) {
                                        $say++ ?>
                                        <tr>
                                            <th scope="row"><?= $say ?></th>
                                            <td><?= tarih($sipariscek['siparis_zaman']) ?></td>
                                            <td><?= $sipariscek['urun_ad'] ?></td>
                                            <td><?= fiyat($sipariscek['urun_fiyat']) ?></td>
                                            <!-- <td><?= $sipariscek['siparisdetay_onay'] ?></td> -->
                                            <td>
                                                <?php if ($sipariscek['siparisdetay_onay'] == 1) : ?>
                                                    <a href="javascript:void(0);" class="btn btn-info btn-xs"> Ödemesini Yap</a>
                                                <?php elseif ($sipariscek['siparisdetay_onay'] == 2) : ?>
                                                    <a href="javascript:void(0);" class="btn btn-success btn-xs"> Tamamlandı</a>
                                                <?php elseif ($sipariscek['siparisdetay_onay'] == 0) : ?>
                                                    <a href="javascript:void(0);" class="btn btn-warning btn-xs"> Teslim Edilmesi Bekleniyor</a>
                                                <?php endif ?>
                                            </td>
                                            <td><a href="siparis-detay?siparis_id=<?= $sipariscek['siparis_id'] ?>"><button class="btn btn-primary btn-xs">Detay</button></a></td>
                                            <td>
                                                <?php if ($sipariscek['siparisdetay_onay'] == 2 and $sipariscek['siparisdetay_yorum'] == 0) : ?>
                                                    <a href="siparis-detay?siparis_id=<?= $sipariscek['siparis_id'] ?>"><button class="btn btn-info btn-xs">Puan / Yorum</button></a>
                                                <?php endif ?>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Settings Page End Here -->
<?php require_once 'footer.php'; ?>