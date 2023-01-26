<?php
$title = "Kategori Düzenle";
require_once 'header.php';
$kategorisor = $db->prepare("SELECT * FROM kategori where kategori_id=:id");
$kategorisor->execute(array(
  'id' => $_GET['kategori_id']
));
$kategoricek = $kategorisor->fetch(PDO::FETCH_ASSOC);
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
              <div class="form-group"><!-- Ürün Kategori Select   -->
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Kategori Ust Seç<span class="required">*</span></label>
                <div class="col-md-6 col-sm-6 col-xs-6">
                  <?php
                  $kategoriust_id = $kategoricek['kategori_ust'];
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
                      <option <?php if ($kategori_id == $kategoriust_id) {
                                echo "selected='select'";
                              } ?> value="<?php echo $kategoriustcek['kategori_id']; ?>"><?php echo $kategoriustcek['kategori_ad']; ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div> <!-- Ürün Kategori Select Bitiş   -->
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Kategori Ad <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="first-name" name="kategori_ad" value="<?php echo $kategoricek['kategori_ad'] ?>" required="required" class="form-control col-md-7 col-xs-12">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Kategori Sıra <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="first-name" name="kategori_sira" value="<?php echo $kategoricek['kategori_sira'] ?>" required="required" class="form-control col-md-7 col-xs-12">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Kategori Durum<span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <select id="heard" class="form-control" name="kategori_durum" required>
                    <option value="1" <?php echo $kategoricek['kategori_durum'] == '1' ? 'selected=""' : ''; ?>>Aktif</option>
                    <option value="0" <?php echo $kategoricek['kategori_durum'] == '0' ? 'selected=""' : ''; ?>>Pasif</option>
                  </select>
                </div>
              </div>
              <input type="hidden" name="kategori_id" value="<?php echo $kategoricek['kategori_id'] ?>">
              <div class="ln_solid"></div>
              <div class="form-group">
                <div align="right" class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                  <button type="submit" name="kategoriduzenle" class="btn btn-success">Güncelle</button>
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