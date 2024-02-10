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
                <form method="POST" enctype="multipart/form-data" class="form-horizontal" id="magazaurunekle-form">
                    <div class="settings-details tab-content">
                        <div class="tab-pane fade active in" id="Personal">
                            <h2 class="title-section">Ürün Ekleme</h2>
                            <div class="personal-info inner-page-padding">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Fotoğraf</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" required="" name="urunfoto_resimyol" id="urunfoto_resimyol" type="file">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Kategori</label>
                                    <div class="col-sm-9">
                                        <div class="custom-select">
                                            <select name="kategori_id" class='select2 form-control'>
                                                <?php
                                                $kategorisor = $db->prepare("SELECT * FROM kategori order by kategori_sira ASC");
                                                $kategorisor->execute();
                                                while ($kategoricek = $kategorisor->fetch(PDO::FETCH_ASSOC)) {
                                                ?>
                                                    <option id="kategori_id" value="<?php echo $kategoricek['kategori_id'] ?>"><?php echo $kategoricek['kategori_ad'] ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Adı</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" required="" name="urun_ad" id="urun_ad" placeholder="Ürün Adı..." type="text">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Açıklama</label>
                                    <div class="col-sm-9">
                                        <textarea class="ckeditor" id="urundetay" name="urundetay" placeholder="Ürün Açıklaması..."></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Fiyat</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="urun_fiyat" name="urun_fiyat" value="" placeholder="Ürün Fiyat..." oninput="this.value = this.value.replace(/[^\d,]/g, '');">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="text-right col-sm-12">
                                        <button class="update-btn" name="magazaurunekle" id="magazaurunekle-btn">Ürün Ekle</button>
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
</div>
<!-- Settings Page End Here -->
<script>
    var site_url = '<?= URL; ?>';
    CKEDITOR.replace('urundetay', {
        filebrowserBrowseUrl: 'ckfinder/ckfinder.html',
        filebrowserImageBrowseUrl: 'ckfinder/ckfinder.html?type=Images',
        filebrowserFlashBrowseUrl: 'ckfinder/ckfinder.html?type=Flash',
        filebrowserUploadUrl: 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
        filebrowserImageUploadUrl: 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
        filebrowserFlashUploadUrl: 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash',
        forcePasteAsPlainText: true
    });
    $(document).ready(function() {
        $("#magazaurunekle-btn").click(function(e) {
            e.preventDefault();
            let form_data = new FormData();
            let img = $("#urunfoto_resimyol")[0].files;
            form_data.append('magazaurunekle', 'magazaurunekle');
            form_data.append('kategori_id', $('#kategori_id').val());
            form_data.append('urun_ad', $('#urun_ad').val());
            form_data.append('urun_detay', CKEDITOR.instances.urundetay.getData());
            form_data.append('urun_fiyat', $('#urun_fiyat').val());
            form_data.append('urunfoto_resimyol', img[0]);
            $.ajax({
                type: 'POST',
                url: site_url + '/admin/netting/kullanici.php',
                data: form_data,
                dataType: 'json',
                contentType: false,
                cache: false,
                processData: false,
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
                    } else if (data.warning) {
                        Swal.fire({
                            title: "Kontrol Et",
                            text: data.warning,
                            icon: "warning",
                            position: "top-center",
                            timer: 2500,
                            showConfirmButton: false,
                        });
                    } else if (data.success) {
                        Swal.fire({
                            title: "İşlem OK",
                            text: data.success,
                            icon: "success",
                            position: "top-center",
                            timer: 2500,
                            showConfirmButton: false,
                        });
                        $("form").trigger('reset');
                        CKEDITOR.instances.urundetay.setData(''); //CKEditor deger/value sil/delete
                    }
                }
            });
        })
    });
</script>
<?php require_once 'footer.php'; ?>