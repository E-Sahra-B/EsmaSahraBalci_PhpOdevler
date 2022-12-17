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
						error_reporting(0);
						$page = empty(strip_tags($_GET["page"])) ? 1 : strip_tags($_GET["page"]);
						$limit = 3; //sayfada kaç blok gözüksün
						$startLimit = ($page * $limit) - $limit; //
						$sorgu = $baglan->prepare("select * from bloglar limit $startLimit,$limit");
						$sorgu->fetch(PDO::FETCH_ASSOC);
						$totalRecord = $baglan->prepare("select * from bloglar");
						$totalRecord->fetch(PDO::FETCH_ASSOC);
						$totalRecord->execute();;
						$pageNumber = ceil(($totalRecord->rowCount()) / $limit); //sayfa sayısı

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
					</div>
					<nav aria-label="Page navigation example">
						<ul class="pagination justify-content-center mt-4">
							<?php
							if ($page > 1) {
								$newPage = $page - 1;
								echo '
									<li class="page-item">
									<a class="page-link" href="http://localhost/php/yonetici/bloglar.php?page=' . $newPage . '" tabindex="-1">Geri</a>
								</li>
									';
							} else {
								echo '
									<li class="page-item disabled">
									<a class="page-link" href="javascript:void(0)" tabindex="-1">Geri</a>
								</li>
									';
							}

							$record = 10; //sayfanın sag ve solunda kaç rakam gözüksün
							for ($i = $page - $record; $i <= $page + $record; $i++) {
								if ($i > 0 and $i <= $pageNumber) {
									if ($i == $page) {
										echo '
											<li class="page-item active">
											<a class="page-link" href="http://localhost/php/yonetici/bloglar.php?page=' . $i . '">' . $i . '</a>
										</li>
											';
									} else {
										echo '
									<li class="page-item">
									<a class="page-link" href="http://localhost/php/yonetici/bloglar.php?page=' . $i . '">' . $i . '</a>
								</li>
									';
									}
								}
							}

							if ($page != $pageNumber) {
								$newPage = $page + 1;
								echo '
									<li class="page-item">
									<a class="page-link" 
									href="http://localhost/php/yonetici/bloglar.php?page=' . $newPage . '" tabindex="-1">İleri</a>
								</li>
									';
							} else {
								echo '
									<li class="page-item disabled">
									<a class="page-link" href="javascript:void(0)" tabindex="-1">İleri</a>
								</li>
									';
							}
							?>
						</ul>
					</nav>
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