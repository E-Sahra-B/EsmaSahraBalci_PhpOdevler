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
                    <div class="price"><small><?= fiyat($uruncek['urun_fiyat']) ?></small></div>
                    <div class="sale-qty">Satış (
                        <?php
                        $urunsay = $db->prepare("SELECT COUNT(urun_id) as say FROM siparis_detay where urun_id=:id");
                        $urunsay->execute(array(
                            'id' => $uruncek['urun_id']
                        ));
                        $urunsaycek = $urunsay->fetch(PDO::FETCH_ASSOC);
                        echo $urunsaycek['say'];
                        ?> )</div>
                </div>
            </div>
            <div class="item-profile">
                <div class="profile-title">
                    <div class="img-wrapper"><img src="<?= $uruncek['kullanici_magazafoto'] ?>" alt="profile" class="img-responsive img-circle"></div>
                    <span><?= $uruncek['kullanici_ad'] . " " . substr($uruncek['kullanici_soyad'], 0, 1) ?>.</span>
                </div>
                <div class="profile-rating-info">
                    <ul>
                        <li>
                            <?php
                            $yorumsor = $db->prepare("SELECT yorumlar.*,kullanici.* 
                            FROM yorumlar 
                            INNER JOIN kullanici ON yorumlar.kullanici_id=kullanici.kullanici_id 
                            where urun_id=:id order by yorum_zaman DESC");
                            $yorumsor->execute(array(
                                'id' => $uruncek['urun_id']
                            ));
                            $yorumcek = $yorumsor->fetch(PDO::FETCH_ASSOC);
                            ?>
                            <ul class="profile-rating">
                                <?php
                                for ($i = 1; $i <= $yorumcek['yorum_puan']; $i++) { ?>
                                    <li><i class='fa fa-star' aria-hidden='true'></i></li>
                                <?php }
                                for ($j = 1; $j <= 5 - ($yorumcek['yorum_puan']); $j++) { ?>
                                    <li><i class="fa fa-star-o" aria-hidden="true"></i></li>
                                <?php } ?>
                                <li>(<span> <?= $yorumcek['yorum_puan'] ?></span> )</li>
                            </ul>
                        </li>
                        <li><i class="fa fa-comment-o" aria-hidden="true"></i>( 10 )</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
<?php } ?>