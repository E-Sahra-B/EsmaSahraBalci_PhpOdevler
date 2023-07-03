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
            <h2 class="title-section">Giden Mesajlar</h2>
            <div class="personal-info inner-page-padding">
              <a href="mesaj-gonder" class="pull-right btn btn-success btn-xs">Yeni Mesaj Gonder</a><br><br>
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Mesaj Tarihi</th>
                    <th scope="col">Gönderilen Kullanıcı</th>
                    <th scope="col">İçerik</th>
                    <th scope="col">Detay</th>
                    <th scope="col">Sil</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $mesajsor = $db->prepare("SELECT mesaj.*,kullanici.* FROM mesaj INNER JOIN kullanici ON mesaj.kullanici_gel=kullanici.kullanici_id where mesaj.kullanici_gon=:id order by mesaj_okunma,mesaj_zaman DESC");
                  $mesajsor->execute(array(
                    'id' => $_SESSION['userkullanici_id']
                  ));
                  $say = 0;
                  while ($mesajcek = $mesajsor->fetch(PDO::FETCH_ASSOC)) {
                    $say++;
                    $kullanici_gon = $mesajcek['kullanici_gon'];
                  ?>
                    <tr>
                      <th scope="row"><?= $say ?></th>
                      <td><?= uzuntarih($mesajcek['mesaj_zaman']); ?></td>
                      <td><?= $mesajcek['kullanici_ad'] . " " . $mesajcek['kullanici_soyad'] ?></td>
                      <td><?= guvenlik(kisalt($mesajcek['mesaj_detay'], 0, 15)) ?></td>
                      <td><a href="mesaj-detay?gidenmesaj=ok&mesaj_id=<?= $mesajcek['mesaj_id'] ?>&kullanici_gon=<?= $mesajcek['kullanici_gon'] ?>"><button class="btn btn-primary btn-xs">Mesajı Oku</button></a></td>
                      <!-- <td><a onclick="return confirm('Bu mesajı silmek istiyormusunuz? \n İşlem geri alınamaz...')" href="admin/netting/kullanici.php?gidenmesajsil=ok&mesaj_id=<?= $mesajcek['mesaj_id'] ?>"><button class="btn btn-danger btn-xs">Sil</button></a></td> -->
                      <td><a href="#" id="<?= $mesajcek['mesaj_id'] ?>" class="deleteBtn"><button class="btn btn-danger btn-xs">Sil</button></a></td>
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
<script>
  var site_url = '<?= URL; ?>';
  $(document).ready(function() {
    $('.deleteBtn').click(function(e) {
      e.preventDefault();
      del_id = $(this).attr('id');
      Swal.fire({
        title: 'Bu mesajı silmek istiyor musunuz?',
        text: "İşlem geri alınamaz!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#ccc',
        canselButtonText: 'iptal',
        confirmButtonText: 'Evet Sil!'
      }).then((result) => {
        if (result.isConfirmed) {
          $.ajax({
            method: 'POST',
            url: site_url + '/admin/netting/kullanici.php',
            data: {
              mesajsil: del_id
            },
            dataType: 'json',
            success: function(data) {
              if (data.danger) {
                Swal.fire({
                  title: "Hatalı İşlem",
                  text: data.danger,
                  icon: "error",
                  position: "top-center",
                  timer: 2500,
                  showConfirmButton: false,
                });
              } else if (data.success) {
                Swal.fire({
                  title: "İşlemi Tamam",
                  text: data.success,
                  icon: "success",
                  position: "top-center",
                  timer: 2500,
                  showConfirmButton: false,
                });
              }
            }
          });
        }
      })
    })
  });
</script>
<!-- Settings Page End Here -->
<?php require_once 'footer.php'; ?>