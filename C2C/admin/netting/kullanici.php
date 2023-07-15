<?php
ob_start();
session_start();
date_default_timezone_set('Europe/Istanbul');
require_once 'baglan.php';
include '../production/fonksiyon.php';

require_once 'auth.php';
$user = new Auth();
$msg = [];
if (isset($_POST['musterikaydet'])) {
    $kullanici_mail = $user->guvenlik($_POST['kullanici_mail']);
    $kullanici_passwordone = $user->guvenlik($_POST['kullanici_passwordone']);
    $kullanici_passwordtwo = $user->guvenlik($_POST['kullanici_passwordtwo']);
    if ($kullanici_passwordone == $kullanici_passwordtwo) {
        if (strlen($kullanici_passwordone) >= 6) {
            // $kullanicisor = $db->prepare("select * from kullanici where kullanici_mail=:mail");
            // $kullanicisor->execute(array(
            //     'mail' => $kullanici_mail
            // ));
            // $say = $kullanicisor->rowCount();
            //if ($say == 0) {
            if (!$user->user_exist($kullanici_mail)) {
                $password = password_hash($kullanici_passwordone, PASSWORD_DEFAULT);
                $kullanici_yetki = 1;
                $name = $user->guvenlik($_POST['kullanici_ad']);
                $sname = $user->guvenlik($_POST['kullanici_soyad']);
                // $kullanicikaydet = $db->prepare("INSERT INTO kullanici SET
                // 	kullanici_ad=:kullanici_ad,
                // 	kullanici_soyad=:kullanici_soyad,
                // 	kullanici_mail=:kullanici_mail,
                // 	kullanici_password=:kullanici_password,
                // 	kullanici_yetki=:kullanici_yetki
                // 	");
                // $insert = $kullanicikaydet->execute(array(
                //     'kullanici_ad' => htmlspecialchars($_POST['kullanici_ad']),
                //     'kullanici_soyad' => htmlspecialchars($_POST['kullanici_soyad']),
                //     'kullanici_mail' => $kullanici_mail,
                //     'kullanici_password' => $password,
                //     'kullanici_yetki' => $kullanici_yetki
                // ));
                if ($user->register($name, $sname, $kullanici_mail, $password, $kullanici_yetki)) {
                    $msg["success"] = "kayitok";
                } else {
                    $msg["danger"] = "basarisiz";
                }
            } else {
                $msg["danger"] = "mukerrerkayit";
            }
        } else {
            $msg["danger"] = "eksiksifre";
        }
    } else {
        $msg["danger"] = "farklisifre";
    }
    echo json_encode($msg);
}

