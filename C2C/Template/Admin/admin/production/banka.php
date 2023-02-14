<?php
require_once 'header.php';
$bankasor = $db->prepare("SELECT * FROM banka order by banka_id ASC");
$bankasor->execute();
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
              if ($_GET['sil'] == "ok") { ?>
                <div class="alert alert-success alert-dismissible">
                  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                  İşlem Başarılı
                </div>
              <?php } elseif ($_GET['sil'] == "no") { ?>
                <div class="alert alert-danger alert-dismissible">
                  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                  İşlem Başarısız
                </div>
              <?php }
              ?>
            </div>
            <h2>Banka Listeleme</h2>
            <div class="clearfix"></div>
            <div class="text-right">
              <a href="banka-ekle.php"><button class="btn btn-success btn-xs"> Yeni Ekle</button></a>
            </div>
          </div>
          <div class="x_content">
            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th>S.No</th>
                  <th>Ad</th>
                  <th>Banka IBAN</th>
                  <th>Banka Hesap Ad Soyad</th>
                  <th>Banka Durum</th>
                  <th></th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <?php
                $say = 0;
                while ($bankacek = $bankasor->fetch(PDO::FETCH_ASSOC)) {
                  $say++ ?>
                  <tr>
                    <td width="20"><?php echo $say ?></td>
                    <td><?php echo $bankacek['banka_ad'] ?></td>
                    <td><?php echo $bankacek['banka_iban'] ?></td>
                    <td><?php echo $bankacek['banka_hesapadsoyad'] ?></td>
                    <td class="text-center">
                      <?php
                      if ($bankacek['banka_durum'] == 1) { ?>
                        <button class="btn btn-success btn-xs">Aktif</button>
                      <?php } else { ?>
                        <button class="btn btn-danger btn-xs">Pasif</button>
                      <?php } ?>
                    </td>
                    <td class="text-center">
                      <a href="banka-duzenle.php?banka_id=<?php echo $bankacek['banka_id']; ?>"><button class="btn btn-primary btn-xs">Düzenle</button></a>
                    </td>
                    <td class="text-center">
                      <a href="../netting/islem.php?banka_id=<?php echo $bankacek['banka_id']; ?>&bankasil=ok"><button class="btn btn-danger btn-xs">Sil</button></a>
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