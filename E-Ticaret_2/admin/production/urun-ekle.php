<?php
$title = "Ürün Ekle";
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
            <h2>Ürün Ekleme </h2>
            <div class="text-right">
              <a href="urun.php"><button class="btn btn-success btn-xs">Ürün Listesi</button></a>
            </div>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <br />
            <form action="../netting/islem.php" method="POST" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
              <!-- kategori seçme -->
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Kategori Seç<span class="required">*</span></label>
                <div class="col-md-6 col-sm-6 col-xs-6">
                  <?php
                  $urun_id = $uruncek['kategori_id'];
                  $kategorisor = $db->prepare("select * from kategori where kategori_ust=:kategori_ust order by kategori_sira");
                  $kategorisor->execute(array(
                    'kategori_ust' => 0
                  ));
                  ?>
                  <select class="select2_multiple form-control" required="" name="kategori_id">
                    <?php
                    while ($kategoricek = $kategorisor->fetch(PDO::FETCH_ASSOC)) {
                      $kategori_id = $kategoricek['kategori_id'];
                    ?>
                      <option value="<?php echo $kategoricek['kategori_id']; ?>"><?php echo $kategoricek['kategori_ad']; ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <!-- kategori seçme bitiş -->
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Ürün Ad <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="first-name" name="urun_ad" placeholder="Ürün adını giriniz" required="required" class="form-control col-md-7 col-xs-12">
                </div>
              </div>
              <!-- Ck Editör Başlangıç -->
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Ürün Detay <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <textarea class="ckeditor" id="editor1" name="urun_detay"></textarea>
                </div>
              </div>
              <script type="text/javascript">
                CKEDITOR.replace('editor1', {
                  filebrowserBrowseUrl: 'ckfinder/ckfinder.html',
                  filebrowserImageBrowseUrl: 'ckfinder/ckfinder.html?type=Images',
                  filebrowserFlashBrowseUrl: 'ckfinder/ckfinder.html?type=Flash',
                  filebrowserUploadUrl: 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
                  filebrowserImageUploadUrl: 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
                  filebrowserFlashUploadUrl: 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash',
                  forcePasteAsPlainText: true
                });
              </script>
              <!-- Ck Editör Bitiş -->
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Ürün Fiyat <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="first-name" name="urun_fiyat" placeholder="Ürün fiyat giriniz" class="form-control col-md-7 col-xs-12">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Ürün Video <span class=""></span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="first-name" name="urun_video" placeholder="Ürün video giriniz" class="form-control col-md-7 col-xs-12">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Ürün Keyword <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="first-name" name="urun_keyword" placeholder="Ürün keyword giriniz" required="required" class="form-control col-md-7 col-xs-12">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Ürün Stok <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="first-name" name="urun_stok" placeholder="Ürün stok giriniz" required="required" class="form-control col-md-7 col-xs-12">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Öne Çıkar<span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <select id="heard" class="form-control" name="urun_onecikar" required>
                    <option value="1">Evet</option>
                    <option value="0">Hayır</option>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Ürün Durum<span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <select id="heard" class="form-control" name="urun_durum" required>
                    <option value="1">Aktif</option>
                    <option value="0">Pasif</option>
                  </select>
                </div>
              </div>
              <div class="ln_solid"></div>
              <div class="form-group">
                <div class="text-right" class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                  <button type="submit" name="urunekle" class="btn btn-success">Kaydet</button>
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