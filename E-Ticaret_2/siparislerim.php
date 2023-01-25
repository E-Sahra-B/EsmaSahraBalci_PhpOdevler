<?php
ob_start();
session_start();
error_reporting(0);
require_once 'header.php';
?>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="page-title-wrap">
				<div class="page-title-inner">
					<div class="row">
						<div class="col-md-12">
							<div class="bigtitle">Sipariş Bilgilerim</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="title-bg">
				<div class="title">Sipariş Bilgileri</div>
			</div>
			<div class="table-responsive">
				<table class="table table-bordered chart">
					<thead>
						<tr>
							<th>Sipariş No</th>
							<th>Tarih</th>
							<th>Tutar</th>
							<th>Ödeme Tip</th>
							<th>Durum</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						<?php
						$kullanici_id = $kullanicicek['kullanici_id'];
						$siparissor = $db->prepare("SELECT * FROM siparis where kullanici_id=:id");
						$siparissor->execute(array(
							'id' => $kullanici_id
						));
						while ($sipariscek = $siparissor->fetch(PDO::FETCH_ASSOC)) { ?>
							<tr>
								<td><?php echo $sipariscek['siparis_id']; ?></td>
								<td><?php echo date("d.m.Y - H:i", strtotime($sipariscek['siparis_zaman'])); ?></td>
								<td><?php echo number_format($sipariscek['siparis_toplam'], 2, ',', '.'); ?></td>
								<td><?php echo $sipariscek['siparis_tip']; ?></td>
								<td>İşleminiz Alınmıştır.</td>
								<td><a href="siparis-detay.php?siparisid=<?php echo $sipariscek['siparis_id']; ?>"><button type="submit" class="btn btn-info btn-xs">Sipariş Detayı</button></a></td>
							</tr>
						<?php } ?>
					</tbody>
				</table>
				<br>
			</div>
			<br>
		</div>
	</div>
</div>

<div class="spacer"></div>
</div>
<?php require_once 'footer.php'; ?>