<?php
require_once 'header.php';
giriskontrol();
?>

<!-- Header Area End Here -->
<!-- Inner Page Banner Area Start Here -->
<div class="pagination-area bg-secondary">
  <div class="container">
    <div class="pagination-wrapper">
    </div>
  </div>
</div>
<!-- Inner Page Banner Area End Here -->
<!-- Settings Page Start Here -->
<div class="settings-page-area bg-secondary section-space-bottom">
  <div class="container">
    <div class="row settings-wrapper">
      <?php require_once 'hesap-sidebar.php' ?>
      <div class="col-lg-9 col-md-9 col-sm-8 col-xs-12">
        <div class="settings-details tab-content">
          <div class="tab-pane fade active in" id="Personal">
            <h2 class="title-section"><?= $_GET['siparis_id'] ?> numaralı sipariş detayı</h2>
            <div class="personal-info inner-page-padding">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Ürün Adı</th>
                    <th scope="col">Satıcı</th>
                    <th scope="col">Fiyat</th>
                    <th scope="col">Onay Durumu</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $siparissor = $db->prepare("SELECT urun.*,kullanici.*,siparis.*,siparis_detay.* 
                  FROM siparis INNER JOIN siparis_detay ON siparis.siparis_id=siparis_detay.siparis_id 
                  INNER JOIN urun ON urun.urun_id=siparis_detay.urun_id 
                  INNER JOIN kullanici ON kullanici.kullanici_id=siparis_detay.kullanici_idsatici 
                  where siparis.siparis_id=:siparis_detay_id ");
                  $siparissor->execute(array(
                    'siparis_detay_id' => $_GET['siparis_id']
                  ));
                  $say = 0;
                  while ($sipariscek = $siparissor->fetch(PDO::FETCH_ASSOC)) {
                    $say++;
                    $siparisdetay_onay = $sipariscek['siparisdetay_onay'];
                    $urun_id = $sipariscek['urun_id'];
                    $siparisdetay_yorum = $sipariscek['siparisdetay_yorum'];
                  ?>
                    <tr>
                      <th scope="row"><?= $say ?></th>
                      <td><?= metinKirp($sipariscek['urun_ad'], 50) ?></td>
                      <td><?= $sipariscek['kullanici_ad'] . " " . $sipariscek['kullanici_soyad'] ?></td>
                      <td><?= fiyat($sipariscek['urun_fiyat']) ?></td>
                      <td>
                        <?php if ($sipariscek['siparisdetay_onay'] == 1) { ?>
                          <a onclick="return confirm('Ürüne Onay Veriyorsunuz Bu İşlem Geri Alınamaz');" href="admin/netting/kullanici.php?urunonay=ok&siparisdetay_id=<?= $sipariscek['siparisdetay_id'] ?>&siparis_id=<?= $sipariscek['siparis_id'] ?>">
                            <button class="btn btn-warning btn-xs"> Onay Ver</button></a>
                        <?php } elseif ($sipariscek['siparisdetay_onay'] == 2) { ?>
                          <button class="btn btn-success btn-xs"> Onaylandı</button>
                        <?php } elseif ($sipariscek['siparisdetay_onay'] == 0) { ?>
                          <button class="btn btn-warning btn-xs"> Teslim Edilmesi Bekleniyor</button>
                        <?php } ?>
                      </td>
                    </tr>
                  <?php } ?>
                </tbody>
              </table>
              <?php
              if ($siparisdetay_onay == 2 && $siparisdetay_yorum == 0) { ?>
                <form action="admin/netting/kullanici.php" method="POST" class="form-horizontal" id="personal-info-form">
                  <div class="settings-details tab-content">
                    <div class="tab-pane fade active in" id="Personal">
                      <h2 class="title-section">Deneyimine Yorumla ve Puanla</h2>
                      <div class="personal-info inner-page-padding">
                        <div class="form-group">
                          <label class="col-sm-3 control-label">Puanla</label>
                          <div class="col-sm-9">
                            <input type="radio" name="yorum_puan" value="1"> 1
                            <input type="radio" name="yorum_puan" value="2"> 2
                            <input type="radio" name="yorum_puan" value="3"> 3
                            <input type="radio" name="yorum_puan" value="4"> 4
                            <input type="radio" name="yorum_puan" value="5"> 5
                          </div>
                        </div>
                        <input type="hidden" value="<?php echo $urun_id ?>" name="urun_id">
                        <input type="hidden" value="<?php echo $_GET['siparis_id'] ?>" name="siparis_id">
                        <div class="form-group">
                          <label class="col-sm-3 control-label">Yorumunuz</label>
                          <div class="col-sm-9">
                            <textarea style="height: 200px;" class="form-control" name="yorum_detay" placeholder="Yorumunuzu Giriniz" required="" type="text"></textarea>
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="text-right col-sm-12">
                            <button class="update-btn" name="puanyorumekle" id="login-update">Yorum ve Puanı Kaydet</button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </form>
              <?php } else if ($siparisdetay_onay == 2 and $siparisdetay_yorum == 1) { ?>
                <p>Bu ürün için oylama ve yorum yapılmıştır.</p>
              <?php } ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Settings Page End Here -->
<?php require_once 'footer.php'; ?>