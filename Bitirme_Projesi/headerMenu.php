<?php
include("ayar.php");
$sorgu = $baglan->query("select * from menuler", PDO::FETCH_ASSOC);


?>
<div class="header_top" id="home">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <button class="navbar-toggler navbar-toggler-right mx-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="bloglar.php">Anasayfa
                    </a>
                </li>
                <?php
                foreach ($sorgu as $satir) { ?>
                    <li class="nav-item">
                        <a class="nav-link" href="sayfalar.php?oku=menu&id=<?php echo $satir['id']; ?>"><?php echo $satir['menuAdi']; ?></a>
                    </li>
                <?php
                }
                ?>

            </ul>
            <form action="#" method="post" class="form-inline my-2 my-lg-0 header-search">
                <input class="form-control mr-sm-2" type="search" placeholder="Arama Yap..." name="Search" required="">
                <button class="btn btn1 my-2 my-sm-0" type="submit">
                    <i class="fas fa-search"></i>
                </button>
            </form>
        </div>
    </nav>
</div>