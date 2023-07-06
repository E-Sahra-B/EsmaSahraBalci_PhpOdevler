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
                <?php require_once 'alert.php'; ?>
            </div>
            <div class="col-lg-9 col-md-9 col-sm-8 col-xs-12">
                <div class="settings-details tab-content">
                    <div class="tab-pane fade active in" id="Personal">
                        <h2 class="title-section">Ürünleriniz</h2>
                        <div class="personal-info inner-page-padding">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Ürün Eklenme Tarihi</th>
                                        <th scope="col">Ürün adı</th>
                                        <th scope="col"></th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $urunsor = $db->prepare("SELECT * FROM urun where kullanici_id=:kullanici_id order by urun_zaman DESC");
                                    $urunsor->execute(array(
                                        'kullanici_id' => $_SESSION['userkullanici_id']
                                    ));
                                    $say = 0;
                                    while ($uruncek = $urunsor->fetch(PDO::FETCH_ASSOC)) {
                                        $say++ ?>
                                        <tr>
                                            <th scope="row"><?= $say ?></th>
                                            <td><?= tarih($uruncek['urun_zaman']) ?></td>
                                            <td><?= $uruncek['urun_ad'] ?></td>
                                            <td><a href="urun-duzenle?urun_id=<?= $uruncek['urun_id'] ?>"><button class="btn btn-primary btn-xs">Düzenle</button></a></td>
                                            <td>
                                                <?php if ($uruncek['urun_durum'] == 0) : ?>
                                                    <button class="btn btn-warning btn-xs">Onay Bekliyor</button>
                                                <?php else : ?>
                                                    <!-- <a onclick="return confirm('Bu ürünü silmek istiyormusunuz? \nİşlem geri alınamaz...')" href="admin/netting/adminislem.php?magazaurunsil=ok&urun_id=<?= $uruncek['urun_id'] ?>&urunfoto_resimyol=<?= $uruncek['urunfoto_resimyol'] ?>"><button class="btn btn-danger btn-xs">Ürün Sil</button></a> -->
                                                    <a href="#" class="deleteBtn" id="<?= $uruncek['urun_id'] ?>" data-resim="<?= $uruncek['urunfoto_resimyol'] ?>"><button class="btn btn-danger btn-xs">Ürün Sil</button></a>
                                                <?php endif ?>
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
<script>
    var site_url = '<?= URL; ?>';
    $(document).ready(function() {
        //$('.deleteBtn').click(function(e) {
        $("body").on("click", ".deleteBtn", function(e) {
            e.preventDefault();
            del_id = $(this).attr('id');
            resimyol = $(this).attr('data-resim');
            Swal.fire({
                title: 'Bu ürünü silmek istiyor musunuz?',
                text: 'İşlem geri alınamaz!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#ccc',
                confirmButtonText: 'Evet Sil!',
                cancelButtonText: 'iptal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        method: 'POST',
                        url: site_url + '/admin/netting/kullanici.php',
                        data: {
                            urunsil: del_id,
                            resimyol: resimyol
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