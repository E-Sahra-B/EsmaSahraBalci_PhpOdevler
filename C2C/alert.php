<?php
if ($_GET['sil'] == "ok") { ?>
    <div class="alert alert-success"><strong>Bilgi!</strong> İşlem Başarılı</div>
<?php } elseif ($_GET['sil'] == "no") { ?>
    <div class="alert alert-danger"><strong>Bilgi!</strong> İşlem Başarısız</div>
<?php } elseif ($_GET['durum'] == "ok") { ?>
    <div class="alert alert-success"><strong>Bilgi!</strong> İşlem Başarılı</div>
<?php } elseif ($_GET['durum'] == "no") { ?>
    <div class="alert alert-danger"><strong>Bilgi!</strong> İşlem Başarısız</div>
<?php } elseif ($_GET['durum'] == "hata") { ?>
    <div class="alert alert-danger"><strong>Hata!</strong> İşlem Başarısız</div>
<?php } else if ($_GET['durum'] == "eskisifrehata") { ?>
    <div class="alert alert-danger"><strong>Bilgi!</strong> Eski Şifreniz Hatalı</div>
<?php } else if ($_GET['durum'] == "sifreleruyusmuyor") { ?>
    <div class="alert alert-danger"><strong>Bilgi!</strong> Şifreler Uyuşmuyor</div>
<?php } elseif ($_GET['durum'] == "farklisifre") { ?>
    <div class="alert alert-danger"><strong>Hata!</strong> Girdiğiniz şifreler eşleşmiyor.</div>
<?php } elseif ($_GET['durum'] == "eksiksifre") { ?>
    <div class="alert alert-danger"><strong>Hata!</strong> Şifreniz minimum 6 karakter uzunluğunda olmalıdır.</div>
<?php } elseif ($_GET['durum'] == "mukerrerkayit") { ?>
    <div class="alert alert-danger"> <strong>Hata!</strong> Bu kullanıcı daha önce kayıt edilmiş.</div>
<?php } elseif ($_GET['durum'] == "basarisiz") { ?>
    <div class="alert alert-danger"><strong>Hata!</strong> Kayıt Yapılamadı Sistem Yöneticisine Danışınız.</div>
<?php } ?>