<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container px-4 px-lg-5">
        <a class="navbar-brand" href="index.php">Eİİ Shop v1.0</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                <li class="nav-item"><a class="nav-link active" aria-current="page" href="index.php">Ana Sayfa</a></li>
                <li class="nav-item"><a class="nav-link" href="hakkimizda.php">Hakkımızda</a></li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="javascript:;" role="button" data-bs-toggle="dropdown" aria-expanded="false">Kategoriler</a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <?php
                            $sorgu = $baglan->select('kategoriler', ['no','baslik'])
                                            ->where('durum', 'aktif', '=')
                                            ->orderBy('baslik', 'asc')
                                            ->limit(10)
                                            ->run();
                            if ($sorgu) {
                                foreach ($sorgu as $satir) { 
                                    echo "<li><a class='dropdown-item' href='kategoriler.php?no=$satir[no]'>$satir[baslik]</a></li>";
                                }
                            }
                        ?>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="javascript:;" role="button" data-bs-toggle="dropdown" aria-expanded="false">Ürünler</a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="urunler.php">Tüm Ürünler</a></li>
                        <li><hr class="dropdown-divider" /></li>
                        <li><a class="dropdown-item" href="urunler.php?t=yeni">Yeni Gelenler</a></li>
                        <li><a class="dropdown-item" href="urunler.php?t=coksatan">En Çok Satanlar</a></li>
                    </ul>
                </li>
            </ul>
            <div class="d-flex">
                <a class="btn btn-outline-dark" href="sepet.php">
                    <i class="bi-cart-fill me-1"></i>
                    Sepet
                    <span class="badge bg-dark text-white ms-1 rounded-pill"><?php echo $sepet->urunsay(); ?></span>
                </a>
            </div>
        </div>
    </div>
</nav>