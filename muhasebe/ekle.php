<?php
require_once 'header.php';
require_once 'sidebar.php';
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <br>
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <?php if ($_GET['sayfa'] == "masrafekle") { ?><!-- Masraf Ekle -->
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Yeni masraf ekle</h3>
            </div>
            <form action="islem.php" method="post">
              <div class="card-body ">
                <div class="form-group">
                  <label for="exampleInputEmail1">Başlık</label>
                  <input required="" name="baslik" type="text" class="form-control" placeholder="Lütfen başlık giriniz.">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Açıklama</label>
                  <input required="" name="aciklama" type="text" class="form-control" placeholder="Lütfen açıklama giriniz">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Zaman</label>
                  <input required="" name="zaman" type="date" class="form-control">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Kategori</label>
                  <input name="kategori" type="text" class="form-control" placeholder="Lütfen kategori giriniz.">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Tutar</label>
                  <input required="" name="tutar" type="number" class="form-control" placeholder="Lütfen tutar giriniz.">
                </div>
              </div>
              <div class="card-footer text-right">
                <button name="masrafekle" type="submit" class="btn btn-primary">Masraf Ekle</button>
              </div>
              <div class="text-left">
                <a href="sayfa.php?sayfa=masraflar" class="btn btn-success">Masraf Listesi</a>
              </div>
            </form>
          </div>
        <?php } elseif ($_GET['sayfa'] == "odeme") { ?><!-- Ödeme -->
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Yeni ödeme ekle</h3>
            </div>
            <form action="islem.php" method="post">
              <div class="card-body ">
                <div class="form-group">
                  <label for="exampleInputEmail1">Başlık</label>
                  <input required="" name="baslik" type="text" class="form-control" placeholder="Lütfen başlık giriniz.">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Açıklama</label>
                  <input required="" name="aciklama" type="text" class="form-control" placeholder="Lütfen açıklama giriniz">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Ödenecek Zaman</label>
                  <input required="" name="zaman" type="date" class="form-control">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Kime ödeme yapılacak? </label>
                  <input name="kime" type="text" class="form-control" placeholder="Lütfen ödeme kime yapılacak giriniz.">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Tutar</label>
                  <input required="" name="tutar" type="number" class="form-control" placeholder="Lütfen tutar giriniz.">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Ödeme alınan zaman</label>
                  <input required="" name="alinanzaman" type="date" class="form-control" placeholder="Lütfen ödemeyi aldığınız zamanı giriniz. giriniz.">
                </div>
              </div>
              <div class="card-footer text-right">
                <button name="odemeekle" type="submit" class="btn btn-primary">Ödeme Ekle</button>
              </div>
            </form>
          </div>
        <?php } elseif ($_GET['sayfa'] == "calisan") { ?><!-- Çalışan -->
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Yeni Çalışan ekle</h3>
            </div>
            <form action="islem.php" method="post">
              <div class="card-body ">
                <div class="form-group">
                  <label for="exampleInputEmail1">Çalışan isim</label>
                  <input required="" name="isim" type="text" class="form-control" placeholder="Lütfen isim giriniz.">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Çalışan maaş</label>
                  <input required="" name="maas" type="text" class="form-control" placeholder="Lütfen maaş giriniz">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">İşe başlama tarihi</label>
                  <input required="" name="tarih" type="date" class="form-control">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Çalışan yaş </label>
                  <input name="yas" type="text" class="form-control" placeholder="Lütfen yaş giriniz.">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Çalışan bölüm</label>
                  <input required="" name="bolum" type="text" class="form-control" placeholder="Lütfen bölüm  giriniz.">
                </div>
              </div>
              <div class="card-footer text-right">
                <button name="calisanekle" type="submit" class="btn btn-primary">Çalışan Ekle</button>
              </div>
            </form>
          </div>
        <?php } elseif ($_GET['sayfa'] == "alacaklar") { ?><!-- Alacaklar -->
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Yeni alacak ekle</h3>
            </div>
            <form action="islem.php" method="post">
              <div class="card-body ">
                <div class="form-group">
                  <label for="exampleInputEmail1">Alacak isim</label>
                  <input required="" name="isim" type="text" class="form-control" placeholder="Lütfen alacak isim giriniz.">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Alacak açıklama</label>
                  <input required="" name="aciklama" type="text" class="form-control" placeholder="Lütfen açıklama giriniz">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Alacak zaman</label>
                  <input required="" name="tarih" type="date" class="form-control">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Alacak tutar </label>
                  <input name="tutar" type="text" class="form-control" placeholder="Lütfen tutar giriniz.">
                </div>
              </div>
              <div class="card-footer text-right">
                <button name="alacakekle" type="submit" class="btn btn-primary">Alacak Ekle</button>
              </div>
            </form>
          </div>
        <?php } elseif ($_GET['sayfa'] == "satis") { ?><!-- Satış -->
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Yeni satış ekle</h3>
            </div>
            <form action="islem.php" method="post">
              <div class="card-body ">
                <div class="form-group">
                  <label for="exampleInputEmail1">Satış başlık</label>
                  <input required="" name="isim" type="text" class="form-control" placeholder="Lütfen alacak isim giriniz.">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Satış açıklama </label>
                  <input required="" name="aciklama" type="text" class="form-control" placeholder="Lütfen açıklama giriniz">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Satış zaman</label>
                  <input required="" name="tarih" type="date" class="form-control">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Satış tutar </label>
                  <input name="tutar" type="text" class="form-control" placeholder="Lütfen tutar giriniz.">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Satış ödeme yöntemi </label>
                  <input name="odeme" type="text" class="form-control" placeholder="Lütfen tutar giriniz.">
                </div>
              </div>
              <div class="card-footer text-right">
                <button name="satisekle" type="submit" class="btn btn-primary">Satış Ekle</button>
              </div>
            </form>
          </div>
        <?php } ?>
      </div>
    </div>
    <!-- /.row (main row) -->
</div><!-- /.container-fluid -->
</section>
<!-- /.content -->
</div>
<?php require_once 'footer.php'; ?>