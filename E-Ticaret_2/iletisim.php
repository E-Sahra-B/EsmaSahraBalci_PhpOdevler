<?php
$title = "İletişim Sayfası";
require_once 'header.php';
?>
<div class="container">
	<div class="clearfix"></div>
	<div class="lines"></div>
</div>
<div class="container">
	<div class="row">
	</div>
	<div class="title-bg">
		<div class="title">İletişim Sayfası</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d385396.60596766684!2d29.01217945!3d41.0053215!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x14caa7040068086b%3A0xe1ccfe98bc01b0d0!2zxLBzdGFuYnVs!5e0!3m2!1str!2str!4v1674705068387!5m2!1str!2str" width="900" height="400" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
		</div>
	</div>
	<div class="row">
		<div class="title-bg">
			<div class="title">İletişim Bilgileri & Formu</div>
		</div>
		<div class="col-md-4">
			<p class="page-content">
			</p>
			<ul class="contact-widget">
				<li class="fphone"><?php echo  $ayarcek['ayar_tel'] ?></li>
				<li class="fmobile"><?php echo  $ayarcek['ayar_gsm'] ?></li>
				<li class="fmail lastone"><?php echo  $ayarcek['ayar_mail'] ?></li>
			</ul>
			<div class="pull-left">
				<ul class="text-muted" style="margin-top: 75px;">Bizi Takip Edin</ul>
				<ul class="fsoc">
					<a href="http://<?php echo $ayarcek['ayar_twitter']; ?>" class="ftwitter">twitter</a>
					<a href="http://<?php echo $ayarcek['ayar_facebook']; ?>" class="ffacebook">facebook</a>
					<a href="http://<?php echo $ayarcek['ayar_youtube']; ?>" class="fflickr">Youtube</a>
					<a href="http://<?php echo $ayarcek['ayar_google']; ?>" class="ffeed">Google</a>
				</ul>
			</div>
		</div>
		<div class="col-md-7 col-md-offset-1">
			<div class="qc">
				<form action="http://www.blank.com.tr/btest/mailphp/mail.php" method="POST" role="form">
					<div class="form-group">
						<label for="name">Ad Soyad<span>*</span></label>
						<input type="text" name="adsoyad" class="form-control" id="name">
					</div>
					<div class="form-group">
						<label for="email">Mail<span>*</span></label>
						<input type="email" name="email" class="form-control" id="email">
					</div>
					<div class="form-group">
						<label for="text">Mesaj<span>*</span></label>
						<textarea name="mesaj" class="form-control" id="text"></textarea>
					</div>
					<?php
					$sayi1 = rand(10, 30);
					$sayi2 = rand(0, 10);
					$toplam = $sayi1 + $sayi2;
					?>
					<input type="hidden" value="<?php echo $toplam; ?>" name="toplam">
					<div class="form-group">
						<label for="name">İşlem Sonucu?<span>*</span></label>
						<input type="text" name="islem" placeholder="<?php echo $sayi1 . " + " . $sayi2 . " kaçtır ?";  ?>" class="form-control" id="name">
					</div>
					<button type="submit" class="btn btn-default btn-red btn-sm">Formu Gönder</button>
				</form>
			</div>
		</div>
	</div>

	<div class="spacer"></div>
</div>
<?php require_once 'footer.php' ?>