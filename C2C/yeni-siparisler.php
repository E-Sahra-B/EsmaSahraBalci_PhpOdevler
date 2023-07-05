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
            <h2 class="title-section">Yeni Siparişler</h2>
            <div class="personal-info inner-page-padding">
              <div id="showList"></div>

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
    orderList();

    function orderList() {
      $.ajax({
        type: 'POST',
        url: site_url + '/admin/netting/kullanici.php',
        data: {
          action: 'orderList'
        },
        success: function(data) {
          $('#showList').html(data);
        }
      });
    }
    $("body").on("click", ".teslimEt", function(e) {
      e.preventDefault();
      onay_id = $(this).attr('id');
      console.log(onay_id);
      Swal.fire({
        title: 'Ürünü Teslim Ediyorsunuz ?',
        text: "İşlem geri alınamaz!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#8bc34a',
        cancelButtonColor: '#ccc',
        confirmButtonText: 'Evet Teslim Et!',
        canselButtonText: 'iptal'
      }).then((result) => {
        if (result.isConfirmed) {
          $.ajax({
            method: 'POST',
            url: site_url + '/admin/netting/kullanici.php',
            data: {
              action: 'teslimEtOnay',
              siparis_id: onay_id
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
                orderList();
              }
            }
          });
        }
      })
    })
  })
</script>
<!-- Settings Page End Here -->
<?php require_once 'footer.php'; ?>