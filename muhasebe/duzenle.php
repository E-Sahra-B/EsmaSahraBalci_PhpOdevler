<?php
require_once 'header.php';
require_once 'sidebar.php';

$masraf = $baglan->prepare("SELECT * from masraflar where masraf_id=:masraf_id");
$masraf->execute(array('masraf_id' => $_GET['id']));
$masrafcek = $masraf->fetch(PDO::FETCH_ASSOC);

$odeme = $baglan->prepare("SELECT * from odemeler where odeme_id=:odeme_id");
$odeme->execute(array('odeme_id' => $_GET['id']));
$odemecek = $odeme->fetch(PDO::FETCH_ASSOC);

$calisan = $baglan->prepare("SELECT * from calisanlar where calisan_id=:calisan_id");
$calisan->execute(array('calisan_id' => $_GET['id']));
$calisancek = $calisan->fetch(PDO::FETCH_ASSOC);

$alacak = $baglan->prepare("SELECT * from alacaklar where alacak_id=:alacak_id");
$alacak->execute(array('alacak_id' => $_GET['id']));
$alacakcek = $alacak->fetch(PDO::FETCH_ASSOC);

$satislar = $baglan->prepare("SELECT * from satislar where satis_id=:satis_id");
$satislar->execute(array('satis_id' => $_GET['id']));
$satiscek = $satislar->fetch(PDO::FETCH_ASSOC);
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <br>
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <?php if ($_GET['sayfa'] == "masrafduzenle") { ?>
          <form action="islem.php" method="post">
            <div class="card-body ">
              <div class="form-group">
                <label for="exampleInputEmail1">Başlık</label>
                <input name="baslik" value="<?php echo $masrafcek['masraf_baslik']; ?>" type="text" class="form-control" placeholder="Lütfen başlık giriniz.">
              </div>
              <div class="form-group">
                <label for="exampleInputPassword1">Açıklama</label>
                <input value="<?php echo $masrafcek['masraf_aciklama']; ?>" name="aciklama" type="text" class="form-control" placeholder="Lütfen açıklama giriniz">
              </div>
              <div class="form-group">
                <label for="exampleInputPassword1">Zaman</label>
                <input name="zaman" type="date" class="form-control" value="<?php echo $masrafcek['masraf_zaman']; ?>">
              </div>
              <div class="form-group">
                <label for="exampleInputPassword1">Kategori</label>
                <input value="<?php echo $masrafcek['masraf_kategori']; ?>" name="kategori" type="text" class="form-control" placeholder="Lütfen kategori giriniz.">
              </div>
              <div class="form-group">
                <label for="exampleInputPassword1">Tutar</label>
                <input value="<?php echo $masrafcek['masraf_tutar']; ?>" name="tutar" type="number" class="form-control" placeholder="Lütfen tutar giriniz.">
              </div>
            </div>
            <input type="hidden" name="id" value="<?php echo $masrafcek['masraf_id'] ?>">
            <div class="card-footer text-right">
              <button name="masrafduzenle" type="submit" class="btn btn-primary">Masraf Düzenle</button>
            </div>
          </form>
        <?php } elseif ($_GET['sayfa'] == "odeme") { ?>
          <form action="islem.php" method="post">
            <div class="card-body ">
              <div class="form-group">
                <label for="exampleInputEmail1">Başlık</label>
                <input name="baslik" value="<?php echo $odemecek['odeme_baslik']; ?>" type="text" class="form-control" placeholder="Lütfen başlık giriniz.">
              </div>
              <div class="form-group">
                <label for="exampleInputPassword1">Açıklama</label>
                <input value="<?php echo $odemecek['odeme_aciklama']; ?>" name="aciklama" type="text" class="form-control" placeholder="Lütfen açıklama giriniz">
              </div>
              <div class="form-group">
                <label for="exampleInputPassword1">Ödenecek zaman</label>
                <input name="zaman" type="date" class="form-control" value="<?php echo $odemecek['odeme_zaman']; ?>">
              </div>
              <div class="form-group">
                <label for="exampleInputPassword1">Kime ödenecek</label>
                <input value="<?php echo $odemecek['odeme_kime']; ?>" name="kime" type="text" class="form-control" placeholder="Lütfen kategori giriniz.">
              </div>
              <div class="form-group">
                <label for="exampleInputPassword1">Tutar</label>
                <input value="<?php echo $odemecek['odeme_tutar']; ?>" name="tutar" type="number" class="form-control" placeholder="Lütfen tutar giriniz.">
              </div>
              <div class="form-group">
                <label for="exampleInputPassword1">Ödeme alınan zaman</label>
                <input name="alinanzaman" type="date" class="form-control" value="<?php echo $odemecek['para_alinan_zaman']; ?>">
              </div>
            </div>
            <input type="hidden" name="id" value="<?php echo $odemecek['odeme_id'] ?>">
            <div class="card-footer text-right">
              <button name="odemeduzenle" type="submit" class="btn btn-primary">Ödeme Düzenle</button>
            </div>
          </form>
        <?php } elseif ($_GET['sayfa'] == "calisanlar") { ?>
          <form action="islem.php" method="post">
            <div class="card-body ">
              <div class="form-group">
                <label for="exampleInputEmail1">Çalışan isim</label>
                <input value="<?php echo $calisancek['calisan_isim'] ?>" required="" name="isim" type="text" class="form-control" placeholder="Lütfen isim giriniz.">
              </div>
              <div class="form-group">
                <label for="exampleInputPassword1">Çalışan maaş</label>
                <input value="<?php echo $calisancek['calisan_maas'] ?>" required="" name="maas" type="text" class="form-control" placeholder="Lütfen maaş giriniz">
              </div>
              <div class="form-group">
                <label for="exampleInputPassword1">İşe başlama tarihi</label>
                <input value="<?php echo $calisancek['ise_baslama_tarih'] ?>" required="" name="tarih" type="date" class="form-control">
              </div>
              <div class="form-group">
                <label for="exampleInputPassword1">Çalışan yaş </label>
                <input value="<?php echo $calisancek['calisan_yas'] ?>" name="yas" type="text" class="form-control" placeholder="Lütfen yaş giriniz.">
              </div>
              <div class="form-group">
                <label for="exampleInputPassword1">Çalışan bölüm</label>
                <input value="<?php echo $calisancek['calisan_bolum'] ?>" required="" name="bolum" type="text" class="form-control" placeholder="Lütfen bölüm  giriniz.">
              </div>
              <input type="hidden" name="id" value="<?php echo $calisancek['calisan_id'] ?>">
            </div>
            <div class="card-footer text-right">
              <button name="calisanduzenle" type="submit" class="btn btn-primary">Çalışan Düzenle</button>
            </div>
          </form>
        <?php } elseif ($_GET['sayfa'] == "alacaklar") { ?>
          <form action="islem.php" method="post">
            <div class="card-body ">
              <div class="form-group">
                <label for="exampleInputEmail1">Alacak isim</label>
                <input value="<?php echo $alacakcek['alacak_isim'] ?>" required="" name="isim" type="text" class="form-control" placeholder="Lütfen isim giriniz.">
              </div>
              <div class="form-group">
                <label for="exampleInputPassword1">Alacak açıklama</label>
                <input value="<?php echo $alacakcek['alacak_aciklama'] ?>" required="" name="aciklama" type="text" class="form-control" placeholder="Lütfen maaş giriniz">
              </div>
              <div class="form-group">
                <label for="exampleInputPassword1">Alacak tarih</label>
                <input value="<?php echo $alacakcek['alacak_zaman'] ?>" required="" name="tarih" type="date" class="form-control">
              </div>
              <div class="form-group">
                <label for="exampleInputPassword1">Alacak tutar </label>
                <input value="<?php echo $alacakcek['alacak_tutar'] ?>" name="tutar" type="text" class="form-control" placeholder="Lütfen yaş giriniz.">
              </div>
              <input type="hidden" name="id" value="<?php echo $alacakcek['alacak_id'] ?>">
            </div>
            <div class="card-footer text-right">
              <button name="alacakduzenle" type="submit" class="btn btn-primary">Alacak Düzenle</button>
            </div>
          </form>
        <?php } elseif ($_GET['sayfa'] == "satislar") { ?>
          <form action="islem.php" method="post">
            <div class="card-body ">
              <div class="form-group">
                <label for="exampleInputEmail1">Satış başlık</label>
                <input value="<?php echo $satiscek['satis_baslik'] ?>" required="" name="isim" type="text" class="form-control" placeholder="Lütfen alacak isim giriniz.">
              </div>
              <div class="form-group">
                <label for="exampleInputPassword1">Satış açıklama </label>
                <input value="<?php echo $satiscek['satis_aciklama'] ?>" required="" name="aciklama" type="text" class="form-control" placeholder="Lütfen açıklama giriniz">
              </div>
              <div class="form-group">
                <label for="exampleInputPassword1">Satış zaman</label>
                <input value="<?php echo $satiscek['satis_zaman'] ?>" required="" name="tarih" type="date" class="form-control">
              </div>
              <div class="form-group">
                <label for="exampleInputPassword1">Satış tutar </label>
                <input value="<?php echo $satiscek['satis_tutar'] ?>" name="tutar" type="text" class="form-control" placeholder="Lütfen tutar giriniz.">
              </div>
              <div class="form-group">
                <label for="exampleInputPassword1">Satış ödeme yöntemi </label>
                <input value="<?php echo $satiscek['satis_odeme'] ?>" name="odeme" type="text" class="form-control" placeholder="Lütfen tutar giriniz.">
              </div>
              <input type="hidden" name="id" value="<?php echo $satiscek['satis_id'] ?>">
            </div>
            <div class="card-footer text-right">
              <button name="satisduzenle" type="submit" class="btn btn-primary">Satış Düzenle</button>
            </div>
          </form>
        <?php } ?>
      </div>
    </div>
    <!-- /.row (main row) -->
</div><!-- /.container-fluid -->
</section>
<!-- /.content -->
</div>
<?php require_once 'footer.php'; ?>