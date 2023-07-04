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
            <h2 class="title-section">Gelen Mesajlar</h2>
            <div class="personal-info inner-page-padding">
              <div id="showMessage"></div>
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
    displayAllMessage();

    function displayAllMessage() {
      $.ajax({
        type: 'POST',
        url: site_url + '/admin/netting/kullanici.php',
        data: {
          action: 'getAllMessageInbox'
        },
        success: function(data) {
          $('#showMessage').html(data);
          $(".listTable").DataTable({
            order: [4, 'asc']
          })
        }
      });
    }

    $("body").on("click", ".deleteBtn", function(e) {
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
                displayAllMessage();
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