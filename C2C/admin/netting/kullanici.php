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
