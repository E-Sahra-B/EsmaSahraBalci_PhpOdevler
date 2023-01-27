<?php
require_once 'header.php';
?>
<div class="container">
	<div class="clearfix"></div>
	<div class="lines"></div>
	<?php require_once 'slider.php'; ?>
</div>
<div class="f-widget featpro">
	<div class="container">
		<div class="title-widget-bg">
			<div class="title-widget">Öne Çıkan Ürünler</div>
			<div class="carousel-nav">
				<a class="prev"></a>
				<a class="next"></a>
			</div>
		</div>
		<div id="product-carousel" class="owl-carousel owl-theme">
			<?php
			$urunsor = $db->prepare("SELECT * FROM urun where urun_durum=:urun_durum and urun_onecikar=:urun_onecikar");
			$urunsor->execute(array(
				'urun_durum' => 1,
				'urun_onecikar' => 1
			));
			while ($uruncek = $urunsor->fetch(PDO::FETCH_ASSOC)) { ?>
				<div class="item animated bounce">
					<div class="productwrap">
						<div class="pr-img">
							<div class="hot"></div>
							<a href="urun-<?= seo($uruncek["urun_ad"]) . '-' . $uruncek["urun_id"] ?>">
								<img src="
								<?php
								$urun_id = $uruncek['urun_id'];
								$urunfotosor = $db->prepare("SELECT * FROM urunfoto where urun_id=:urun_id order by urunfoto_sira ASC limit 1 ");
								$urunfotosor->execute(array(
									'urun_id' => $urun_id
								));
								$urunfotocek = $urunfotosor->fetch(PDO::FETCH_ASSOC);
								if (!empty($urunfotocek['urunfoto_resimyol'])) {
									echo $urunfotocek['urunfoto_resimyol'];
								} else {
									echo "img\logo-yok.png";
								}
								?>
								" alt="" class="img-responsive"></a>
							<div class="pricetag blue">
								<div class="inner"><span><?php echo number_format($uruncek['urun_fiyat'], 2, ',', '.'); ?></span></div>
							</div>
						</div>
						<span class="smalltitle"><a href="urun-<?= seo($uruncek["urun_ad"]) . '-' . $uruncek["urun_id"] ?>">
								<?php echo substr($uruncek['urun_ad'], 0, 15) ?></a></span>
						<span class="smalldesc">Ürün Kodu.: <?php echo $uruncek['urun_id'] ?></span>
					</div>
				</div>
			<?php } ?>
		</div>
	</div>
</div>
<div class="container">
	<div class="row">
		<div class="col-md-9">
			<!--Main content-->
			<div class="title-bg">
				<div class="title">Hakkımızda Bilgi</div>
			</div>
			<p class="ct">
				<?php
				$hakkimizdasor = $db->prepare("SELECT * FROM hakkimizda where hakkimizda_id=:id");
				$hakkimizdasor->execute(array(
					'id' => 0
				));
				$hakkimizdacek = $hakkimizdasor->fetch(PDO::FETCH_ASSOC);
				echo substr($hakkimizdacek['hakkimizda_icerik'], 0, 1000) ?>
			</p>
			<a href="hakkimizda" class="btn btn-default btn-info btn-sm">Devamını Oku</a>
			<!--Products-->
			<?php require_once 'soneklenenurun.php'; ?>
			<div class="spacer"></div>
		</div><!--Main content-->
		<!-- Siderbar kısmı-->
		<?php require_once 'sidebar.php'; ?>
	</div>
</div>
<?php require_once 'footer.php'; ?>