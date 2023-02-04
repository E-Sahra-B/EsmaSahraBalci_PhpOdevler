  <!-- Main Sidebar Container -->
  <aside style="background-color:black" class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index.php" class="brand-link">
      <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Muhasebe</span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
      <br>
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
            <a href="index.php" class="nav-link">
              <i class="nav-icon fas fa-home"></i>
              <p>Anasayfa </p>
            </a>
          </li>
          <!-- <li class="nav-item menu-open"> -->
          <li class="nav-item menu-open">
            <a href="#" class="nav-link active">
              <i class="fas fa-money-bill-alt"></i>
              <p>Giderler<i class="right fas fa-angle-left"></i></p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="sayfa.php?sayfa=masraflar" class="nav-link">
                  <i class="fas fa-credit-card"></i>
                  <p>Masraflar </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="sayfa.php?sayfa=odemeler" class="nav-link">
                  <i class="fas fa-money-bill-wave"></i>
                  <p>Ödemeler </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="sayfa.php?sayfa=calisanlar" class="nav-link">
                  <i class="fas fa-users-cog"></i>
                  <p>Çalışanlar </p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item menu-open">
            <a href="#" class="nav-link active">
              <i class="fas fa-hand-holding-usd"></i>
              <p>Gelirler<i class="right fas fa-angle-left "></i></p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="sayfa.php?sayfa=alacaklar" class="nav-link">
                  <i class="fas fa-coins"></i>
                  <p>Alacaklar </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="sayfa.php?sayfa=satislar" class="nav-link">
                  <i class="fas fa-file-invoice-dollar"></i>
                  <p>Satışlar </p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="nakit.php" class="nav-link active">
              <i class="fas fa-coins"></i>
              <p>Nakit Yönetimi</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="raporlar" class="nav-link active">
              <i class="fas fa-copy"></i>
              <p>Raporlar<i class="right fas fa-angle-left"></i></p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="raporlar.php?rapor=satis" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Satış raporu </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="raporlar.php?rapor=nakit" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Nakit raporu </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="raporlar.php?rapor=odeme" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Ödeme raporu</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="raporlar.php?rapor=masraf" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Masraf raporu</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="cikis" class="nav-link">
              <i class="fas fa-sign-out-alt"></i>
              <p>Çıkış yap</p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>