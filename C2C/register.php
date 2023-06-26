<?php
require_once 'header.php';
$url = "http://" . $_SERVER["SERVER_NAME"] . dirname($_SERVER["PHP_SELF"]);
define("URL", $url);
?>
<!-- Registration Page Area Start Here -->
<div class="registration-page-area bg-secondary section-space-bottom">
    <div class="container">
        <h2 class="title-section">Üye Kayıt İşlemleri</h2>
        <div class="registration-details-area inner-page-padding">
            <?php require_once 'alert.php'; ?>
            <p id="result"></p>
            <form method="POST" id="register-form">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label class="control-label" for="first-name">Mail Adresiniz *</label>
                            <input type="text" id="kullanici_mail" required="" name="kullanici_mail" placeholder="Mail Adresinizi Giriniz (Kullanıcı Adınız Olacak!)" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <label class="control-label" for="first-name">Adınız *</label>
                            <input type="text" id="kullanici_ad" required="" placeholder="Adınızı Giriniz..." name="kullanici_ad" class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <label class="control-label" for="last-name">Soyadınız *</label>
                            <input type="text" id="kullanici_soyad" required="" placeholder="Soyadınızı Giriniz..." name="kullanici_soyad" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <label class="control-label" for="first-name">Şifreniz *</label>
                            <input type="password" id="kullanici_passwordone" required="" placeholder="Şifrenizi Giriniz.." name="kullanici_passwordone" class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <label class="control-label" for="last-name">Şifreniz Tekrar *</label>
                            <input type="password" id="kullanici_passwordtwo" required="" placeholder="Şifrenizi Tekrar Giriniz..." name="kullanici_passwordtwo" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="pLace-order">
                            <button class="update-btn disabled btn-block" type="submit" name="musterikaydet" id="register-btn">Kayıt</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    var site_url = '<?= URL; ?>';
    $(document).ready(function() {
        $('#register-btn').click(function(e) {

            e.preventDefault();
            // var kullanici_ad = $('#kullanici_ad').val();
            // var kullanici_soyad = $('#kullanici_soyad').val();
            // var kullanici_mail = $('#kullanici_mail').val();
            // var kullanici_passwordone = $('#kullanici_passwordone').val();
            // var kullanici_passwordtwo = $('#kullanici_passwordtwo').val();
            $.ajax({
                type: 'POST',
                url: site_url + '/admin/netting/kullanici.php',
                data: $("#register-form").serialize() + '&musterikaydet',
                // kullanici_ad: kullanici_ad,
                // kullanici_soyad: kullanici_soyad,
                // kullanici_mail: kullanici_mail,
                // kullanici_passwordone: kullanici_passwordone,
                // kullanici_passwordtwo: kullanici_passwordtwo

                dataType: 'json',
                success: function(data) {
                    console.log(data);
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
                        sonuc("success", data.success);
                        $("form").trigger('reset');
                    }
                }
            });
        })
    });

    function sonuc(result, message) {
        $("#result").html('<div class="alert alert-' + result + '">' + message + '</div>');
        $("#result").fadeTo(2000, 500).slideUp(500, function() {
            $("#result").slideUp(500);
        });
    };
</script>
<!-- Registration Page Area End Here -->
<?php require_once 'footer.php' ?>