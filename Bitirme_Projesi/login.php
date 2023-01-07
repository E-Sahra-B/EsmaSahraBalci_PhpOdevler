<?php
session_start();
include("ayar.php");

if ($_POST) {
	$kullanici = $_POST["kullanici"];
	$parola = $_POST["sifre"];
	$sorgu = $baglan->prepare("select * from kullanici where (kullaniciAdi =?)");
	$sonuc = $sorgu->execute(array($kullanici));
	$kayit = $sorgu->fetch(PDO::FETCH_ASSOC);
	if (password_verify($parola, $kayit["sifre"])) {
		setcookie("user", "esb", strtotime('+1 day'));
		$_SESSION["giris"] = sha1(md5("var"));
		$_SESSION["adSoyad"] = $kullanici;
		echo "
            <script>
            window.location.href='admin/index.php';
            </script>";
	} else {
		echo "
            <script>
            alert('HATALI KULLANICI BİLGİSİ!');
            window.location.href='index.php';
            </script>";
	}
}
?>
<!DOCTYPE html>
<html lang="tr">

<head>
	<?php
	include_once("head.php");
	?>
</head>

<body>
	<header>
		<?php
		include_once("header.php");
		include_once("headerMenu.php");
		?>
	</header>
	<section class="main-content-w3layouts-agileits">
		<div class="container">
			<h3 class="tittle">Giriş Yap</h3>
			<div class="row inner-sec">
				<div class="login p-5 bg-light mx-auto mw-100">
					<form action="login.php" method="post">
						<div class="form-group">
							<label for="exampleInputEmail1 mb-2">Kullanıcı Adı</label>
							<input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="kullanici" required="">
						</div>
						<div class="form-group">
							<label for="exampleInputPassword1 mb-2">Şifre</label>
							<input type="password" class="form-control" id="exampleInputPassword1" name="sifre" required="">
						</div>
						<button type="submit" class="btn btn-primary submit mb-4">Giriş Yap</button>
					</form>
				</div>
			</div>
		</div>
	</section>
	<?php
	include_once("footer.php");
	include_once("script.php");
	?>
</body>

</html>