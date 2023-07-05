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
            <div class="personal-info inner-page-padding">
              <div class="row">
                <strong class="title text-xl-left">Giden Mesajlar</strong>
                <button type="button" class="pull-right btn btn-success btn-sm addModalBtn" data-toggle="modal" data-target="#addMessage">
                  Yeni Mesaj Gonder
                </button>
              </div>
              <!-- <a href="mesaj-gonder" class="pull-right btn btn-success btn-sm">Yeni Mesaj Gonder</a><br><br> -->
              <br><br>
              <!-- Modal -->
              <div class="modal fade" id="addMessage" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <form method="POST" enctype="multipart/form-data" class="form-horizontal" id="addModalForm">
                      <div class="settings-details tab-content">
                        <div class="tab-pane fade active in" id="Personal">
                          <h2 class="title-section">Mesaj Gönderme İşlemleri</h2>
                          <div class="personal-info inner-page-padding">
                            <div class="form-group">
                              <label class="col-sm-3 control-label">Gönderilen Kullanıcı</label>
                              <div class="col-sm-9">
                                <!-- <input disabled="" class="form-control" required="" name="urun_ad" id="first-name" value="<?php echo $kullanicicek['kullanici_ad'] . " " . $kullanicicek['kullanici_soyad'] ?>" type="text"> -->
                                <select class="form-control" id="sendUserId" name="kullanici_gel">
                                </select>
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="col-sm-3 control-label">Mesajınız</label>
                              <div class="col-sm-9">
                                <textarea class="ckeditor" id="msjCkEditor" name="mesaj_detay" placeholder="Ürün Açıklaması..."></textarea>
                              </div>
                            </div>
                            <script type="text/javascript">
                              CKEDITOR.replace('msjCkEditor', {
                                filebrowserBrowseUrl: 'ckfinder/ckfinder.html',
                                filebrowserImageBrowseUrl: 'ckfinder/ckfinder.html?type=Images',
                                filebrowserFlashBrowseUrl: 'ckfinder/ckfinder.html?type=Flash',
                                filebrowserUploadUrl: 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
                                filebrowserImageUploadUrl: 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
                                filebrowserFlashUploadUrl: 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash',
                                forcePasteAsPlainText: true
                              });
                            </script>
                            <!-- <input type="hidden" name="kullanici_gel" value="<?php echo $_GET['kullanici_gel'] ?>"> -->
                            <div class="form-group">
                              <div class="text-right col-sm-12">
                                <button class="update-btn" name="mesajgonder" id="messageSendBtn">Mesaj Gönder</button>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
              <!-- Modal End -->

              <!-- Modal Detail -->
              <div class="modal fade" id="detailMessage" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <form method="POST" enctype="multipart/form-data" class="form-horizontal" id="detailModalForm">
                      <div class="settings-details tab-content">
                        <div class="tab-pane fade active in" id="Personal">
                          <h2 class="title-section">Mesaj Detay</h2>
                          <div class="personal-info inner-page-padding">
                            <div class="form-group">
                              <label class="col-sm-3 control-label">Mesaj Saati</label>
                              <div class="col-sm-9">
                                <input type="text" class="form-control" disabled id="detailSendTime" value="">
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="col-sm-3 control-label">Gönderilen Kullanıcı</label>
                              <div class="col-sm-9">
                                <input type="text" class="form-control" disabled id="detailSendUserId" value="">
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="col-sm-3 control-label">Mesajınız</label>
                              <div class="col-sm-9">
                                <textarea class="ckeditor form-control" rows="8" disabled id="detailSendMessage"></textarea>
                              </div>
                            </div>
                            <div class="form-group">
                              <div class="text-right col-sm-12">
                                <button type="button" class="btn btn-primary" data-dismiss="modal">Kapat</button>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
              <!-- Modal Detail End -->

              <div class="table-responsive" id="showMessage"></div>
              <!-- <table class="table table-striped">
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
                <tbody> -->
              <!-- <?php
                    $mesajsor = $db->prepare("SELECT mesaj.*,kullanici.* FROM mesaj INNER JOIN kullanici ON mesaj.kullanici_gel=kullanici.kullanici_id where mesaj.kullanici_gon=:id order by mesaj_okunma,mesaj_zaman DESC");
                    $mesajsor->execute(array(
                      'id' => $_SESSION['userkullanici_id']
                    ));
                    $say = 0;
                    while ($mesajcek = $mesajsor->fetch(PDO::FETCH_ASSOC)) {
                      $say++;
                      $kullanici_gon = $mesajcek['kullanici_gon'];
                    ?> -->
              <!-- <tr>
                <th scope="row"><?= $say ?></th>
                <td><?= uzuntarih($mesajcek['mesaj_zaman']); ?></td>
                <td><?= $mesajcek['kullanici_ad'] . " " . $mesajcek['kullanici_soyad'] ?></td>
                <td><?= guvenlik(kisalt($mesajcek['mesaj_detay'], 0, 15)) ?></td>
                <td><a href="mesaj-detay?gidenmesaj=ok&mesaj_id=<?= $mesajcek['mesaj_id'] ?>&kullanici_gon=<?= $mesajcek['kullanici_gon'] ?>"><button class="btn btn-primary btn-sm">Mesajı Oku</button></a></td> -->
              <!-- <td><a onclick="return confirm('Bu mesajı silmek istiyormusunuz? \n İşlem geri alınamaz...')" href="admin/netting/kullanici.php?gidenmesajsil=ok&mesaj_id=<?= $mesajcek['mesaj_id'] ?>"><button class="btn btn-danger btn-sm">Sil</button></a></td> -->
              <!-- <td><a href="#" id="<?= $mesajcek['mesaj_id'] ?>" class="deleteBtn"><button class="btn btn-danger btn-sm">Sil</button></a></td>
              </tr>
            <?php } ?> -->
              <!-- </tbody>
            </table> -->
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
  var site_url = '<?= URL; ?>';
  $(document).ready(function(e) {
    // $(".listTable").DataTable();
    displayAllMessage();
    $('.addModalBtn').click(function(e) {
      e.preventDefault();
      $.ajax({
        type: 'POST',
        url: site_url + '/admin/netting/kullanici.php',
        data: {
          SendUser: 'SendUser'
        },
        success: function(data) {
          $('#sendUserId').html(data);
        }
      })
    });

    function displayAllMessage() {
      $.ajax({
        type: 'POST',
        url: site_url + '/admin/netting/kullanici.php',
        data: {
          action: 'getAllMessage'
        },
        success: function(data) {
          $('#showMessage').html(data);
          $(".listTable").DataTable({
            order: [2, 'asc'] //Datatable  0. index order list
          })
        }
      });
    }

    // let sendUserId = document.getElementById('sendUserId');
    // sendUserId.addEventListener("change", function() {
    //   var kullanici_gel = $(this).children("option:selected").val();
    //   console.log(kullanici_gel);
    // });

    // $("select.kullanici_gel").on('change', function() {
    //   let kullanici_gel = $(this).children("option:selected").val();
    // });

    $("body").on("click", "#messageSendBtn", function(e) {
      e.preventDefault();
      var myData = $('#addModalForm').serializeArray();
      myData.push({
        name: 'mesaj_detay',
        value: CKEDITOR.instances.msjCkEditor.getData()
      });
      myData.push({
        name: 'mesajgonder',
        value: 'mesajgonder'
      });
      $.ajax({
        type: 'POST',
        url: site_url + '/admin/netting/kullanici.php',
        data: myData,
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
            $("#addModalForm").trigger("reset");
            CKEDITOR.instances.msjCkEditor.setData('');
            $("#addMessage").modal('hide');
            Swal.fire({
              title: "İşlemi Tamam",
              text: data.success,
              icon: "success",
              position: "top-center",
              timer: 2500,
              showConfirmButton: false,
            });
            displayAllMessage();
          }
        }
      })
    })

    $("body").on("click", ".deleteBtn", function(e) {
      //$('.deleteBtn').click(function(e) {
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
        confirmButtonText: 'Evet Sil!',
        cancelButtonText: 'İptal'
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
                displayAllMessage();
              }
            }
          });
        }
      })
    })

    $("body").on("click", ".detailBtn", function(e) {
      e.preventDefault();
      detail_id = $(this).attr('id');
      $.ajax({
        type: 'POST',
        url: site_url + '/admin/netting/kullanici.php',
        dataType: 'json',
        data: {
          mesaj_id: detail_id,
          action: 'mesaggeDetail'
        },
        success: function(result) {
          //success: function(data) {
          //result = JSON.parse(data); //dataType: 'json' olunca gerek yok
          $('#detailSendUserId').val(result.kullanici_ad + ' ' + result.kullanici_soyad);
          $('#detailSendTime').val(result.mesaj_zaman);
          //$('#detailSendMessage').val(result.mesaj_detay);
          CKEDITOR.instances.detailSendMessage.setData(result.mesaj_detay);
        }
      })
    })
  });
</script>
<!-- Settings Page End Here -->
<?php require_once 'footer.php'; ?>