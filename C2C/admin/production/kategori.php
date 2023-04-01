<?php
$title = "Kategori Listeleme";
require_once 'header.php';
$kategorisor = $db->prepare("SELECT * FROM kategori order by kategori_sira ASC");
$kategorisor->execute();
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
              <div class="alert alert-<?= $_GET['sil']; ?>"><?= !empty($_GET['sil']) ? (($_GET['sil'] == "danger") ? "İşlem Başarısız" : "İşlem Başarılı") : ""; ?></div>
            </div>
            <h2>Kategori Listeleme</h2>
            <div class="clearfix"></div>
            <div class="text-right">
              <a href="kategori-ekle.php"><button class="btn btn-success btn-xs"> Yeni Ekle</button></a>
            </div>
          </div>
          <div class="x_content">
            <!-- Tablo İçerik Başlangıç -->
            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th>S.No</th>
                  <th>Kategori Ad</th>
                  <th>Kategori Sira</th>
                  <th>Kategori Öneçıkar</th>
                  <th>Kategori Durum</th>
                  <th></th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <?php
                $say = 0;
                while ($kategoricek = $kategorisor->fetch(PDO::FETCH_ASSOC)) {
                  $say++ ?>
                  <tr>
                    <td width="20"><?php echo $say ?></td>
                    <td><?php echo $kategoricek['kategori_ad'] ?></td>
                    <td><?php echo $kategoricek['kategori_sira'] ?></td>
                    <td class="text-center">
                      <?php
                      if ($kategoricek['kategori_onecikar'] == 0) { ?>
                        <a href="../netting/adminislem.php?kategori_id=<?php echo $kategoricek['kategori_id'] ?>&kategori_one=1&kategori_onecikar=ok"><button class="btn btn-dark btn-xs">Ön Çıkar</button></a>
                      <?php } elseif ($kategoricek['kategori_onecikar'] == 1) { ?>
                        <a href="../netting/adminislem.php?kategori_id=<?php echo $kategoricek['kategori_id'] ?>&kategori_one=0&kategori_onecikar=ok"><button class="btn btn-warning btn-xs">Kaldır</button></a>
                      <?php } ?>
                    </td>
                    <td class="text-center">
                      <?php
                      if ($kategoricek['kategori_durum'] == 1) { ?>
                        <button class="btn btn-success btn-xs">Aktif</button>
                      <?php } else { ?>
                        <button class="btn btn-secondary btn-xs">Pasif</button>
                      <?php } ?>
                    </td>
                    <td class="text-center">
                      <a href="kategori-duzenle.php?kategori_id=<?php echo $kategoricek['kategori_id']; ?>"><button class="btn btn-primary btn-xs">Düzenle</button></a>
                    </td>
                    <td class="text-center">
                      <a href="../netting/islem.php?kategori_id=<?php echo $kategoricek['kategori_id']; ?>&kategorisil=ok"><button class="btn btn-danger btn-xs">Sil</button></a>
                    </td>
                  </tr>
                <?php  }
                ?>
              </tbody>
            </table>
            <!-- Tablo İçerik Bitişi -->
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- /page content -->
<?php require_once 'footer.php'; ?>