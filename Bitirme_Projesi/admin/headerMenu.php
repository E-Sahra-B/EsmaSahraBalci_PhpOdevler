<?php
@session_start();
@ob_start();
?>
<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element">
                    <img alt="image" class="rounded-circle" src="img/profile_small.jpg" />
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <span class="block m-t-xs font-bold"><?php echo $_SESSION['adSoyad']; ?></span>
                        <span class="text-muted text-xs block">Chairman - Instructor - Author</span>
                    </a>
                </div>
                <div class="logo-element">
                    MSB+
                </div>
            </li>
            <li>
                <a href="index.php"><i class="fa fa-check-square-o"></i> <span class="nav-label">Notlar</span></a>
            </li>
            <li>
                <a href="notekle.php"><i class="fa fa-pencil"></i> <span class="nav-label">Not Ekle</span></a>
            </li>
            <li>
                <a href="menuliste.php"><i class="fa fa-th-large"></i> <span class="nav-label">Menu Liste</span></a>
            </li>
            <li>
                <a href="menuekle.php"><i class="fa fa-comment"></i> <span class="nav-label">Menu Ekle</span></a>
            </li>
            <li>
                <a href="blogliste.php"><i class="fa fa-laptop"></i> <span class="nav-label">Blog Liste</span></a>
            </li>
            <li>
                <a href="blogekle.php"><i class="fa fa-keyboard-o"></i> <span class="nav-label">Blog Ekle</span></a>
            </li>
            <li>
                <a href="#"><i class="fa fa-stack-overflow"></i> <span class="nav-label">Ayarlar</span></a>
            </li>
            <li>
                <a href="cikis.php"><i class="fa fa-sign-out"></i> <span class="nav-label">Çıkış Yap</span></a>
            </li>
        </ul>
    </div>
</nav>