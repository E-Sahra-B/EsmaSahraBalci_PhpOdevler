<?php require_once 'header.php' ?>
<!-- Registration Page Area Start Here -->
<div class="registration-page-area bg-secondary section-space-bottom">
    <div class="container">
        <h2 class="title-section">Üye Giriş İşlemleri</h2>
        <div class="registration-details-area inner-page-padding">
            <?php require_once 'alert.php'; ?>
            <form action="admin/netting/kullanici.php" method="POST" id="personal-info-form">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <label class="control-label" for="first-name">Mail Adresiniz *</label>
                            <input type="text" id="first-name" required="" placeholder="Mail Adresinizi Giriniz.." name="kullanici_mail" class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <img id="captcha" src="securimage/securimage_show.php" alt="CAPTCHA Image" />
                            <a class="btn btn-info btn-xs" href="#" onclick="document.getElementById('captcha').src = 'securimage/securimage_show.php?' + Math.random(); return false">[ Değiştir ]</a>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <label class="control-label" for="last-name">Şifreniz Tekrar *</label>
                            <input type="password" id="last-name" required="" placeholder="Şifrenizi Tekrar Giriniz..." name="kullanici_password" class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <label class="control-label" for="last-name">Güvenlik Kodunu Giriniz *</label>
                            <input type="text" id="last-name" required="" placeholder="Güvenlik Kodunu Giriniz" name="captcha_code" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                        <div class="pLace-order">
                            <button class="apply-now-btn-color btn-block disabled" data-toggle="modal" data-target="#sifremiunuttum" type="submit" name="musterigiris">Şifremi Unuttum</button>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                        <div class="pLace-order">
                            <button class="apply-now-btn btn-block disabled" type="submit" name="musterigiris">Giriş</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal Başlangıç -->
<div class="modal fade" id="sifremiunuttum" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel">Şifre Sıfırlama</h4>
            </div>
            <div class="modal-body">
                <form action="mailphp/sifremi-unuttum.php" method="POST">
                    <div class="form-group">
                        <p><strong>Uyarı:</strong> Girdiğiniz mail adresi kayıtlarımızda varsa şifreniz mail adresinize gönderilecektir.</p>
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Mail Adresiniz:</label>
                        <input type="email" class="form-control" name="kullanici_mail" id="recipient-name">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>
                <button type="submit" name="sifremiunuttum" class="btn btn-primary">Şifre Talep Et</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal Bitiş -->
<!-- Registration Page Area End Here -->
<?php require_once 'footer.php' ?>