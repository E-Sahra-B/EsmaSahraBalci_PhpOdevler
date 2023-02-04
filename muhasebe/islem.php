<?php
ob_start();
session_start();
require_once 'baglan.php';
if (isset($_POST['masrafekle'])) {
    $kaydet = $baglan->prepare("INSERT into masraflar SET 
    masraf_baslik=:masraf_baslik,
    masraf_aciklama=:masraf_aciklama,
    masraf_tutar=:masraf_tutar,
    masraf_zaman=:masraf_zaman,
    masraf_kategori=:masraf_kategori
    ");
    $ekle = $kaydet->execute(array(
        'masraf_baslik' => $_POST['baslik'],
        'masraf_aciklama' => $_POST['aciklama'],
        'masraf_tutar' => $_POST['tutar'],
        'masraf_zaman' => $_POST['zaman'],
        'masraf_kategori' => $_POST['kategori']
    ));
    if ($ekle) {
        Header("Location:sayfa.php?sayfa=masraflar&durum=ok");
    } else {
        Header("Location:sayfa.php?sayfa=masraflar&durum=no");
    }
}

if (isset($_POST['masrafduzenle'])) {
    $id = $_POST['id'];
    $update = $baglan->prepare("UPDATE   masraflar SET 
    masraf_baslik=:masraf_baslik,
    masraf_aciklama=:masraf_aciklama,
    masraf_tutar=:masraf_tutar,
    masraf_zaman=:masraf_zaman,
    masraf_kategori=:masraf_kategori
    WHERE masraf_id=$id
    ");
    $duzenle = $update->execute(array(
        'masraf_baslik' => $_POST['baslik'],
        'masraf_aciklama' => $_POST['aciklama'],
        'masraf_tutar' => $_POST['tutar'],
        'masraf_zaman' => $_POST['zaman'],
        'masraf_kategori' => $_POST['kategori']
    ));
    if ($duzenle) {
        Header("Location:sayfa.php?sayfa=masraflar&durum=ok");
    } else {
        Header("Location:sayfa.php?sayfa=masraflar&durum=no");
    }
}

if (isset($_POST['masrafsil'])) {
    $delete = $baglan->prepare("DELETE from masraflar where masraf_id=:masraf_id ");
    $sil = $delete->execute(array(
        'masraf_id' => $_POST['id']
    ));
    if ($sil) {
        Header("Location:sayfa.php?sayfa=masraflar&durum=ok");
    } else {
        Header("Location:sayfa.php?sayfa=masraflar&durum=no");
    }
}

if (isset($_POST['odemeekle'])) {
    $kaydet = $baglan->prepare("INSERT into odemeler SET 
    odeme_baslik=:odeme_baslik,
    odeme_aciklama=:odeme_aciklama,
    odeme_kime=:odeme_kime,
    odeme_zaman=:odeme_zaman,
    odeme_tutar=:odeme_tutar,
    para_alinan_zaman=:para_alinan_zaman
    ");
    $ekle = $kaydet->execute(array(
        'odeme_baslik' => $_POST['baslik'],
        'odeme_aciklama' => $_POST['aciklama'],
        'odeme_kime' => $_POST['kime'],
        'odeme_zaman' => $_POST['zaman'],
        'odeme_tutar' => $_POST['tutar'],
        'para_alinan_zaman' => $_POST['alinanzaman']
    ));
    if ($ekle) {
        Header("Location:sayfa.php?sayfa=odemeler&durum=ok");
    } else {
        Header("Location:sayfa.php?sayfa=odemeler&durum=no");
    }
}

if (isset($_POST['odemeduzenle'])) {
    $id = $_POST['id'];
    $update = $baglan->prepare("UPDATE odemeler SET 
    odeme_baslik=:odeme_baslik,
    odeme_aciklama=:odeme_aciklama,
    odeme_kime=:odeme_kime,
    odeme_zaman=:odeme_zaman,
    odeme_tutar=:odeme_tutar,
    para_alinan_zaman=:para_alinan_zaman
    WHERE odeme_id=$id
    ");
    $duzenle = $update->execute(array(
        'odeme_baslik' => $_POST['baslik'],
        'odeme_aciklama' => $_POST['aciklama'],
        'odeme_kime' => $_POST['kime'],
        'odeme_zaman' => $_POST['zaman'],
        'odeme_tutar' => $_POST['tutar'],
        'para_alinan_zaman' => $_POST['alinanzaman']
    ));
    if ($duzenle) {
        Header("Location:sayfa.php?sayfa=odemeler&durum=ok");
    } else {
        Header("Location:sayfa.php?sayfa=odemeler&durum=no");
    }
}

if (isset($_POST['odemesil'])) {
    $delete = $baglan->prepare("DELETE from odemeler where odeme_id=:odeme_id ");
    $sil = $delete->execute(array(
        'odeme_id' => $_POST['id']
    ));
    if ($sil) {
        Header("Location:sayfa.php?sayfa=odemeler&durum=ok");
    } else {
        Header("Location:sayfa.php?sayfa=odemeler&durum=no");
    }
}

if (isset($_POST['calisanekle'])) {
    $kaydet = $baglan->prepare("INSERT into calisanlar SET 
    calisan_isim=:calisan_isim,
    calisan_bolum=:calisan_bolum,
    calisan_maas=:calisan_maas,
    ise_baslama_tarih=:ise_baslama_tarih,
    calisan_yas=:calisan_yas
    ");
    $ekle = $kaydet->execute(array(
        'calisan_isim' => $_POST['isim'],
        'calisan_bolum' => $_POST['bolum'],
        'calisan_maas' => $_POST['maas'],
        'ise_baslama_tarih' => $_POST['tarih'],
        'calisan_yas' => $_POST['yas']
    ));
    if ($ekle) {
        Header("Location:sayfa.php?sayfa=calisanlar&durum=ok");
    } else {
        Header("Location:sayfa.php?sayfa=calisanlar&durum=no");
    }
}

if (isset($_POST['calisanduzenle'])) {
    $id = $_POST['id'];
    $update = $baglan->prepare("UPDATE calisanlar SET 
    calisan_isim=:calisan_isim,
    calisan_bolum=:calisan_bolum,
    calisan_maas=:calisan_maas,
    ise_baslama_tarih=:ise_baslama_tarih,
    calisan_yas=:calisan_yas
    WHERE calisan_id=$id
    ");
    $duzenle = $update->execute(array(
        'calisan_isim' => $_POST['isim'],
        'calisan_bolum' => $_POST['bolum'],
        'calisan_maas' => $_POST['maas'],
        'ise_baslama_tarih' => $_POST['tarih'],
        'calisan_yas' => $_POST['yas']
    ));
    if ($duzenle) {
        Header("Location:sayfa.php?sayfa=calisanlar&durum=ok");
    } else {
        Header("Location:sayfa.php?sayfa=calisanlar&durum=no");
    }
}

if (isset($_POST['calisansil'])) {
    $delete = $baglan->prepare("DELETE from calisanlar where calisan_id=:calisan_id ");
    $sil = $delete->execute(array(
        'calisan_id' => $_POST['id']
    ));
    if ($sil) {
        Header("Location:sayfa.php?sayfa=calisanlar&durum=ok");
    } else {
        Header("Location:sayfa.php?sayfa=calisanlar&durum=no");
    }
}

if (isset($_POST['alacakekle'])) {
    $kaydet = $baglan->prepare("INSERT into alacaklar SET 
    alacak_isim=:alacak_isim,
    alacak_aciklama=:alacak_aciklama,
    alacak_zaman=:alacak_zaman,
    alacak_tutar=:alacak_tutar
    ");
    $ekle = $kaydet->execute(array(
        'alacak_isim' => $_POST['isim'],
        'alacak_aciklama' => $_POST['aciklama'],
        'alacak_zaman' => $_POST['tarih'],
        'alacak_tutar' => $_POST['tutar']
    ));
    if ($ekle) {
        Header("Location:sayfa.php?sayfa=alacaklar&durum=ok");
    } else {
        Header("Location:sayfa.php?sayfa=alacaklar&durum=no");
    }
}

if (isset($_POST['alacakduzenle'])) {
    $id = $_POST['id'];
    $update = $baglan->prepare("UPDATE alacaklar SET 
    alacak_isim=:alacak_isim,
    alacak_aciklama=:alacak_aciklama,
    alacak_zaman=:alacak_zaman,
    alacak_tutar=:alacak_tutar
    WHERE alacak_id=$id
    ");
    $duzenle = $update->execute(array(
        'alacak_isim' => $_POST['isim'],
        'alacak_aciklama' => $_POST['aciklama'],
        'alacak_zaman' => $_POST['tarih'],
        'alacak_tutar' => $_POST['tutar']
    ));
    if ($duzenle) {
        Header("Location:sayfa.php?sayfa=alacaklar&durum=ok");
    } else {
        Header("Location:sayfa.php?sayfa=alacaklar&durum=no");
    }
}

if (isset($_POST['alacaksil'])) {
    $delete = $baglan->prepare("DELETE from alacaklar where alacak_id=:alacak_id ");
    $sil = $delete->execute(array(
        'alacak_id' => $_POST['id']
    ));
    if ($sil) {
        Header("Location:sayfa.php?sayfa=alacaklar&durum=ok");
    } else {
        Header("Location:sayfa.php?sayfa=alacaklar&durum=no");
    }
}

if (isset($_POST['satisekle'])) {
    $kaydet = $baglan->prepare("INSERT into satislar SET 
    satis_baslik=:satis_baslik,
    satis_aciklama=:satis_aciklama,
    satis_zaman=:satis_zaman,
    satis_tutar=:satis_tutar,
    satis_odeme=:satis_odeme
    ");
    $ekle = $kaydet->execute(array(
        'satis_baslik' => $_POST['isim'],
        'satis_aciklama' => $_POST['aciklama'],
        'satis_zaman' => $_POST['tarih'],
        'satis_tutar' => $_POST['tutar'],
        'satis_odeme' => $_POST['odeme']
    ));
    if ($ekle) {
        Header("Location:sayfa.php?sayfa=satislar&durum=ok");
    } else {
        Header("Location:sayfa.php?sayfa=satislar&durum=no");
    }
}

if (isset($_POST['satisduzenle'])) {
    $id = $_POST['id'];
    $update = $baglan->prepare("UPDATE satislar SET 
    satis_baslik=:satis_baslik,
    satis_aciklama=:satis_aciklama,
    satis_zaman=:satis_zaman,
    satis_tutar=:satis_tutar,
    satis_odeme=:satis_odeme
    WHERE satis_id=$id
    ");
    $duzenle = $update->execute(array(
        'satis_baslik' => $_POST['isim'],
        'satis_aciklama' => $_POST['aciklama'],
        'satis_zaman' => $_POST['tarih'],
        'satis_tutar' => $_POST['tutar'],
        'satis_odeme' => $_POST['odeme']
    ));
    if ($duzenle) {
        Header("Location:sayfa.php?sayfa=satislar&durum=ok");
    } else {
        Header("Location:sayfa.php?sayfa=satislar&durum=no");
    }
}

if (isset($_POST['satisil'])) {
    $delete = $baglan->prepare("DELETE from satislar where satis_id=:satis_id ");
    $sil = $delete->execute(array(
        'satis_id' => $_POST['id']
    ));
    if ($sil) {
        Header("Location:sayfa.php?sayfa=satislar&durum=ok");
    } else {
        Header("Location:sayfa.php?sayfa=satislar&durum=no");
    }
}

if (isset($_POST['nakit'])) {
    if ($_POST['sec'] == "1") {
        $kaydet = $baglan->prepare("INSERT into nakit SET 
    para_baslik=:para_baslik,
    para_aciklama=:para_aciklama,
    para_gelen=:para_gelen,
    para_zaman=:para_zaman
    ");
        $ekle = $kaydet->execute(array(
            'para_baslik' => $_POST['baslik'],
            'para_aciklama' => $_POST['aciklama'],
            'para_gelen' => $_POST['tutar'],
            'para_zaman' => $_POST['zaman']
        ));
    } elseif ($_POST['sec'] == "2") {
        $kaydet = $baglan->prepare("INSERT into nakit SET 
    para_baslik=:para_baslik,
    para_aciklama=:para_aciklama,
    para_giden=:para_giden,
    para_zaman=:para_zaman
    ");
        $ekle = $kaydet->execute(array(
            'para_baslik' => $_POST['baslik'],
            'para_aciklama' => $_POST['aciklama'],
            'para_giden' => $_POST['tutar'],
            'para_zaman' => $_POST['zaman']
        ));
    }
    if ($ekle) {
        Header("Location:nakit.php?durum=ok");
    } else {
        Header("Location:nakit.php?durum=no");
    }
}

if (isset($_POST['nakitsil'])) {
    $delete = $baglan->prepare("DELETE from nakit where nakit_id=:nakit_id ");
    $sil = $delete->execute(array(
        'nakit_id' => $_POST['id']
    ));
    if ($sil) {
        Header("Location:nakit.php?durum=ok");
    } else {
        Header("Location:nakit.php?durum=no");
    }
}

if (isset($_POST['kullanicikaydet'])) {
    $email = htmlspecialchars($_POST['email']);
    $sifre = htmlspecialchars($_POST['sifre']);
    $firma = htmlspecialchars($_POST['firmaismi']);
    $yetkili = htmlspecialchars($_POST['yetkili']);
    $sifreguclu = md5($sifre);
    $kullanicisor = $baglan->prepare("SELECT * from kullanici where kullanici_email=:kullanici_email");
    $kullanicisor->execute(array('kullanici_email' => $email));
    $kvarmi = $kullanicisor->rowCount();
    if ($kvarmi == "1") {
        Header("Location:kayit.php?durum=kvar");
    } else {
        $kaydet = $baglan->prepare("INSERT into kullanici SET 
        kullanici_email=:kullanici_email,
        kullanici_sifre=:kullanici_sifre,
        firma_ismi=:firma_ismi,
        yetkili=:yetkili
        ");
        $ekle = $kaydet->execute(array(
            'kullanici_email' => $email,
            'kullanici_sifre' => $sifreguclu,
            'firma_ismi' => $firma,
            'yetkili' => $yetkili
        ));
        if ($ekle) {
            Header("Location:giris.php?durum=basarili");
        } else {
            Header("Location:kayit.php?durum=no");
        }
    }
}

if (isset($_POST['girisyap'])) {
    $email = htmlspecialchars($_POST['email']);
    $sifre = htmlspecialchars($_POST['sifre']);
    $sifreguclu = md5($sifre);
    $kullanicisor = $baglan->prepare("SELECT * from kullanici where kullanici_email=:kullanici_email and kullanici_sifre=:kullanici_sifre");
    $kullanicisor->execute(array(
        'kullanici_email' => $email,
        'kullanici_sifre' => $sifreguclu
    ));
    $kvarmi = $kullanicisor->rowCount();
    if ($kvarmi > 0) {
        $_SESSION['girisbelgesi'] = $email;
        Header("Location:index.php?durum=basarili");
    } else {
        Header("Location:giris.php?durum=hata");
    }
}
