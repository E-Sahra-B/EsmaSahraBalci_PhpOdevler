<?php
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