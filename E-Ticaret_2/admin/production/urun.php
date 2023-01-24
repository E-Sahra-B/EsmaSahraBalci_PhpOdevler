<?php
$title = "Ürün Listeleme";
require_once 'header.php';
$urunsor = $db->prepare("SELECT * FROM urun order by urun_id DESC");
$urunsor->execute();
?>
<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <div>
              <?php
              if ($_GET['sil'] == "ok") { ?>
                <div class="alert alert-success">İşlem Başarılı</div>
              <?php } elseif ($_GET['sil'] == "no") { ?>
                <div class="alert alert-danger">İşlem Başarısız</div>
              <?php }
              ?>
            </div>
            <h2>Ürün Listeleme</h2>
            <div class="clearfix"></div>
            <div class="right">
              <a href="urun-ekle.php"><button class="btn btn-success btn-xs"> Yeni Ekle</button></a>
            </div>
          </div>
          <div class="x_content">
            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th>Ürün Ad</th>
                  <th>Kategori Id</th>
                  <th>Ürün Stok</th>
                  <th>Ürün Fiyat</th>
                  <th>Resim İşlemleri</th>
                  <th>Öne Çıkar</th>
                  <th>Durum</th>
                  <th></th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <?php
                while ($uruncek = $urunsor->fetch(PDO::FETCH_ASSOC)) { ?>
                  <tr>
                    <td><?php echo $uruncek['urun_ad'] ?></td>
                    <td>
                      <!-- Kategori Id'ye Göre Kategori Ad Getirme -->
                      <?php
                      $urun_id = $uruncek['kategori_id'];
                      $kategorisor = $db->prepare("select * from kategori where kategori_id=:id");
                      $kategorisor->execute(array(
                        'id' => $urun_id
                      ));
                      $kategoricek = $kategorisor->fetch(PDO::FETCH_ASSOC);
                      echo $kategoricek['kategori_ad'];
                      ?>
                      <!-- Kategori Id'ye Göre Kategori Ad Getirme Bitiş -->
                    </td>
                    <td><?php echo $uruncek['urun_stok'] ?></td>
                    <td><?php echo number_format($uruncek['urun_fiyat'], 2, ',', '.') ?></td>
                    <td class="text-center">
                      <a href="urun-galeri.php?urun_id=<?php echo $uruncek['urun_id'] ?>"><button class="btn btn-info btn-xs">Resim İşlemleri</button></a>
                    </td>
                    <td class="text-center">
                      <?php
                      if ($uruncek['urun_onecikar'] == 0) { ?>
                        <a href="../netting/islem.php?urun_id=<?php echo $uruncek['urun_id'] ?>&urun_one=1&urun_onecikar=ok"><button class="btn btn-dark btn-xs">Ön Çıkar</button></a>
                      <?php } elseif ($uruncek['urun_onecikar'] == 1) { ?>
                        <a href="../netting/islem.php?urun_id=<?php echo $uruncek['urun_id'] ?>&urun_one=0&urun_onecikar=ok"><button class="btn btn-warning btn-xs">Kaldır</button></a>
                      <?php } ?>
                    </td>
                    <td class="text-center">
                      <?php
                      if ($uruncek['urun_durum'] == 1) { ?>
                        <button class="btn btn-success btn-xs">Aktif</button>
                      <?php } else { ?>
                        <button class="btn btn-secondary btn-xs">Pasif</button>
                      <?php } ?>
                    </td>
                    <td class="text-center">
                      <a href="urun-duzenle.php?urun_id=<?php echo $uruncek['urun_id']; ?>"><button class="btn btn-primary btn-xs">Düzenle</button></a>
                    </td>
                    <td class="text-center">
                      <a href="../netting/islem.php?urun_id=<?php echo $uruncek['urun_id']; ?>&urunsil=ok"><button class="btn btn-danger btn-xs">Sil</button></a>
                    </td>
                  </tr>
                <?php  }
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- /page content -->
<?php require_once 'footer.php'; ?>