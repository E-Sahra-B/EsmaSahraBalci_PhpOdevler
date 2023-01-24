<?php require_once 'header.php' ?>
<div class="container">
	<div class="clearfix"></div>
	<div class="lines"></div>
</div>
<div class="container">
	<br>
	<?php
	if ($_GET['sil'] == "ok") { ?>
		<div class="alert alert-info alert-dismissible">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			Sepetten Ürün Silme İşlemi Başarılı
		</div>
	<?php } elseif ($_GET['sil'] == "no") { ?>
		<div class="alert alert-danger">İşlem Başarısız
		</div>
	<?php }
	?>
	<div class="title-bg">
		<div class="title">Alışveriş Sepetim</div>
	</div>
	<div class="table-responsive">
		<table class="table table-bordered chart">
			<thead>
				<tr>
					<th>İptal</th>
					<th>Ürün Resim</th>
					<th>Ürün ad</th>
					<th>Ürün Kodu</th>
					<th>Adet</th>
					<th>Toplam Fiyat</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$kullanici_id = $kullanicicek['kullanici_id'];
				$sepetsor = $db->prepare("SELECT * FROM sepet where kullanici_id=:id");
				$sepetsor->execute(array(
					'id' => $kullanici_id
				));
				while ($sepetcek = $sepetsor->fetch(PDO::FETCH_ASSOC)) {
					$urun_id = $sepetcek['urun_id'];
					$urunsor = $db->prepare("SELECT * FROM urun where urun_id=:urun_id");
					$urunsor->execute(array(
						'urun_id' => $urun_id
					));
					$uruncek = $urunsor->fetch(PDO::FETCH_ASSOC);
					$toplamFiyat += $uruncek['urun_fiyat'] * $sepetcek['urun_adet'];
				?>
					<tr>
						<td style="vertical-align: middle;">
							<a href="admin/netting/islem.php?sepet_id=<?php echo $sepetcek['sepet_id']; ?>&sepetsil=ok">
								<button class="btn btn-danger btn-sm">✖</button>
							</a>
						</td>
						<td><img src="img\logo-yok.png" width="100" alt=""></td>
						<td style="vertical-align: middle;"><?php echo $uruncek['urun_ad'] ?></td>
						<td style="vertical-align: middle;"><?php echo $uruncek['urun_id'] ?></td>
						<td style="vertical-align: middle;" width="100">
							<form action="admin/netting/islem.php" method="GET">
								<input style="width: 40px; height:31px;" min="1" type="number" name="urun_adet" value="<?php echo $sepetcek['urun_adet'] ?>">
								<a href="admin/netting/islem.php?urun_id=<?php echo $sepetcek['urun_id']; ?>">
									<button class="btn btn-success btn-sm" name="sepetduzenle">↻</button>
								</a>
								<input type="hidden" name="urun_id" value="<?php echo $sepetcek['urun_id'] ?>">
							</form>
						</td>
						<td style="vertical-align: middle;"><?php echo $uruncek['urun_fiyat'] ?></td>
					</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
	<div class="row">
		<div class="col-md-6">
		</div>
		<div class="col-md-3 col-md-offset-3">
			<div class="subtotal-wrap">
				<div class="subtotal">
					<p>Ara Fiyat : <span class="bigprice"><?php echo number_format(($toplamFiyat / 1.18), 2, ',', '.'); ?></span></p>
					<p>Kdv Toplam %18 : <span class="bigprice"><?php echo number_format(($toplamFiyat - ($toplamFiyat / 1.18)), 2, ',', '.') ?></span></p>
				</div>
				<div class="total">Toplam Fiyat : <span class="bigprice"><?php echo number_format($toplamFiyat, 2, ',', '.'); ?></span></div>
				<div class="clearfix"></div>
				<a href="kategoriler" class="btn btn-info pull-right btn-block">Alışverişe Devam ➤</a>
				<br><br>
				<a href="" class="btn btn-primary pull-right btn-block"> Ödeme Sayfası ➤➤</a>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
	<div class="spacer"></div>
</div>
<?php require_once 'footer.php' ?>