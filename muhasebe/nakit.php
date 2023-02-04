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
          <div class="card-header">
            <?php if (@$_GET['durum'] == "ok") { ?>
              <div class="alert alert-primary" role="alert">
                İşleminiz başarılı bir şekilde tamamlandı
              </div>
            <?php } elseif (@$_GET['durum'] == "no") { ?>
              <div class="alert alert-danger" role="alert">
                İşleminiz yapılırken bir hata oluştu.
              </div>
            <?php } ?>
            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Para Girişi Ekle</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <form action="islem.php" method="post">
                      <div class="form-group">
                        <select name="sec" class="form-control" aria-label="Default select example">
                          <option selected>Lütfen Para Giriş/Çıkışı Seçiniz</option>
                          <option value="1">Para Girişi</option>
                          <option value="2">Para Çıkışı</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Başlık:</label>
                        <input type="text" class="form-control" id="recipient-name" name="baslik" placeholder="Başlık Giriniz.">
                      </div>
                      <div class="form-group">
                        <label for="message-text" class="col-form-label">Açıklama:</label>
                        <textarea class="form-control" id="message-text" name="aciklama" value="yazi"></textarea>
                      </div>
                      <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Zaman:</label>
                        <input type="date" class="form-control" id="recipient-name" name="zaman">
                      </div>
                      <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Tutar:</label>
                        <input type="text" class="form-control" id="recipient-name" name="tutar" placeholder="Tutar Giriniz">
                      </div>

                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>
                    <button name="nakit" type="submit" class="btn btn-primary">Gönder</button>
                  </div>
                  </form>
                </div>
              </div>
            </div>
            <!-- Button trigger modal -->
            <div class="text-right">
              <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">Para Girişi / Çıkışı</button>
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
                  <th>Gelen</th>
                  <th>Giden</th>
                  <th>Zaman</th>
                  <th></th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <?php $nakit = $baglan->prepare("SELECT * from nakit");
                $nakit->execute();
                $toplamgirdi = 0;
                $toplamcikti = 0;
                while ($nakitcek = $nakit->fetch(PDO::FETCH_ASSOC)) {
                  $toplamgirdi += $nakitcek['para_gelen'];
                  $toplamcikti += $nakitcek['para_giden'];
                ?>
                  <tr>
                    <td><?php echo $nakitcek['nakit_id'] ?></td>
                    <td><?php echo $nakitcek['para_baslik'] ?></td>
                    <td><?php echo $nakitcek['para_aciklama'] ?></td>
                    <td><?php echo number_format($nakitcek['para_gelen'], "2", ",", ".") ?></td>
                    <td><?php echo number_format($nakitcek['para_giden'], "2", ",", ".") ?></td>
                    <td><?php echo date("d-m-Y", strtotime($nakitcek['para_zaman'])) ?></td>
                    <!-- <td><a href="duzenle.php?sayfa=nakitduzenle&id=<?php echo $nakitcek['nakit_id'] ?>"><button type="submit" class="btn btn-info btn-sm">Düzenle</button></a></td> -->
                    <td>
                      <form action="islem.php" method="post">
                        <button name="nakitsil" type="submit" class="btn btn-danger btn-sm">Sil</button>
                        <input type="hidden" name="id" value="<?php echo $nakitcek['nakit_id'] ?>">
                      </form>
                    </td>
                  </tr>
                <?php } ?>
              </tbody>
            </table>
            <hr><br>
            <div class="container">
              <div class="row">
                <div class="col-md-9">
                </div>
                <div class="col-md-3">
                  <div class="text-right">
                    <label>Toplam gelen : <?php echo number_format($toplamgirdi, "2", ",", ".") ?> ₺</label><br>
                    <label>Toplam giden : <?php echo number_format($toplamcikti, "2", ",", ".") ?> ₺</label>
                  </div>
                </div>
              </div>
            </div>
            <br>
          </div>
        </div>
      </div>
      <!-- /.row (main row) -->
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
<?php require_once 'footer.php'; ?>