<?php
$title = "Yorum Listeleme";
require_once 'header.php';
$yorumsor = $db->prepare("SELECT * FROM yorumlar order by yorum_onay ASC");
$yorumsor->execute();
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
            <h2>Yorum Listeleme <small></h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <!-- Tablo İçerik Başlangıç -->
            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th>S.No</th>
                  <th>Yorum</th>
                  <th>Kullanıcı</th>
                  <th>Ürün</th>
                  <th class="text-center">Onayla</th>
                  <th class="text-center">Sil</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $say = 0;
                while ($yorumcek = $yorumsor->fetch(PDO::FETCH_ASSOC)) {
                  $say++ ?>
                  <tr>
                    <td width="20"><?php echo $say ?></td>
                    <td><?php echo substr($yorumcek['yorum_detay'], 0, 20) ?></td>
                    <td><?php
                        $kullanici_id = $yorumcek['kullanici_id'];
                        $kullanicisor = $db->prepare("SELECT * FROM kullanici where kullanici_id=:id");
                        $kullanicisor->execute(array(
                          'id' => $kullanici_id
                        ));
                        $kullanicicek = $kullanicisor->fetch(PDO::FETCH_ASSOC);
                        echo $kullanicicek['kullanici_adsoyad'];
                        ?></td>
                    <td><?php
                        $urun_id = $yorumcek['urun_id'];
                        $urunsor = $db->prepare("SELECT * FROM urun where urun_id=:id");
                        $urunsor->execute(array(
                          'id' =>  $urun_id
                        ));
                        $uruncek = $urunsor->fetch(PDO::FETCH_ASSOC);
                        echo $uruncek['urun_ad'];
                        ?></td>
                    <td class="text-center">
                      <?php
                      if ($yorumcek['yorum_onay'] == 0) { ?>
                        <a href="../netting/islem.php?yorum_id=<?php echo $yorumcek['yorum_id'] ?>&yorum_one=1&yorum_onay=ok"><button class="btn btn-success btn-xs">Onayla</button></a>
                      <?php } elseif ($yorumcek['yorum_onay'] == 1) { ?>
                        <a href="../netting/islem.php?yorum_id=<?php echo $yorumcek['yorum_id'] ?>&yorum_one=0&yorum_onay=ok"><button class="btn btn-warning btn-xs">Kaldır</button></a>
                      <?php } ?>
                    </td>
                    <td class="text-center">
                      <a href="../netting/islem.php?yorum_id=<?php echo $yorumcek['yorum_id']; ?>&yorumsil=ok"><button class="btn btn-danger btn-xs">Sil</button></a>
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