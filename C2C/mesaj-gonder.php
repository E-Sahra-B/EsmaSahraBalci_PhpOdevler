<?php
require_once 'header.php';
giriskontrol();
$kullanicisor = $db->prepare("SELECT * FROM kullanici where kullanici_id=:id");
$kullanicisor->execute(array(
    'id' => $_GET['kullanici_gel']
));
$kullanicicek = $kullanicisor->fetch(PDO::FETCH_ASSOC);
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
                <form method="POST" enctype="multipart/form-data" class="form-horizontal" id="mesajgondermeformu">
                    <div class="settings-details tab-content">
                        <div class="tab-pane fade active in" id="Personal">
                            <div class="personal-info inner-page-padding">
                                <div class="row">
                                    <strong class="title text-xl-left">Mesaj Gönderme İşlemleri</strong>
                                    <a href="giden-mesajlar" id="sonuc"></a>
                                </div><br><br>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Gönderilen Kullanıcı</label>
                                    <div class="col-sm-9">
                                        <input disabled="" class="form-control" required="" name="urun_ad" id="first-name" value="<?php echo $kullanicicek['kullanici_ad'] . " " . $kullanicicek['kullanici_soyad'] ?>" type="text">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Mesajınız</label>
                                    <div class="col-sm-9">
                                        <textarea class="ckeditor" id="editor1" name="mesaj_detay" placeholder="Ürün Açıklaması..."></textarea>
                                    </div>
                                </div>
                                <script type="text/javascript">
                                    CKEDITOR.replace('editor1', {
                                        filebrowserBrowseUrl: 'ckfinder/ckfinder.html',
                                        filebrowserImageBrowseUrl: 'ckfinder/ckfinder.html?type=Images',
                                        filebrowserFlashBrowseUrl: 'ckfinder/ckfinder.html?type=Flash',
                                        filebrowserUploadUrl: 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
                                        filebrowserImageUploadUrl: 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
                                        filebrowserFlashUploadUrl: 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash',
                                        forcePasteAsPlainText: true
                                    });
                                </script>
                                <input type="hidden" name="kullanici_gel" value="<?php echo $_GET['kullanici_gel'] ?>">
                                <div class="form-group">
                                    <div class="text-right col-sm-12">
                                        <button class="update-btn" name="mesajgonder" id="mesajgondermebtn">Mesaj Gönder</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    var site_url = '<?= URL; ?>';
    $(document).ready(function() {
        $("body").on("click", "#mesajgondermebtn", function(e) {
            e.preventDefault();
            var myData = $('#mesajgondermeformu').serializeArray();
            myData.push({
                name: 'mesaj_detay',
                value: CKEDITOR.instances.editor1.getData()
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
                        CKEDITOR.instances.editor1.setData('');
                        Swal.fire({
                            title: "İşlemi Tamam",
                            text: data.success,
                            icon: "success",
                            position: "top-center",
                            timer: 2500,
                            showConfirmButton: false,
                        });
                        $("#sonuc").append('<button type="button" class="pull-right btn btn-success btn-sm"> Gönderilen Mesajlara Git</button>');
                    }
                }
            })
        })
    })
</script>
<!-- Settings Page End Here -->
<?php require_once 'footer.php'; ?>