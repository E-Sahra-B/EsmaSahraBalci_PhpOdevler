<?php
$title = "Menü Listeleme";
require_once 'header.php';
$menusor = $db->prepare("SELECT * FROM menu order by menu_sira ASC");
$menusor->execute();
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
            <h2>Menü Listeleme</h2>
            <div class="clearfix"></div>
            <div class="text-right">
              <a href="menu-ekle.php"><button class="btn btn-success btn-xs"> Yeni Ekle</button></a>
            </div>
          </div>
          <div class="x_content">
            <!-- Tablo İçerik Başlangıç -->
            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th>S.No</th>
                  <th>Menü Sira</th>
                  <th>Menü Ad</th>
                  <th>Menü Url</th>
                  <th>Menü seourl</th>
                  <th>Menü Durum</th>
                  <th></th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <?php
                $say = 0;
                while ($menucek = $menusor->fetch(PDO::FETCH_ASSOC)) {
                  $say++ ?>
                  <tr>
                    <td width="20"><?php echo $say ?></td>
                    <td><?php echo $menucek['menu_sira'] ?></td>
                    <td><?php echo $menucek['menu_ad'] ?></td>
                    <td><?php echo $menucek['menu_url'] ?></td>
                    <td><?php echo $menucek['menu_seourl'] ?></td>
                    <td class="text-center">
                      <?php
                      if ($menucek['menu_durum'] == 1) { ?>
                        <button class="btn btn-success btn-xs">Aktif</button>
                      <?php } else { ?>
                        <button class="btn btn-secondary btn-xs">Pasif</button>
                      <?php } ?>
                    </td>
                    <td class="text-center">
                      <a href="menu-duzenle.php?menu_id=<?php echo $menucek['menu_id']; ?>"><button class="btn btn-primary btn-xs">Düzenle</button></a>
                    </td>
                    <td class="text-center">
                      <a href="../netting/islem.php?menu_id=<?php echo $menucek['menu_id']; ?>&menusil=ok"><button class="btn btn-danger btn-xs">Sil</button></a>
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