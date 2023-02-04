<?php
require_once 'header.php';
require_once 'sidebar.php';
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <?php if ($_GET['sayfa'] == "masraflar") { ?>
            <div class="card-header">
              <h3 class="card-title"><label>Masraflar</label></h3>
              <?php if (@$_GET['durum'] == "ok") { ?>
                <div class="alert alert-primary" role="alert">
                  İşleminiz başarılı bir şekilde tamamlandı
                </div>
              <?php } elseif (@$_GET['durum'] == "no") { ?>
                <div class="alert alert-danger" role="alert">
                  İşleminiz yapılırken bir hata oluştu.
                </div>
              <?php } ?>
              <div class="text-right">
                <a href="ekle.php?sayfa=masrafekle" type="submit" class="btn btn-primary btn-sm">Masraf Ekle</a>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
              <table class="table table-hover text-nowrap">
                <thead>
                  <tr>
                    <th>Numara</th>
                    <th>Başlık</th>
                    <th>Açıklama</th>
                    <th class="text-right">Tutar</th>
                    <th>Kategori</th>
                    <th>Zaman</th>
                    <th></th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  <?php $masraf = $baglan->prepare("SELECT * from masraflar");
                  $masraf->execute();
                  while ($masrafcek = $masraf->fetch(PDO::FETCH_ASSOC)) { ?>
                    <tr>
                      <td><?php echo $masrafcek['masraf_id']; ?></td>
                      <td><?php echo $masrafcek['masraf_baslik'] ?></td>
                      <td><?php echo $masrafcek['masraf_aciklama'] ?></td>
                      <td class="text-right"><span class="tag tag-success"><?php echo number_format($masrafcek['masraf_tutar'], "2", ",", ".") ?> ₺ </span></td>
                      <td><?php echo $masrafcek['masraf_kategori'] ?></td>
                      <td><?php echo date("d-m-Y", strtotime($masrafcek['masraf_zaman'])) ?></td>
                      <td>
                        <a href="duzenle.php?sayfa=masrafduzenle&id=<?php echo $masrafcek['masraf_id'] ?>">
                          <button type="submit" class="btn btn-info btn-sm">Düzenle</button>
                        </a>
                      </td>
                      <td>
                        <form action="islem.php" method="post">
                          <button name="masrafsil" type="submit" class="btn btn-danger btn-sm">Sil</button>
                      </td>
                      <input type="hidden" name="id" value="<?php echo $masrafcek['masraf_id'] ?>">
                      </form>
                    </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
          <?php } elseif ($_GET['sayfa'] == "odemeler") { ?>
            <div class="card-header">
              <h3 class="card-title"><label>Ödemeler</label></h3>
              <?php if (@$_GET['durum'] == "ok") { ?>
                <div class="alert alert-primary" role="alert">
                  İşleminiz başarılı bir şekilde tamamlandı
                </div>
              <?php } elseif (@$_GET['durum'] == "no") { ?>
                <div class="alert alert-danger" role="alert">
                  İşleminiz yapılırken bir hata oluştu.
                </div>
              <?php } ?>
              <div class="text-right">
                <a href="ekle.php?sayfa=odeme" type="submit" class="btn btn-primary btn-sm">Ödeme Ekle</a>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
              <table class="table table-hover text-nowrap">
                <thead>
                  <tr>
                    <th>Başlık</th>
                    <th>Açıklama</th>
                    <th>Tutar</th>
                    <th>Kime ödenecek</th>
                    <th>Para alınan zaman</th>
                    <th>Para ödenecek zaman</th>
                    <th></th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  <?php $odeme = $baglan->prepare("SELECT * from odemeler order by odeme_id DESC");
                  $odeme->execute();
                  while ($odemecek = $odeme->fetch(PDO::FETCH_ASSOC)) { ?>
                    <tr>
                      <td><?php echo $odemecek['odeme_baslik'] ?></td>
                      <td style="width:20px !important"><?php echo $odemecek['odeme_aciklama'] ?></td>
                      <td><span class="tag tag-success"><?php echo number_format($odemecek['odeme_tutar'], "2", ",", ".") ?> ₺</span></td>
                      <td><?php echo $odemecek['odeme_kime'] ?></td>
                      <td><?php echo date("d-m-Y", strtotime($odemecek['para_alinan_zaman'])) ?></td>
                      <td><?php echo date("d-m-Y", strtotime($odemecek['odeme_zaman'])) ?></td>
                      <td><a href="duzenle.php?sayfa=odeme&id=<?php echo $odemecek['odeme_id'] ?>"><button type="submit" class="btn btn-info btn-sm">Düzenle</button></a></td>
                      <td>
                        <form action="islem.php" method="post">
                          <button name="odemesil" type="submit" class="btn btn-danger btn-sm">Sil</button>
                      </td>
                      <input type="hidden" name="id" value="<?php echo $odemecek['odeme_id'] ?>">
                      </form>
                    </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
          <?php } elseif ($_GET['sayfa'] == "calisanlar") { ?>
            <div class="card-header">
              <h3 class="card-title"><label>Çalışanlar</label></h3>
              <?php if (@$_GET['durum'] == "ok") { ?>
                <div class="alert alert-primary" role="alert">
                  İşleminiz başarılı bir şekilde tamamlandı
                </div>
              <?php } elseif (@$_GET['durum'] == "no") { ?>
                <div class="alert alert-danger" role="alert">
                  İşleminiz yapılırken bir hata oluştu.
                </div>
              <?php } ?>
              <div class="text-right">
                <a href="ekle.php?sayfa=calisan" type="submit" class="btn btn-primary btn-sm">Çalışan Ekle</a>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
              <table class="table table-hover text-nowrap">
                <thead>
                  <tr>
                    <th>Çalışan isim</th>
                    <th>Çalışan yaş</th>
                    <th>Çalışan bölüm</th>
                    <th>Çalışan maaş</th>
                    <th>İşe başlama tarihi</th>
                    <th></th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  <?php $calisan = $baglan->prepare("SELECT * from calisanlar order by calisan_id DESC");
                  $calisan->execute();
                  while ($calisancek = $calisan->fetch(PDO::FETCH_ASSOC)) { ?>
                    <tr>
                      <td><?php echo $calisancek['calisan_isim'] ?></td>
                      <td style="width:20px !important"><?php echo $calisancek['calisan_yas'] ?></td>
                      <td><span class="tag tag-success"><?php echo $calisancek['calisan_bolum'] ?></span></td>
                      <td><?php echo number_format($calisancek['calisan_maas'], "2", ",", ".") ?> ₺</td>
                      <td><?php echo date("d-m-Y", strtotime($calisancek['ise_baslama_tarih'])) ?></td>
                      <td><a href="duzenle.php?sayfa=calisanlar&id=<?php echo $calisancek['calisan_id'] ?>"><button type="submit" class="btn btn-info btn-sm">Düzenle</button></a></td>
                      <td>
                        <form action="islem.php" method="post">
                          <button name="calisansil" type="submit" class="btn btn-danger btn-sm">Sil</button>
                      </td>
                      <input type="hidden" name="id" value="<?php echo $calisancek['calisan_id'] ?>">
                      </form>
                    </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
          <?php } elseif ($_GET['sayfa'] == "alacaklar") { ?>
            <div class="card-header">
              <h3 class="card-title"><label>Alacaklarım</label></h3>
              <?php if (@$_GET['durum'] == "ok") { ?>
                <div class="alert alert-primary" role="alert">
                  İşleminiz başarılı bir şekilde tamamlandı
                </div>
              <?php } elseif (@$_GET['durum'] == "no") { ?>
                <div class="alert alert-danger" role="alert">
                  İşleminiz yapılırken bir hata oluştu.
                </div>
              <?php } ?>
              <div class="text-right">
                <a href="ekle.php?sayfa=alacaklar" type="submit" class="btn btn-primary btn-sm">Alacak Ekle</a>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
              <table class="table table-hover text-nowrap">
                <thead>
                  <tr>
                    <th>Alacak isim</th>
                    <th>Alacak açıklaması</th>
                    <th>Alacak zaman</th>
                    <th>Alacak tutar</th>
                    <th></th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  <?php $alacak = $baglan->prepare("SELECT * from alacaklar order by alacak_id DESC");
                  $alacak->execute();
                  while ($alacakcek = $alacak->fetch(PDO::FETCH_ASSOC)) { ?>
                    <tr>
                      <td><?php echo $alacakcek['alacak_isim'] ?></td>
                      <td style="width:20px !important"><?php echo $alacakcek['alacak_aciklama'] ?></td>
                      <td><span class="tag tag-success"><?php echo date("d-m-Y", strtotime($alacakcek['alacak_zaman'])) ?></span></td>
                      <td><?php echo number_format($alacakcek['alacak_tutar'], "2", ",", ".") ?> ₺</td>
                      <td><a href="duzenle.php?sayfa=alacaklar&id=<?php echo $alacakcek['alacak_id'] ?>"><button type="submit" class="btn btn-info btn-sm">Düzenle</button></a></td>
                      <td>
                        <form action="islem.php" method="post">
                          <button name="alacaksil" type="submit" class="btn btn-danger btn-sm">Sil</button>
                      </td>
                      <input type="hidden" name="id" value="<?php echo $alacakcek['alacak_id'] ?>">
                      </form>
                    </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
          <?php } elseif ($_GET['sayfa'] == "satislar") { ?>
            <div class="card-header">
              <h3 class="card-title"><label>Satışlarım</label></h3>
              <?php if (@$_GET['durum'] == "ok") { ?>
                <div class="alert alert-primary" role="alert">
                  İşleminiz başarılı bir şekilde tamamlandı
                </div>
              <?php } elseif (@$_GET['durum'] == "no") { ?>
                <div class="alert alert-danger" role="alert">
                  İşleminiz yapılırken bir hata oluştu.
                </div>
              <?php } ?>
              <div class="text-right">
                <a href="ekle.php?sayfa=satis" type="submit" class="btn btn-primary btn-sm">Satış Ekle</a>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
              <table class="table table-hover text-nowrap">
                <thead>
                  <tr>
                    <th>Satış başlık</th>
                    <th>Satış açıklama</th>
                    <th>Satış zaman</th>
                    <th>Satış tutar</th>,
                    <th>Satış ödeme yöntemi</th>
                    <th></th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  <?php $satis = $baglan->prepare("SELECT * from satislar order by satis_id DESC");
                  $satis->execute();
                  while ($satiscek = $satis->fetch(PDO::FETCH_ASSOC)) { ?>
                    <tr>
                      <td><?php echo $satiscek['satis_baslik'] ?></td>
                      <td><?php echo $satiscek['satis_aciklama'] ?></td>
                      <td><span class="tag tag-success"><?php echo date("d-m-Y", strtotime($satiscek['satis_zaman'])) ?></span></td>
                      <td><?php echo number_format($satiscek['satis_tutar'], "2", ",", ".") ?> ₺</td>
                      <td><?php echo $satiscek['satis_odeme'] ?></td>
                      <td><a href="duzenle.php?sayfa=satislar&id=<?php echo $satiscek['satis_id'] ?>"><button type="submit" class="btn btn-info btn-sm">Düzenle</button></a></td>
                      <td>
                        <form action="islem.php" method="post">
                          <button name="satisil" type="submit" class="btn btn-danger btn-sm">Sil</button>
                      </td>
                      <input type="hidden" name="id" value="<?php echo $satiscek['satis_id'] ?>">
                      </form>
                    </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
    </div>
  <?php } ?>
</div><!-- /.container-fluid -->
</section>
<!-- /.content -->
</div>
<?php require_once 'footer.php'; ?>