if (isset($_POST['musterigiris'])) {
    require_once '../../securimage/securimage.php';
    $securimage = new Securimage();
    if ($securimage->check($_POST['captcha_code']) == false) {
        $msg["danger"] = "captchahata";
    }
    $kullanici_mail = $user->guvenlik($_POST['kullanici_mail']);
    $kullanici_password = $user->guvenlik($_POST['kullanici_password']);
    $loggedInUser = $user->login($kullanici_mail);
    if ($loggedInUser != null) {
        if (password_verify($kullanici_password, $loggedInUser['kullanici_password'])) {
            $user->userTimeUpdate($kullanici_mail);
            $_SESSION['userkullanici_sonzaman'] = strtotime(date("Y-m-d H:i:s"));
            $_SESSION['userkullanici_mail'] = $kullanici_mail;
            $msg["success"] = "girisbasarili";
        } else {
            $msg["danger"] = "hatalikullanimail";
        }
    } else {
        $msg["danger"] = "hatalikullanimail";
    }

    echo json_encode($msg);
}
if (isset($_POST['magazaurunekle'])) {
    if ($_FILES['urunfoto_resimyol']['size'] > 1048576) {
        $msg["warning"] = "Bu dosya boyutu çok büyük";
    } else {
        $izinli_uzantilar = array('jpg', 'png', 'gif', 'jpeg', 'webp', 'PNG', 'JPG', 'JPEG', 'WEBP');
        $ext = pathinfo($_FILES['urunfoto_resimyol']["name"], PATHINFO_EXTENSION);
        if (in_array($ext, $izinli_uzantilar) === false) {
            $msg["warning"] = "Bu uzantı kabul edilmiyor";
        } else {
            $urunfoto_resimyol = $user->upload_file($_FILES['urunfoto_resimyol']);

            $kategori_id = $user->guvenlik($_POST['kategori_id']);
            $kullanici_id = $user->guvenlik($_SESSION['userkullanici_id']);
            $urun_ad = $user->guvenlik($_POST['urun_ad']);
            $urun_detay = $_POST['urun_detay'];
            $urun_fiyat = $user->guvenlik($_POST['urun_fiyat']);
            if ($user->addProduct($kategori_id, $kullanici_id, $urun_ad, $urun_detay, $urun_fiyat, $urunfoto_resimyol)) {
                $msg["success"] = "Urun Ekleme Islemi Tamamlandi";
            } else {
                $msg["danger"] = "Urun Yuklenemedi";
            }
        }
    }
    echo json_encode($msg);
}
if (isset($_POST['musterigirisEski'])) {
    require_once '../../securimage/securimage.php';
    $securimage = new Securimage();
    if ($securimage->check($_POST['captcha_code']) == false) {
        header("Location:../../login?durum=captchahata");
        exit;
    }
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
        $kullanici_ip = $_SERVER['REMOTE_ADDR']; //IP adresi ogrenme
        //$zamanguncelle = $db->prepare("UPDATE kullanici SET kullanici_sonzaman=:kullanici_sonzaman,kullanici_sonip=:kullanici_sonip WHERE kullanici_mail='$kullanici_mail'");
        $zamanguncelle = $db->prepare("UPDATE kullanici SET kullanici_sonzaman=:kullanici_sonzaman WHERE kullanici_mail='$kullanici_mail'");
        $update = $zamanguncelle->execute(array(
            'kullanici_sonzaman' => date("Y-m-d H:i:s")
            // 'kullanici_sonip' => $kullanici_ip
        ));
        $_SESSION['userkullanici_sonzaman'] = strtotime(date("Y-m-d H:i:s"));
        $_SESSION['userkullanici_mail'] = $kullanici_mail;
        header("Location:../../index.php?durum=girisbasarili");
        exit;
    } else {
        header("Location:../../login?durum=hata");
        exit;
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

if (isset($_GET['urunteslimEski']) == "ok") {
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

if (isset($_POST['mesajgonderEski'])) {
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

if (isset($_POST['mesajsil'])) {
    if ($user->messageDelete($user->guvenlik('mesaj'), $user->guvenlik($_POST['mesajsil']))) {
        $msg["success"] = "Mesaj Silme islemi Tamamlandi";
    } else {
        $msg["danger"] = "Mesaj Silme islemi Tamamlanamadi";
    }
    echo json_encode($msg);
}

if (isset($_POST['urunsil'])) {
    if ($user->productDelete($user->guvenlik('urun'), $user->guvenlik($_POST['urunsil']))) {
        $resimsilunlink = $_POST['resimyol'];
        unlink("../../$resimsilunlink");
        $msg["success"] = "Ürün Silme islemi Tamamlandi";
    } else {
        $msg["danger"] = "Ürün Silme islemi Tamamlanamadi";
    }
    echo json_encode($msg);
}

if (isset($_POST['SendUser'])) {
    $data = $user->OtherUser($user->guvenlik($_SESSION['userkullanici_id']));
    $output = '';
    if ($data) {
        $output .= '<option>Kullanıcı Seciniz...</option>';
        foreach ($data as $row) {
            $output .= '<option value="' . $row['kullanici_id'] . '">' . $row['kullanici_ad'] . ' ' . $row['kullanici_soyad'] . '</option>';
        }
    }
    echo $output;
}

if (isset($_POST['mesajgonder'])) {
    if ($user->addMessage(($_POST['mesaj_detay']), $user->guvenlik($_POST['kullanici_gel']), $user->guvenlik($_SESSION['userkullanici_id']))) {
        $msg["success"] = "Mesaj Gonderme islemi Tamamlandi";
    } else {
        $msg["danger"] = "Mesaj Gonderme islemi Tamamlanamadi";
    }
    echo json_encode($msg);
}

if (isset($_POST['action']) && $_POST['action'] == 'getAllMessage') {
    $output = '';
    $data = $user->getAllMessageByUser($user->guvenlik($_SESSION['userkullanici_id']));
    if ($data) {
        $output .= '<table class="table table-striped listTable">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Mesaj Tarihi</th>
                <th scope="col">Gönderilen Kullanıcı</th>
                <th scope="col">İçerik</th>
                <th scope="col">Durum</th>
                <th scope="col">Detay</th>
                <th scope="col">Sil</th>
            </tr>
        </thead>
        <tbody>';
        $say = 0;
        foreach ($data as $mesajcek) {
            $say++;
            $output .= ' 
            <tr>
                <th scope="row">' . $say . '</th>
                <td>' . tarih($mesajcek['mesaj_zaman']) . '</td>
                <td><a href="satici-' . $mesajcek['kullanici_ad'] . '-' . $mesajcek['kullanici_soyad'] . '-' . $mesajcek['kullanici_gel'] . '">' . $mesajcek['kullanici_ad'] . " " . $mesajcek['kullanici_soyad'] . '</a></td>
                <td>' . htmlspecialchars_decode(kisalt($mesajcek['mesaj_detay'], 0, 15)) . '</td><td>';
            // <td><a href="mesaj-detay?gidenmesaj=ok&mesaj_id=' . $mesajcek['mesaj_id'] . '&kullanici_gon=' . $mesajcek['kullanici_gon'] . '"><button class="btn btn-primary btn-sm">Mesajı Oku</button></a></td>
            if ($mesajcek['mesaj_okunma'] == 1) {
                $output .= ' <i style="color:green" class="fa fa-check-circle" aria-hidden="true">';
            } else {
                $output .= ' <i style="color:gray" class="fa fa-check-circle-o" aria-hidden="true">';
            }
            $output .= '</td><td><a href="#" id="' . $mesajcek['mesaj_id'] . '" class="detailBtn"><button class="btn btn-primary btn-sm"  data-toggle="modal" data-target="#detailMessage">Mesajı Oku</button></a></td>
                
                <td><a href="#" id="' . $mesajcek['mesaj_id'] . '" class="deleteBtn"><button class="btn btn-danger btn-sm">Sil</button></a></td>
            </tr>';
        }
        $output .= "</tbody></table>";
    } else {
        $output .= '<h3 class="text-center text-danger"> Mesaj Bulunmamaktadir</h3>';
    }
    echo $output;
}

if (isset($_POST['action']) && $_POST['action'] == 'mesaggeDetail') {
    $row = $user->getMessageByUserID($user->guvenlik($_POST['mesaj_id']), $user->guvenlik($_SESSION['userkullanici_id']));
    echo json_encode($row);
}

if (isset($_POST['action']) && $_POST['action'] == 'getAllMessageInbox') {
    $output = '';
    $data = $user->getAllInboxByUser($user->guvenlik($_SESSION['userkullanici_id']));
    if ($data) {
        $output .= '
        <table class="table table-responsive table-striped listTable">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Mesaj Tarihi</th>
                    <th scope="col">Gönderen</th>
                    <th scope="col">İçerik</th>
                    <th scope="col">Durum</th>
                    <th scope="col">Detay</th>
                    <th></th>
                </tr>
            </thead>
        <tbody>';
        $say = 0;
        foreach ($data as $mesajcek) {
            $say++;
            $output .= ' 
            <tr>
                <th scope="row">' . $say . '</th>
                <td>' . tarih($mesajcek['mesaj_zaman']) . '</td>
                <td><a href="satici-' . $mesajcek['kullanici_ad'] . '-' . $mesajcek['kullanici_soyad'] . '-' . $mesajcek['kullanici_gon'] . '">' . $mesajcek['kullanici_ad'] . " " . $mesajcek['kullanici_soyad'] . '</a></td>
                <td>' . htmlspecialchars_decode(kisalt($mesajcek['mesaj_detay'], 0, 15)) . '</td><td>';
            if ($mesajcek['mesaj_okunma'] == 0) {
                $output .= ' <i style="color:orange" class="fa fa-circle" aria-hidden="true">';
            } else {
                $output .= ' <i class="fa fa-circle" aria-hidden="true">';
            }
            $output .= '</td><td><a href="#" id="' . $mesajcek['mesaj_id'] . '" class="detailBtn"><button class="btn btn-primary btn-sm"  data-toggle="modal" data-target="#detailMessage">Mesajı Oku</button></a></td>
                <td><a href="#" id="' . $mesajcek['mesaj_id'] . '" class="deleteBtn"><button class="btn btn-danger btn-sm">Sil</button></a></td>
            </tr>';
        }
        $output .= "</tbody></table>";
    } else {
        $output .= '<h3 class="text-center text-danger"> Mesaj Bulunmamaktadir</h3>';
    }
    echo $output;
}
if (isset($_POST['action']) && $_POST['action'] == 'messageDetailInbox') {
    $row = $user->getMessageByUserIDInbox($user->guvenlik($_POST['mesaj_id']), $user->guvenlik($_SESSION['userkullanici_id']));
    if ($row['mesaj_okunma'] == 0) {
        $user->inboxRead($_POST['mesaj_id']);
    }
    echo json_encode($row);
}
if (isset($_POST['action']) && $_POST['action'] == 'count') {
    $output = 0;
    $row = $user->messageCount($user->guvenlik($_SESSION['userkullanici_id']));
    echo $row['say'];
}

if (isset($_POST['action']) && $_POST['action'] == 'teslimEtOnay') {
    if ($user->siparisdetayonay($user->guvenlik($_POST['siparis_id']))) {
        $msg["success"] = "Ürün Teslim islemi Tamamlandi";
    } else {
        $msg["danger"] = "Ürün Teslim islemi Hata";
    }
    echo json_encode($msg);
}

if (isset($_POST['action']) && $_POST['action'] == 'orderList') {
    $output = '';
    $data = $user->getAllOrderByUser($user->guvenlik($_SESSION['userkullanici_id']));
    if ($data) {
        $output .= '<table class="table table-striped listTable">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Tarih</th>
                <th scope="col">Sipariş No</th>
                <th scope="col">Alıcı</th>
                <th scope="col">Ürün Ad</th>
                <th scope="col">Ürün Fiyat</th>
                <th scope="col">Durum</th>
            </tr>
        </thead>
        <tbody>';
        $say = 0;
        foreach ($data as $sipariscek) {
            $say++;
            $output .= ' 
            <tr>
                <th scope="row">' . $say . '</th>
                <td>' . tarih($sipariscek['siparis_zaman']) . '</td>
                <td>' . $sipariscek['siparis_id'] . '</td>
                <td>' . $sipariscek['kullanici_ad'] . ' ' . $sipariscek['kullanici_soyad'] . '</td>
                <td>' . $sipariscek['urun_ad'] . '</td>
                <td>' . fiyat($sipariscek['urun_fiyat']) . '</td><td>';
            if ($sipariscek['siparisdetay_onay'] == 0) {
                $output .= ' <a href="#" id="' . $sipariscek['siparisdetay_id'] . '" class="btn btn-warning btn-xs teslimEt"> Teslim Et</a>';
            } else if ($sipariscek['siparisdetay_onay'] == 1) {
                $output .= ' <button class="btn btn-info btn-xs"> Alıcıdan Ödeme Bekliyor</button>';
            } else if ($sipariscek['siparisdetay_onay'] == 2) {
                $output .= ' <a href="tamamlanan-siparisler"><button class="btn btn-success btn-xs"> Tamamalanan Siparis</button></a>';
            }
            $output .= '</td></tr>';
        }
        $output .= "</tbody></table>";
    } else {
        $output .= '<h3 class="text-center text-danger"> Siparis Bulunmamaktadir</h3>';
    }
    echo $output;
}
