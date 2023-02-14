<?php
require_once 'header.php';
?>
<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
    </div>
    <div class="col-md-12">
      <div class="title_right">
        <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
          <form action="" method="POST">
            <div class="input-group">
              <input type="text" class="form-control" name="aranan" placeholder="Anahtar Kelime Giriniz...">
              <span class="input-group-btn">
                <button class="btn btn-default" type="submit" name="arama">Ara!</button>
              </span>
            </div>
          </form>
        </div>
      </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="text-left">
            <a href="urun.php"><button class="btn btn-success btn-xs">Ürünler Listesi</button></a>
          </div>
          <div class="x_panel">
            <div class="x_title">
              <div class="col-md-6 text-left">
                <?php
                if ($_GET['durum'] == "ok") { ?>
                  <div class="alert alert-info alert-dismissible">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    Ürün Resim Silme İşlemi Başarılı
                  </div>
                <?php } elseif ($_GET['durum'] == "no") { ?>
                  <div class="alert alert-danger">İşlem Başarısız
                  </div>
                <?php } ?>
                <h2>Resim Ürün Fotoğraf İşlemleri</h2>
                <br>
              </div>
              <form action="../netting/islem.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="urun_id" value="<?php echo $_GET['urun_id']; ?>">
                <div class="col-md-6 text-right">
                  <button type="submit" name="urunfotosil" class="btn btn-danger "><i class="fa fa-trash" aria-hidden="true"></i> Seçilenleri Sil</button>
                  <a class="btn btn-success" href="urun-foto-yukle.php?urun_id=<?php echo $_GET['urun_id']; ?>"><i class="fa fa-plus" aria-hidden="true"></i> Ürün Fotoğraf Yükle</a>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
              <?php
              $sayfada = 25; // sayfada gösterilecek içerik miktarını belirtiyoruz.
              $sorgu = $db->prepare("select * from urunfoto");
              $sorgu->execute();
              $toplam_urunfoto = $sorgu->rowCount();
              $toplam_sayfa = ceil($toplam_urunfoto / $sayfada);
              $sayfa = isset($_GET['sayfa']) ? (int) $_GET['sayfa'] : 1; // eğer sayfa girilmemişse 1 varsayalım.
              if ($sayfa < 1) $sayfa = 1; // eğer 1'den küçük bir sayfa sayısı girildiyse 1 yapalım.
              if ($sayfa > $toplam_sayfa) $sayfa = $toplam_sayfa; // toplam sayfa sayımızdan fazla yazılırsa en son sayfayı varsayalım.
              $limit = ($sayfa - 1) * $sayfada;
              $urunfotosor = $db->prepare("select * from urunfoto where urun_id=:urun_id order by urunfoto_id DESC limit $limit,$sayfada");
              $urunfotosor->execute(array(
                'urun_id' => $_GET['urun_id']
              ));
              while ($urunfotocek = $urunfotosor->fetch(PDO::FETCH_ASSOC)) { ?>
                <div class="col-md-55">
                  <label>
                    <div class="image view view-first">
                      <img style="width: 100%; height: auto; display: block;" src="../../<?php echo $urunfotocek['urunfoto_resimyol']; ?>" alt="image" />
                      <div class="mask">
                        <p><?php echo $urunfotocek['urunfoto_sira']; ?></p>
                        <div class="tools tools-bottom">
                          <!--<a href="#"><i class="fa fa-times"></i></a>-->
                        </div>
                      </div>
                    </div>
                    <?php array("$urunfotosec"); ?>
                    <input type="checkbox" name="urunfotosec[]" value="<?php echo $urunfotocek['urunfoto_id']; ?>"> Seç
                  </label>
                </div>
              <?php } ?>
              <div class="col-md-12 text-right">
                <ul class="pagination">
                  <?php
                  $s = 0;
                  while ($s < $toplam_sayfa) {
                    $s++; ?>
                    <?php
                    if ($s == $sayfa) { ?>
                      <li class="active">
                        <a href="urunfoto.php?sayfa=<?php echo $s; ?>"><?php echo $s; ?></a>
                      </li>
                    <?php } else { ?>
                      <li>
                        <a href="urunfoto.php?sayfa=<?php echo $s; ?>"><?php echo $s; ?></a>
                      </li>
                  <?php   }
                  }
                  ?>
                </ul>
              </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- /page content -->
<?php require_once 'footer.php'; ?>