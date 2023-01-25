<?php
$title = "Kullanıcı Bilgi Güncelle";
require_once 'header.php';
?>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="page-title-wrap">
				<div class="page-title-inner">
					<div class="row">
						<div class="col-md-12">
							<div class="bigtitle">Hesap Bilgilerim</div>
							<p>Bilgilerinizi aşağıdan düzenleyebilirsiniz...</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<form action="admin/netting/islem.php" method="POST" class="form-horizontal checkout" role="form">
		<div class="row">
			<div class="col-md-6">
				<div class="title-bg">
					<div class="title">Kayıt Bilgileri</div>
				</div>
				<?php
				if ($_GET['durum'] == "farklisifre") { ?>
					<div class="alert alert-danger alert-dismissible">
						<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						<strong>Hata!</strong> Girdiğiniz şifreler birbiriyle eşleşmiyor.
					</div>
				<?php } elseif ($_GET['durum'] == "eksiksifre") { ?>
					<div class="alert alert-danger alert-dismissible">
						<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						<strong>Hata!</strong> Şifreniz minimum 6 karakter uzunluğunda olmalıdır.
					</div>
				<?php } elseif ($_GET['durum'] == "mukerrerkayit") { ?>
					<div class="alert alert-danger alert-dismissible">
						<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						<strong>Hata!</strong> Bu kullanıcı daha önce kayıt edilmiş.
					</div>
				<?php } elseif ($_GET['durum'] == "eskisifreyanlis") { ?>
					<div class="alert alert-danger alert-dismissible">
						<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						<strong>Hata!</strong> Girdiğiniz eski şifre hatalı.
					</div>
				<?php } elseif ($_GET['durum'] == "no") { ?>
					<div class="alert alert-danger alert-dismissible">
						<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						<strong>Hata!</strong> Kayıt Yapılamadı Sistem Yöneticisine Danışınız.
					</div>
				<?php } elseif ($_GET['durum'] == "ok") { ?>
					<div class="alert alert-success alert-dismissible">
						<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						<strong>Başarılı!</strong> Güncelleme İşlemi Başarıyla Yapılmıştır.
					</div>
				<?php }
				?>
				<div class="form-group dob">
					<div class="col-sm-12">
						<input type="text" class="form-control" name="kullanici_adsoyad" value="<?php echo $kullanicicek['kullanici_adsoyad'] ?>">
					</div>
				</div>
				<div class="form-group dob">
					<div class="col-sm-12">
						<input type="password" class="form-control" name="sifre" placeholder="Eski Şifrenizi Giriniz...">
					</div>
				</div>
				<div class="form-group dob">
					<div class="col-sm-6">
						<input type="password" class="form-control" name="kullanici_passwordone" placeholder="Şifrenizi Giriniz...">
					</div>
					<div class="col-sm-6">
						<input type="password" class="form-control" name="kullanici_passwordtwo" placeholder="Şifrenizi Tekrar Giriniz...">
					</div>
				</div>
				<div class="form-group dob">
					<div class="col-sm-6">
						<input type="text" class="form-control" name="kullanici_ilce" placeholder="İlçe" value="<?php echo $kullanicicek['kullanici_ilce'] ?>">
					</div>
					<div class="col-sm-6">
						<input type="text" class="form-control" name="kullanici_il" placeholder="il" value="<?php echo $kullanicicek['kullanici_il'] ?>">
					</div>
				</div>
				<div class="form-group dob">
					<div class="col-sm-12">
						<input type="text" class="form-control" name="kullanici_adres" placeholder="adres" value="<?php echo $kullanicicek['kullanici_adres'] ?>">
					</div>
				</div>
				<input type="hidden" name="kullanici_id" value="<?php echo $kullanicicek['kullanici_id'] ?>">
				<button type="submit" name="kullanicibilgiguncelle" class="btn btn-default btn-info">Bilgilerimi Güncelle</button>
			</div>
			<div class="col-md-6">
				<div class="title-bg">
					<div class="title">Şifrenizi mi Unuttunuz?</div>
				</div>
				<a href="sifre-guncelle" class="text-center"><img width="400" src="img/sifremi-unuttum.jpg"></a>
			</div>
		</div>
</div>
</form>
<div class="spacer"></div>
</div>
<?php require_once 'footer.php'; ?>