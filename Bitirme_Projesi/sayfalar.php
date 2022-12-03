<?php
//error_reporting(0);
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
	<section class="banner-bottom">
		<div class="container">
			<?php
			include("ayar.php");
			$oku = $_GET["oku"];
			$kayitNo = $_GET["id"];
			if ($oku == "blog") {
				$sorgu = $baglan->query("select * from bloglar where id=$kayitNo");
				$ziyaret = $satir["ziyaret"];
				$ziyaret++;
				$sorgu2 = $baglan->prepare("update bloglar set ziyaret=? where id=?");
				$guncelle = $sorgu2->execute(array($ziyaret, $kayitNo));
			} else if ($oku == "menu") {
				$sorgu = $baglan->query("select * from menuler where id=$kayitNo");
				$ziyaret = $satir["ziyaret"];
				$ziyaret++;
				$sorgu2 = $baglan->prepare("update menuler set ziyaret=? where id=?");
				$guncelle = $sorgu2->execute(array($ziyaret, $kayitNo));
			}
			foreach ($sorgu as $satir) {
			?>
				<div class="row">
					<div class="col-lg-12 left-blog-info-w3layouts-agileits text-left">
						<div class="blog-grid-top">
							<div class="b-grid-top">
								<div class="blog_info_left_grid">
									<a href="#">
										<img src="<?php echo "admin/" . $satir["resim"]; ?>" class="d-block mx-auto" alt="">
									</a>
								</div>
								<div class="blog-info-middle">
									<ul>
										<li>
											<a href="#">
												<i class="far fa-calendar-alt"></i> <?php echo date('d-m-Y', strtotime($satir['tarih'])); ?>
											</a>
										</li>
										<li class="mx-2">
											<a href="#">
												<i class="far fa-thumbs-up"></i>
												<?php echo $oku == "blog" ? $satir["ziyaret"] : $satir["ziyaret"]; ?>
											</a>
										</li>
									</ul>
								</div>
							</div>
							<h3>
								<a href="#">
									<?php echo $oku == "blog" ? $satir["baslik"] : $satir["menuAdi"]; ?>
								</a>
							</h3>
							<p>
								<?php echo $oku == "blog" ? $satir["icerik"] : $satir["aciklama"]; ?>
							</p>

						</div>
					</div>
				</div>
			<?php
			}
			?>
		</div>
	</section>
	<?php
	include_once("footer.php");
	include_once("script.php");
	?>
</body>

</html>