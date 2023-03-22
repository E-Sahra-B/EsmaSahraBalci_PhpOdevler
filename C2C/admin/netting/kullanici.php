<?php
ob_start();
session_start();
require_once 'baglan.php';
include '../production/fonksiyon.php';

if (isset($_POST['musterikaydet'])) {
    $kullanici_mail = htmlspecialchars(trim($_POST['kullanici_mail']));
    $kullanici_passwordone = htmlspecialchars(trim($_POST['kullanici_passwordone']));
    $kullanici_passwordtwo = htmlspecialchars(trim($_POST['kullanici_passwordtwo']));
    if ($kullanici_passwordone == $kullanici_passwordtwo) {
        if (strlen($kullanici_passwordone) >= 6) {
            $kullanicisor = $db->prepare("select * from kullanici where kullanici_mail=:mail");
            $kullanicisor->execute(array(
                'mail' => $kullanici_mail
            ));
            $say = $kullanicisor->rowCount();
            if ($say == 0) {
                $password = sha1(md5($kullanici_passwordone));
                $kullanici_yetki = 1;
                $kullanicikaydet = $db->prepare("INSERT INTO kullanici SET
					kullanici_ad=:kullanici_ad,
					kullanici_soyad=:kullanici_soyad,
					kullanici_mail=:kullanici_mail,
					kullanici_password=:kullanici_password,
					kullanici_yetki=:kullanici_yetki
					");
                $insert = $kullanicikaydet->execute(array(
                    'kullanici_ad' => htmlspecialchars($_POST['kullanici_ad']),
                    'kullanici_soyad' => htmlspecialchars($_POST['kullanici_soyad']),
                    'kullanici_mail' => $kullanici_mail,
                    'kullanici_password' => $password,
                    'kullanici_yetki' => $kullanici_yetki
                ));
                if ($insert) {
                    header("Location:../../login?durum=kayitok");
                } else {
                    header("Location:../../register?durum=basarisiz");
                }
            } else {
                header("Location:../../register?durum=mukerrerkayit");
            }
        } else {
            header("Location:../../register.php?durum=eksiksifre");
        }
    } else {
        header("Location:../../register.php?durum=farklisifre");
    }
}

if (isset($_POST['musterigiris'])) {
    $kullanici_mail = htmlspecialchars($_POST['kullanici_mail']);
    $kullanici_password = sha1(md5(htmlspecialchars($_POST['kullanici_password'])));
    $kullanicisor = $db->prepare("select * from kullanici where kullanici_mail=:mail and kullanici_yetki=:yetki and kullanici_password=:password and kullanici_durum=:durum");
    $kullanicisor->execute(array(
        'mail' => $kullanici_mail,
        'yetki' => 1,
        'password' => $kullanici_password,
        'durum' => 1
    ));
    $say = $kullanicisor->rowCount();
    if ($say == 1) {
        $_SESSION['userkullanici_mail'] = $kullanici_mail;
        header("Location:../../index.php?durum=girisbasarili");
    } else {
        header("Location:../../login?durum=hata");
    }
}

if (isset($_POST['musteribilgiguncelle'])) {
    $kullaniciguncelle = $db->prepare("UPDATE kullanici SET
		kullanici_ad=:kullanici_ad,
		kullanici_soyad=:kullanici_soyad,
		kullanici_gsm=:kullanici_gsm
		WHERE kullanici_id={$_SESSION['userkullanici_id']}");
    $update = $kullaniciguncelle->execute(array(
        'kullanici_ad' => htmlspecialchars($_POST['kullanici_ad']),
        'kullanici_soyad' => htmlspecialchars($_POST['kullanici_soyad']),
        'kullanici_gsm' => htmlspecialchars($_POST['kullanici_gsm'])
    ));
    if ($update) {
        Header("Location:../../hesabim?durum=ok");
    } else {
        Header("Location:../../hesabim?durum=hata");
    }
}

if (isset($_POST['musteriadresguncelle'])) {
    $kullaniciguncelle = $db->prepare("UPDATE kullanici SET
		kullanici_tip=:kullanici_tip,
		kullanici_tc=:kullanici_tc,
		kullanici_unvan=:kullanici_unvan,
		kullanici_vdaire=:kullanici_vdaire,
		kullanici_vno=:kullanici_vno,
		kullanici_adres=:kullanici_adres,
		kullanici_il=:kullanici_il,
		kullanici_ilce=:kullanici_ilce
		WHERE kullanici_id={$_SESSION['userkullanici_id']}");
    $update = $kullaniciguncelle->execute(array(
        'kullanici_tip' => htmlspecialchars($_POST['kullanici_tip']),
        'kullanici_tc' => htmlspecialchars($_POST['kullanici_tc']),
        'kullanici_unvan' => htmlspecialchars($_POST['kullanici_unvan']),
        'kullanici_vdaire' => htmlspecialchars($_POST['kullanici_vdaire']),
        'kullanici_vno' => htmlspecialchars($_POST['kullanici_vno']),
        'kullanici_adres' => htmlspecialchars($_POST['kullanici_adres']),
        'kullanici_il' => htmlspecialchars($_POST['kullanici_il']),
        'kullanici_ilce' => htmlspecialchars($_POST['kullanici_ilce'])
    ));
    if ($update) {
        Header("Location:../../adres-bilgileri?durum=ok");
    } else {
        Header("Location:../../adres-bilgileri?durum=hata");
    }
}

if (isset($_POST['musterisifreguncelle'])) {
    $kullanici_eskipassword = htmlspecialchars($_POST['kullanici_eskipassword']);
    $kullanici_passwordone = htmlspecialchars($_POST['kullanici_passwordone']);
    $kullanici_passwordtwo = htmlspecialchars($_POST['kullanici_passwordtwo']);
    $kullanici_password = sha1(md5($kullanici_eskipassword));
    $kullanicisor = $db->prepare("SELECT * from kullanici where kullanici_password=:password");
    $kullanicisor->execute(array(
        'password' => $kullanici_password
    ));
    $say = $kullanicisor->rowCount();
    if ($say == 0) {
        Header("Location:../../sifre-guncelle?durum=eskisifrehata");
        exit;
    }
    if ($kullanici_passwordone == $kullanici_passwordtwo) {
        if (strlen($kullanici_passwordone) >= 6) {
            $sifre = sha1(md5($kullanici_passwordone));
            $kullaniciguncelle = $db->prepare("UPDATE kullanici SET
				kullanici_password=:kullanici_password
				WHERE kullanici_id={$_SESSION['userkullanici_id']}");
            $update = $kullaniciguncelle->execute(array(
                'kullanici_password' => $sifre
            ));
            if ($update) {
                Header("Location:../../sifre-guncelle?durum=ok");
            } else {
                Header("Location:../../sifre-guncelle?durum=hata");
            }
        } else {
            Header("Location:../../sifre-guncelle?durum=eksiksifre");
            exit;
        }
    } else {
        Header("Location:../../sifre-guncelle?durum=sifreleruyusmuyor");
        exit;
    }
}

if (isset($_POST['musterimagazabasvuru'])) {
    $kullaniciguncelle = $db->prepare("UPDATE kullanici SET
		kullanici_ad=:kullanici_ad,
		kullanici_soyad=:kullanici_soyad,
		kullanici_gsm=:kullanici_gsm,
		kullanici_banka=:kullanici_banka,
		kullanici_iban=:kullanici_iban,
		kullanici_tip=:kullanici_tip,
		kullanici_tc=:kullanici_tc,
		kullanici_unvan=:kullanici_unvan,
		kullanici_vdaire=:kullanici_vdaire,
		kullanici_vno=:kullanici_vno,
		kullanici_adres=:kullanici_adres,
		kullanici_il=:kullanici_il,
		kullanici_ilce=:kullanici_ilce,
		kullanici_magaza=:kullanici_magaza
		WHERE kullanici_id={$_SESSION['userkullanici_id']}");
    $update = $kullaniciguncelle->execute(array(
        'kullanici_ad' => htmlspecialchars($_POST['kullanici_ad']),
        'kullanici_soyad' => htmlspecialchars($_POST['kullanici_soyad']),
        'kullanici_gsm' => htmlspecialchars($_POST['kullanici_gsm']),
        'kullanici_banka' => htmlspecialchars($_POST['kullanici_banka']),
        'kullanici_iban' => htmlspecialchars($_POST['kullanici_iban']),
        'kullanici_tip' => htmlspecialchars($_POST['kullanici_tip']),
        'kullanici_tc' => htmlspecialchars($_POST['kullanici_tc']),
        'kullanici_unvan' => htmlspecialchars($_POST['kullanici_unvan']),
        'kullanici_vdaire' => htmlspecialchars($_POST['kullanici_vdaire']),
        'kullanici_vno' => htmlspecialchars($_POST['kullanici_vno']),
        'kullanici_adres' => htmlspecialchars($_POST['kullanici_adres']),
        'kullanici_il' => htmlspecialchars($_POST['kullanici_il']),
        'kullanici_ilce' => htmlspecialchars($_POST['kullanici_ilce']),
        'kullanici_magaza' => 1
    ));
    if ($update) {
        Header("Location:../../magaza-basvuru");
    } else {
        Header("Location:../../magaza-basvuru?durum=hata");
    }
}

if (isset($_POST['sipariskaydet'])) {
    $kaydet = $db->prepare("INSERT INTO siparis SET
		kullanici_id=:id,
		kullanici_idsatici=:idsatici
		");
    $insert = $kaydet->execute(array(
        'id' => htmlspecialchars($_SESSION['userkullanici_id']),
        'idsatici' => htmlspecialchars($_POST['kullanici_idsatici'])
    ));
    if ($insert) {
        $siparis_id = $db->lastInsertId();
        $sipariskaydet = $db->prepare("INSERT INTO siparis_detay SET
			siparis_id=:siparis_id,
			kullanici_id=:id,
			kullanici_idsatici=:idsatici,
			urun_id=:urun_id,
			urun_fiyat=:urun_fiyat
			");
        $insertkaydet = $sipariskaydet->execute(array(
            'siparis_id' => $siparis_id,
            'id' => htmlspecialchars($_SESSION['userkullanici_id']),
            'idsatici' => htmlspecialchars($_POST['kullanici_idsatici']),
            'urun_id' => htmlspecialchars($_POST['urun_id']),
            'urun_fiyat' => htmlspecialchars($_POST['urun_fiyat'])
        ));
        if ($insertkaydet) {
            Header("Location:../../siparislerim.php");
        }
    } else {
        Header("Location:../../404.php");
    }
}

if (isset($_GET['urunonay']) == "ok") {
    $siparis_id = $_GET['siparis_id'];
    date_default_timezone_set('Europe/Istanbul');
    $tarih = date('Y-m-d H:i:s');
    $siparis_detayguncelle = $db->prepare("UPDATE siparis_detay SET
		siparisdetay_onay=:siparisdetay_onay,
        siparisdetay_onayzaman=:zaman
		WHERE siparisdetay_id={$_GET['siparisdetay_id']}");
    $update = $siparis_detayguncelle->execute(array(
        'siparisdetay_onay' => 2,
        'zaman' => $tarih
    ));
    if ($update) {
        Header("Location:../../siparis-detay.php?siparis_id=$siparis_id");
    } else {
        Header("Location:../../404.php");
    }
}

if (isset($_GET['urunteslim']) == "ok") {
    $siparis_id = $_GET['siparis_id'];
    $siparis_detayguncelle = $db->prepare("UPDATE siparis_detay SET
		siparisdetay_onay=:siparisdetay_onay
		WHERE siparisdetay_id={$_GET['siparisdetay_id']}");
    $update = $siparis_detayguncelle->execute(array(
        'siparisdetay_onay' => 1
    ));
    if ($update) {
        Header("Location:../../yeni-siparisler.php?siparis_id=$siparis_id");
    } else {
        Header("Location:../../404.php");
    }
}

if (isset($_POST['puanyorumekle'])) {
    $kaydet = $db->prepare("INSERT INTO yorumlar SET
		yorum_puan=:yorum_puan,
		urun_id=:urun_id,
		yorum_detay=:yorum_detay,
		kullanici_id=:kullanici_id
		");
    $insert = $kaydet->execute(array(
        'yorum_puan' => htmlspecialchars($_POST['yorum_puan']),
        'urun_id' => htmlspecialchars($_POST['urun_id']),
        'yorum_detay' => htmlspecialchars($_POST['yorum_detay']),
        'kullanici_id' => $_SESSION['userkullanici_id']
    ));
    $siparis_id = $_POST['siparis_id'];
    if ($insert) {
        $siparis_detayguncelle = $db->prepare("UPDATE siparis_detay SET
			siparisdetay_yorum=:siparisdetay_yorum
			WHERE siparis_id={$_POST['siparis_id']}");
        $update = $siparis_detayguncelle->execute(array(
            'siparisdetay_yorum' => 1
        ));
        Header("Location:../../siparis-detay?siparis_id=$siparis_id");
    } else {
        Header("Location:../../siparis-detay?siparis_id=$siparis_id");
    }
}

if (isset($_POST['mesajgonder'])) {
    $kullanici_gel = $_POST['kullanici_gel'];
    $kaydet = $db->prepare("INSERT INTO mesaj SET
		mesaj_detay=:mesaj_detay,
		kullanici_gel=:kullanici_gel,
		kullanici_gon=:kullanici_gon
		");
    $insert = $kaydet->execute(array(
        'mesaj_detay' => $_POST['mesaj_detay'],
        'kullanici_gel' => htmlspecialchars($_POST['kullanici_gel']),
        'kullanici_gon' => htmlspecialchars($_SESSION['userkullanici_id'])
    ));
    if ($insert) {
        Header("Location:../../mesaj-gonder?durum=mesajtamam&kullanici_gel=$kullanici_gel");
    } else {
        Header("Location:../../mesaj-gonder?durum=mesajhata&kullanici_gel=$kullanici_gel");
    }
}

if (isset($_POST['mesajcevapver'])) {
    $kullanici_gel = $_POST['kullanici_gel'];
    $kaydet = $db->prepare("INSERT INTO mesaj SET
		mesaj_detay=:mesaj_detay,
		kullanici_gel=:kullanici_gel,
		kullanici_gon=:kullanici_gon
		");
    $insert = $kaydet->execute(array(
        'mesaj_detay' => $_POST['mesaj_detay'],
        'kullanici_gel' => htmlspecialchars($_POST['kullanici_gel']),
        'kullanici_gon' => htmlspecialchars($_SESSION['userkullanici_id'])
    ));
    if ($insert) {
        Header("Location:../../gelen-mesajlar?durum=mesajtamam");
    } else {
        Header("Location:../../gelen-mesajlar?durum=mesajhata");
    }
}

if (isset($_GET['gidenmesajsil']) == "ok") {
    $sil = $db->prepare("DELETE from mesaj where mesaj_id=:mesaj_id");
    $kontrol = $sil->execute(array(
        'mesaj_id' => $_GET['mesaj_id']
    ));
    if ($kontrol) {
        Header("Location:../../giden-mesajlar.php?durum=siltamam");
    } else {
        Header("Location:../../giden-mesajlar.php?durum=silhata");
    }
}

if (isset($_GET['gelenmesajsil']) == "ok") {
    $sil = $db->prepare("DELETE from mesaj where mesaj_id=:mesaj_id");
    $kontrol = $sil->execute(array(
        'mesaj_id' => $_GET['mesaj_id']
    ));
    if ($kontrol) {
        Header("Location:../../gelen-mesajlar.php?durum=siltamam");
    } else {
        Header("Location:../../gelen-mesajlar.php?durum=silhata");
    }
}
