<?php
require_once 'header.php';
if (isset($_POST['arama'])) {
	$aranan = $_POST['aranan'];
	$urunsor = $db->prepare("SELECT * FROM urun where urun_ad LIKE ?");
	$urunsor->execute(array("%$aranan%"));
	$say = $urunsor->rowCount();
} else {
	$urunsor = $db->prepare("SELECT * FROM urun");
	$urunsor->execute();
}
?>
<div class="container">
	<div class="clearfix"></div>
	<div class="lines"></div>
</div>
<div class="container">
	<div class="row">
		<div class="col-md-9"><!--Main content-->
			<div class="title-bg">
				<div class="title">Ürünler</div>
			</div>
			<div class="row prdct"><!--Products-->
				<?php
				if ($say == 0) {
					echo "Bu kategoride ürün bulunamadı";
				}
				while ($uruncek = $urunsor->fetch(PDO::FETCH_ASSOC)) {
				?>
					<div class="col-md-4">
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
								<div class="pricetag on-sale">
									<div class="inner on-sale">
										<span class="onsale">
											<span class="oldprice">
												<?php echo number_format(($uruncek['urun_fiyat'] * 1.50), 2, ',', '.');   ?>
											</span>
											<?php echo number_format($uruncek['urun_fiyat'], 2, ',', '.'); ?>
										</span>
									</div>
								</div>
							</div>
							<span class="smalltitle"><a href="#>"><?php echo substr($uruncek['urun_ad'], 0, 15) ?></a></span>
							<span class="smalldesc">Ürün Kodu.: <?php echo $uruncek['urun_id'] ?></span>
						</div>
					</div>
				<?php } ?>

			</div><!--Products-->
			<!-- 
				<ul class="pagination shop-pag">
					<li><a href="#"><i class="fa fa-caret-left"></i></a></li>
					<li><a href="#">1</a></li>
					<li><a href="#">2</a></li>
					<li><a href="#">3</a></li>
					<li><a href="#">4</a></li>
					<li><a href="#">5</a></li>
					<li><a href="#"><i class="fa fa-caret-right"></i></a></li>
				</ul> -->
		</div>
		<?php require_once 'sidebar.php' ?>
	</div>
	<div class="spacer"></div>
</div>
<?php require_once 'footer.php'; ?>