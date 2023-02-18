<?php
require_once 'header.php';
$kullanicisor = $db->prepare("SELECT * FROM kullanici where kullanici_magaza=:magaza");
$kullanicisor->execute(array(
  'magaza' => 1
));
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
            <h2>Mağaza Başvuru </h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th>Kayıt Tarih</th>
                  <th>Firma Adı</th>
                  <th>Ad</th>
                  <th>Soyad</th>
                  <th>Mail Adresi</th>
                  <th>Telefon</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <?php
                while ($kullanicicek = $kullanicisor->fetch(PDO::FETCH_ASSOC)) { ?>
                  <tr>
                    <td><?php echo $kullanicicek['kullanici_zaman'] ?></td>
                    <td><?php echo $kullanicicek['kullanici_unvan'] ?></td>
                    <td><?php echo $kullanicicek['kullanici_ad'] ?></td>
                    <td><?php echo $kullanicicek['kullanici_soyad'] ?></td>
                    <td><?php echo $kullanicicek['kullanici_mail'] ?></td>
                    <td><?php echo $kullanicicek['kullanici_gsm'] ?></td>
                    <td class="text-center">
                      <a href="magaza-onay-islemleri.php?kullanici_id=<?php echo $kullanicicek['kullanici_id']; ?>"><button class="btn btn-primary btn-xs">Mağaza İnceleme</button></a>
                    </td>
                  </tr>
                <?php  }
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- /page content -->
<?php require_once 'footer.php'; ?>