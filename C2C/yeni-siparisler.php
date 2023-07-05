﻿<?php
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
            <h2 class="title-section">Yeni Siparişler</h2>
            <div class="personal-info inner-page-padding">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Tarih</th>
                    <th scope="col">Sipariş No</th>
                    <th scope="col">Alıcı</th>
                    <th scope="col">Ürün Ad</th>
                    <th scope="col">Ürün Fiyat</th>
                    <th scope="col">Durum</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $siparissor = $db->prepare("SELECT siparis.*,siparis_detay.*,kullanici.*,urun.*
                  FROM siparis 
                  INNER JOIN siparis_detay ON siparis.siparis_id=siparis_detay.siparis_id 
                  INNER JOIN kullanici ON kullanici.kullanici_id=siparis_detay.kullanici_id 
                  INNER JOIN urun ON urun.urun_id=siparis_detay.urun_id 
                  where siparis.kullanici_idsatici=:kullanici_idsatici 
                  order by siparis_zaman DESC");
                  $siparissor->execute(array(
                    'kullanici_idsatici' => $_SESSION['userkullanici_id']
                  ));
                  $say = 0;
                  while ($sipariscek = $siparissor->fetch(PDO::FETCH_ASSOC)) {
                    $say++ ?>
                    <tr>
                      <th scope="row"><?= $say ?></th>
                      <td><?= tarih($sipariscek['siparis_zaman']) ?></td>
                      <td><?= $sipariscek['siparis_id'] ?></td>
                      <td><?= $sipariscek['kullanici_ad'] . " " . $sipariscek['kullanici_soyad'] ?></td>
                      <td><?= $sipariscek['urun_ad'] ?></td>
                      <td><?= fiyat($sipariscek['urun_fiyat']) ?></td>
                      <td><?php
                          if ($sipariscek['siparisdetay_onay'] == 0) { ?>
                          <a onclick="return confirm('Ürünü Teslim Ediyorsunuz Bu İşlem Geri Alınamaz');" href="admin/netting/kullanici.php?urunteslim=ok&siparisdetay_id=<?= $sipariscek['siparisdetay_id'] ?>&siparis_id=<?= $sipariscek['siparis_id'] ?>"><button class="btn btn-warning btn-xs"> Teslim Et</button></a>
                        <?php } elseif ($sipariscek['siparisdetay_onay'] == 1) { ?>
                          <button class="btn btn-info btn-xs"> Alıcıdan Onay Bekliyor</button>
                        <?php } elseif ($sipariscek['siparisdetay_onay'] == 2) { ?>
                          <button class="btn btn-success btn-xs"> Tamamalanan Siparis</button>
                        <?php } ?>
                      </td>
                    </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Settings Page End Here -->
<?php require_once 'footer.php'; ?>