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
            <form action="../netting/adminislem.php" method="POST" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
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
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Kategori Öne Çıkar<span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <select id="heard" class="form-control" name="kategori_onecikar" required>
                    <option value="1" <?php echo $kategoricek['kategori_onecikar'] == '1' ? 'selected=""' : ''; ?>>Evet</option>
                    <option value="0" <?php echo $kategoricek['kategori_onecikar'] == '0' ? 'selected=""' : ''; ?>>Hayır</option>
                  </select>
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
                <div class="text-right" class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
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