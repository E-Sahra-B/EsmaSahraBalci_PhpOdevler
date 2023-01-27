<div class="title-bg">
    <div class="title">Son Eklenen Ürünler</div>
</div>
<div class="row prdct"><!--Products-->
    <?php
    $sonurunsor = $db->prepare("SELECT * FROM urun order by urun_id DESC limit 6");
    $sonurunsor->execute();
    while ($sonuruncek = $sonurunsor->fetch(PDO::FETCH_ASSOC)) {
    ?>
        <div class="col-md-4">
            <div class="productwrap">
                <div class="pr-img">
                    <a href="urun-<?= seo($sonuruncek["urun_ad"]) . '-' . $sonuruncek["urun_id"] ?>"><img src="
								<?php
                                $sonurun_id = $sonuruncek['urun_id'];
                                $sonurunfotosor = $db->prepare("SELECT * FROM urunfoto where urun_id=:urun_id order by urunfoto_sira ASC limit 1 ");
                                $sonurunfotosor->execute(array(
                                    'urun_id' => $sonurun_id
                                ));
                                $sonurunfotocek = $sonurunfotosor->fetch(PDO::FETCH_ASSOC);
                                if (!empty($sonurunfotocek['urunfoto_resimyol'])) {
                                    echo $sonurunfotocek['urunfoto_resimyol'];
                                } else {
                                    echo "img\logo-yok.png";
                                }
                                ?>
								" alt="" class="img-responsive"></a>
                    <div class="pricetag">
                        <div class="inner"> <?php echo number_format($sonuruncek['urun_fiyat'], 2, ',', '.'); ?></div>
                    </div>
                </div>
                <span class="smalltitle"><a href="#>"><?php echo substr($sonuruncek['urun_ad'], 0, 15) ?></span>
                <span class="smalldesc">Item no.: <?php echo $sonuruncek['urun_id'] ?></span>
            </div>
        </div>
    <?php } ?>

</div>