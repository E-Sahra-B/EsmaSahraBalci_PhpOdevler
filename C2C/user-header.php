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