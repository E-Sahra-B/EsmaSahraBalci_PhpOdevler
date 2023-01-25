<?php require_once 'header.php' ?>
<div class="container">
	<div class="clearfix"></div>
	<div class="lines"></div>
</div>
<div class="container">
	<?php
	if ($_GET['durum'] == "no") { ?>
		<div class="alert alert-danger">Ödeme İşlem Başarısız</div>
	<?php } ?>
	<div class="title-bg">
		<div class="title">Ödeme Sayfası</div>
	</div>
	<div class="table-responsive">
		<table class="table table-bordered chart">
			<thead>
				<tr>
					<th>Ürün Resim</th>
					<th>Ürün ad</th>
					<th>Ürün Kodu</th>
					<th>Adet</th>
					<th>Toplam Fiyat</th>
				</tr>
			</thead>
			<form action="admin/netting/islem.php" method="POST">
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
						<!--<input type="hidden" name="urun_id[]" value="<?php echo $uruncek['urun_id']; ?>">-->
						<tr>
							<td><img src="
							<?php
							$urun_id = $sepetcek['urun_id'];
							$urunfotosor = $db->prepare(" SELECT * FROM urunfoto where urun_id=:urun_id order by urunfoto_sira ASC limit 1 ");
							$urunfotosor->execute(array(
								'urun_id' => $urun_id
							));
							$urunfotocek = $urunfotosor->fetch(PDO::FETCH_ASSOC);
							if (!empty($urunfotocek['urunfoto_resimyol'])) {
								echo $urunfotocek['urunfoto_resimyol'];
							} else {
								echo " img\logo-yok.png";
							} ?>
							" width="100" alt=""></td>
							<td style="vertical-align: middle;"><?php echo $uruncek['urun_ad'] ?></td>
							<td style="vertical-align: middle;"><?php echo $uruncek['urun_id'] ?></td>
							<td style="vertical-align: middle;"><?php echo $sepetcek['urun_adet'] ?></td>
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
				<!-- <a href="" class="btn btn-primary pull-right btn-block"> Ödeme Sayfası ➤➤</a> -->
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
	<div class="tab-review">
		<ul id="myTab" class="nav nav-tabs shop-tab">
			<li><a href="#desc" data-toggle="tab">Kredi Kartı</a></li>
			<li class="active"><a href="#rev" data-toggle="tab">Banka Havalesi </a></li>
		</ul>
		<div id="myTabContent" class="tab-content shop-tab-ct">
			<div class="tab-pane fade" id="desc">
				<p>
					Entegrasyon Tamamlanmadı.
				</p>
			</div>
			<div class="tab-pane fade active in " id="rev">
				<form action="admin/netting/islem.php" method="POST">
					<p>Ödeme yapacağınız hesap numarasını seçerek işlemi tamamlayınız.</p>
					<?php
					$bankasor = $db->prepare("SELECT * FROM banka order by banka_id ASC");
					$bankasor->execute();
					while ($bankacek = $bankasor->fetch(PDO::FETCH_ASSOC)) { ?>
						<input type="radio" name="siparis_banka" value="<?php echo $bankacek['banka_ad'] ?>">
						<?php echo $bankacek['banka_ad'];
						echo " "; ?><br>
					<?php } ?>
					<input type="hidden" name="kullanici_id" value="<?php echo $kullanicicek['kullanici_id'] ?>">
					<input type="hidden" name="siparis_toplam" value="<?php echo $toplam_fiyat ?>">
					<hr>
					<button class="btn btn-success" type="submit" name="bankasiparisekle">Sipariş Ver</button>
				</form>
			</div>
		</div>
	</div>
	<div class="spacer"></div>
</div>
<?php require_once 'footer.php' ?>