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
	<!--/main-->
	<section class="main-content-w3layouts-agileits">
		<div class="container">
			<h3 class="tittle">Blog Posts</h3>
			<div class="inner-sec">
				<div class="left-blog-info-w3layouts-agileits text-left">
					<div class="row">

						<?php
						include("ayar.php");
						$sorgu = $baglan->prepare("select * from bloglar");
						$sorgu->fetch(PDO::FETCH_ASSOC);
						$sorgu->execute();
						foreach ($sorgu as $satir) {
						?>
							<div class="col-lg-4 card">
								<a href="#">
									<img src="<?php echo "admin/" . $satir['resim']; ?>" class="card-img-top img-fluid" alt="">
								</a>
								<div class="card-body">
									<ul class="blog-icons my-4">
										<li>
											<a href="#">
												<i class="far fa-calendar-alt"></i><?php echo date('d-m-Y', strtotime($satir['tarih'])); ?></a>
										</li>
										<li>
											<a href="#">
												<i class="fas fa-eye"></i> <?php echo $satir['ziyaret']; ?></a>
										</li>
									</ul>
									<h5 class="card-title">
										<a href="#"><?php echo $satir['baslik']; ?></a>
									</h5>
									<p class="card-text mb-3"><?php echo mb_substr($satir["icerik"], 0, 50, "utf-8"); ?></p>
									<a href="sayfalar.php?oku=blog&id=<?php echo $satir['id']; ?>" class="btn btn-primary read-m">Devamını Oku</a>
								</div>
							</div>
						<?php
						}
						?>

						<!-- <nav aria-label="Page navigation example">
							<ul class="pagination justify-content-left mt-4">
								<li class="page-item disabled">
									<a class="page-link" href="#" tabindex="-1">Previous</a>
								</li>
								<li class="page-item">
									<a class="page-link" href="#">1</a>
								</li>
								<li class="page-item">
									<a class="page-link" href="#">2</a>
								</li>
								<li class="page-item">
									<a class="page-link" href="#">3</a>
								</li>
								<li class="page-item">
									<a class="page-link" href="#">Next</a>
								</li>
							</ul>
						</nav> -->
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--//main-->
	<?php
	include_once("footer.php");
	include_once("script.php");
	?>
</body>

</html>