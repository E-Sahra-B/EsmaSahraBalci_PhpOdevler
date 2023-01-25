<?php
require_once 'header.php';
$bankasor = $db->prepare("SELECT * FROM banka where banka_id=:id");
$bankasor->execute(array(
  'id' => $_GET['banka_id']
));
$bankacek = $bankasor->fetch(PDO::FETCH_ASSOC);
?>
<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <?php
            if ($_GET['durum'] == "ok") { ?>
              <div class="alert alert-success alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                İşlem Başarılı
              </div>
            <?php } elseif ($_GET['durum'] == "no") { ?>
              <div class="alert alert-danger alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                İşlem Başarısız
              </div>
            <?php }
            ?>
            <h2>Banka Düzenle</h2>
            <div class="text-right">
              <a href="banka.php"><button class="btn btn-success btn-xs">Banka Listesi</button></a>
            </div>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <br />
            <form action="../netting/islem.php" method="POST" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Banka Adı <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="first-name" name="banka_ad" value="<?php echo $bankacek['banka_ad'] ?>" required="required" class="form-control col-md-7 col-xs-12">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Banka IBAN <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="first-name" name="banka_iban" value="<?php echo $bankacek['banka_iban'] ?>" required="required" class="form-control col-md-7 col-xs-12">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Banka Hesap Ad Soyad <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="first-name" name="banka_hesapadsoyad" value="<?php echo $bankacek['banka_hesapadsoyad'] ?>" required="required" class="form-control col-md-7 col-xs-12">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Banka Durum<span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <select id="heard" class="form-control" name="banka_durum" required>
                    <option value="1" <?php echo $bankacek['banka_durum'] == '1' ? 'selected=""' : ''; ?>>Aktif</option>
                    <option value="0" <?php echo $bankacek['banka_durum'] == '0' ? 'selected=""' : ''; ?>>Pasif</option>
                  </select>
                </div>
              </div>
              <input type="hidden" name="banka_id" value="<?php echo $bankacek['banka_id'] ?>">
              <div class="ln_solid"></div>
              <div class="form-group">
                <div class="text-right" class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                  <button type="submit" name="bankaduzenle" class="btn btn-success">Güncelle</button>
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