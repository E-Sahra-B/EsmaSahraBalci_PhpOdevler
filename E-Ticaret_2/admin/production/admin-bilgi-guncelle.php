<?php
ob_start();
session_start();
error_reporting(0);
$title = "Profil Bilgilerim";
require_once 'header.php';

$kullanicisor = $db->prepare("SELECT * FROM kullanici where kullanici_mail=:mail");
$kullanicisor->execute(array(
  'mail' => $_SESSION['kullanici_mail']
));
$kullaniciGeldiMi = $kullanicisor->rowCount();
$kullanicicek = $kullanicisor->fetch(PDO::FETCH_ASSOC);
if ($kullaniciGeldiMi == 0) {
  Header("Location:login.php?durum=izinsiz");
  exit;
}
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
                <div class="alert alert-success alert-dismissible">
                  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                  Profil Bilgi Güncelleme İşlemi Başarılı
                </div>
              <?php } elseif ($_GET['durum'] == "no") { ?>
                <div class="alert alert-danger alert-dismissible">
                  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                  Profil Bilgi Güncelleme İşlemi Başarısız
                </div>
              <?php }
              ?>
            </div>
            <h2>Profil Bilgilerim</h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <br />
            <form action="../netting/islem.php" method="POST" enctype="multipart/form-data" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Yüklü Resim <span></span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <img width="300" src="../../<?php echo $kullanicicek['kullanici_resim']; ?>">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Resim Seç<span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="file" id="first-name" name="kullanici_resim" class="form-control col-md-7 col-xs-12">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Kayıt Tarihi <span></span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="" id="first-name" name="" disabled="" value="<?php echo date("d-m-Y", strtotime($kullanicicek['kullanici_zaman'])) ?>" required="required" class="form-control col-md-7 col-xs-12">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Telefon<span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="first-name" name="kullanici_gsm" pattern="[0-9]{3} [0-9]{3} [0-9]{4}" maxlength="12" placeholder="000 000 0000 şeklinde giriş yapınız" value="<?php echo $kullanicicek['kullanici_gsm'] ?>" required="required" class="form-control col-md-7 col-xs-12">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Ad Soyad <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="first-name" name="kullanici_adsoyad" value="<?php echo $kullanicicek['kullanici_adsoyad'] ?>" required="required" class="form-control col-md-7 col-xs-12">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Mail <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="first-name" name="kullanici_mail" disabled="" value="<?php echo $kullanicicek['kullanici_mail'] ?>" class="form-control col-md-7 col-xs-12">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Kullanıcı Durum<span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <select id="heard" class="form-control" name="kullanici_durum" required>
                    <option value="1" <?php echo $kullanicicek['kullanici_durum'] == '1' ? 'selected=""' : ''; ?>>Aktif</option>
                    <option value="0" <?php echo $kullanicicek['kullanici_durum'] == '0' ? 'selected=""' : ''; ?>>Pasif</option>
                  </select>
                </div>
              </div>
              <input type="hidden" name="kullanici_id" value="<?php echo $kullanicicek['kullanici_id'] ?>">
              <input type="hidden" name="kullanici_resimyol" value="<?php echo $kullanicicek['kullanici_resim']; ?>">
              <div class="ln_solid"></div>
              <div class="form-group">
                <div align="right" class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                  <button type="submit" name="admin-bilgi-guncelle" class="btn btn-success">Güncelle</button>
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