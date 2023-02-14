<?php
$title = "Kategori Ekle";
require_once 'header.php';
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
            <h2>Kategori Düzenleme</h2>
            <div class="text-right">
              <a href="kategori.php"><button class="btn btn-success btn-xs">Kategori Listesi</button></a>
            </div>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <br />
            <form action="../netting/islem.php" method="POST" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
              <!-- kategori seçme -->
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Ust Kategori Seç<span class="required">*</span></label>
                <div class="col-md-6 col-sm-6 col-xs-6">
                  <?php
                  $kategoriustsor = $db->prepare("select * from kategori where kategori_ust=:kategori_ust order by kategori_sira");
                  $kategoriustsor->execute(array(
                    'kategori_ust' => 0
                  ));
                  ?>
                  <select class="select2_multiple form-control" required="" name="kategoriust_id">
                    <option value="0">Ust Kategori</option>
                    <?php
                    while ($kategoriustcek = $kategoriustsor->fetch(PDO::FETCH_ASSOC)) {
                      $kategori_id = $kategoriustcek['kategori_id'];
                    ?>
                      <option value="<?php echo $kategoriustcek['kategori_id']; ?>"><?php echo $kategoriustcek['kategori_ad']; ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <!-- kategori seçme bitiş -->
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Kategori Ad <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="first-name" name="kategori_ad" placeholder="Kategori adını giriniz" required="required" class="form-control col-md-7 col-xs-12">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Kategori Sıra <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="first-name" name="kategori_sira" placeholder="Sıra giriniz" required="required" class="form-control col-md-7 col-xs-12">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Kategori Durum<span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <select id="heard" class="form-control" name="kategori_durum" required>
                    <option value="1">Aktif</option>
                    <option value="0">Pasif</option>
                  </select>
                </div>
              </div>
              <input type="hidden" name="kategori_id" value="<?php echo $kategoricek['kategori_id'] ?>">
              <div class="ln_solid"></div>
              <div class="form-group">
                <div class="text-right" class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                  <button type="submit" name="kategoriekle" class="btn btn-success">Kaydet</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <hr>
  </div>
</div>
<!-- /page content -->
<?php require_once 'footer.php'; ?>