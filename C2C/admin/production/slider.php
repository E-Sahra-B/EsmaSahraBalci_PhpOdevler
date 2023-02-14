<?php
$title = "Slider Listeleme";
require_once 'header.php';
$slidersor = $db->prepare("SELECT * FROM slider");
$slidersor->execute();
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
              if ($_GET['durum'] == "ok") { ?>
                <div class="alert alert-success">İşlem Başarılı</div>
              <?php } elseif ($_GET['durum'] == "no") { ?>
                <div class="alert alert-danger">İşlem Başarısız</div>
              <?php }
              ?>
            </div>
            <h2>Slider Listeleme</h2>
            <div class="clearfix"></div>
            <div class="text-right">
              <a href="slider-ekle.php"><button class="btn btn-success btn-xs"> Yeni Ekle</button></a>
            </div>
          </div>
          <div class="x_content">
            <!-- Tablo İçerik Başlangıç -->
            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th>S.No</th>
                  <th>Resim</th>
                  <th>Ad</th>
                  <th>Url</th>
                  <th>Sıra</th>
                  <th>Durum</th>
                  <th></th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <?php
                $say = 0;
                while ($slidercek = $slidersor->fetch(PDO::FETCH_ASSOC)) {
                  $say++ ?>
                  <tr>
                    <td width="20"><?php echo $say ?></td>
                    <td><img width="150" src="../../<?php echo $slidercek['slider_resimyol'] ?>"></td>
                    <td><?php echo $slidercek['slider_ad'] ?></td>
                    <td><?php echo $slidercek['slider_url'] ?></td>
                    <td><?php echo $slidercek['slider_sira'] ?></td>
                    <td class="text-center">
                      <?php
                      if ($slidercek['slider_durum'] == 1) { ?>
                        <button class="btn btn-success btn-xs">Aktif</button>
                      <?php } else { ?>
                        <button class="btn btn-secondary btn-xs">Pasif</button>
                      <?php } ?>
                    </td>
                    <td class="text-center">
                      <a href="slider-duzenle.php?slider_id=<?php echo $slidercek['slider_id']; ?>"><button class="btn btn-primary btn-xs">Düzenle</button></a>
                    </td>
                    <td class="text-center">
                      <a href="../netting/islem.php?slider_id=<?php echo $slidercek['slider_id']; ?>&slidersil=ok&slider_resimyol=<?php echo $slidercek['slider_resimyol'] ?>"><button class="btn btn-danger btn-xs">Sil</button></a>
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