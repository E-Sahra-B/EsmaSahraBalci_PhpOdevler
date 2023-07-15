<?php
require_once 'db.php';

class Auth extends Database
{
    public function register($name, $surname, $email, $password, $authorization)
    {
        // $sql = "INSERT INTO users (username, email, password) VALUES ('" . $name . "','" . $email . "', '" . $password . "')";
        $sql = "INSERT INTO kullanici (kullanici_ad, kullanici_soyad, kullanici_mail,kullanici_password,kullanici_yetki) VALUES (:kullanici_ad, :kullanici_soyad, :kullanici_mail,:kullanici_password,:kullanici_yetki)";
        $stmt = $this->baglan->prepare($sql);
        $stmt->execute(['kullanici_ad' => $name, 'kullanici_soyad' => $surname, 'kullanici_mail' => $email, 'kullanici_password' => $password, 'kullanici_yetki' => $authorization]);
        return true;
    }

    public function user_exist($email)
    {
        $sql = "SELECT kullanici_mail FROM kullanici WHERE kullanici_mail=:email";
        $stmt = $this->baglan->prepare($sql);
        $stmt->execute(['email' => $email]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function login($email)
    {
        $sql = "SELECT kullanici_mail, kullanici_password FROM kullanici WHERE kullanici_mail=:email AND kullanici_durum !=0";
        $stmt = $this->baglan->prepare($sql);
        $stmt->execute(['email' => $email]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function userTimeUpdate($email)
    {
        $sql = "UPDATE kullanici SET kullanici_sonzaman=:kullanici_sonzaman WHERE kullanici_mail='$email'";
        $stmt = $this->baglan->prepare($sql);
        $result = $stmt->execute(['kullanici_sonzaman' => date("Y-m-d H:i:s")]);
        return $result;
    }

    //Is there a user
    public function currentUser($email)
    {
        $sql = "SELECT * FROM kullanici WHERE kullanici_mail=:email AND kullanici_durum !=0";
        $stmt = $this->baglan->prepare($sql);
        $stmt->execute(['email' => $email]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    //Forgot Password
    public function forgotPassword($token, $email)
    {
        $sql = "UPDATE kullanici SET kullanici_token=:token, token_expire=DATE_ADD(NOW(),INTERVAL 10 MINUTE) WHERE kullanici_mail=:email";
        $stmt = $this->baglan->prepare($sql);
        $stmt->execute(['token' => $token, 'email' => $email]);
        return true;
    }
    //Reset Password User Auth
    public function resetPassAuth($email, $token)
    {
        $sql = "SELECT id FROM kullanici WHERE 
        kullanici_mail=:email AND 
        kullanici_token=:token AND 
        kullanici_token!='' AND 
        token_expire > NOW() AND 
        kullanici_durum !=0";
        $stmt = $this->baglan->prepare($sql);
        $stmt->execute(['email' => $email, 'token' => $token]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function addProduct($kategori_id, $kullanici_id, $urun_ad, $urun_detay, $urun_fiyat, $urunfoto_resimyol)
    {
        $sql = "INSERT INTO urun SET
		kategori_id=:kategori_id,
		kullanici_id=:kullanici_id,
		urun_ad=:urun_ad,
		urun_detay=:urun_detay,
		urun_fiyat=:urun_fiyat,
		urunfoto_resimyol=:urunfoto_resimyol
		";
        $stmt = $this->baglan->prepare($sql);
        $stmt->execute([
            'kategori_id' => $kategori_id,
            'kullanici_id' => $kullanici_id,
            'urun_ad' => $urun_ad,
            'urun_detay' => $urun_detay,
            'urun_fiyat' => $urun_fiyat,
            'urunfoto_resimyol' => $urunfoto_resimyol
        ]);
        return true;
    }
    public function upload_file($file)
    {
        if (isset($file)) {
            $extension = pathinfo($file["name"], PATHINFO_EXTENSION);
            @$tmp_name = $_FILES['urunfoto_resimyol']["tmp_name"];
            $uploads_dir = '../../img/product';
            $uniq = uniqid();
            $refimgyol = substr($uploads_dir, 6) . "/" . $uniq  . "." . $extension;
            @move_uploaded_file($tmp_name, "$uploads_dir/$uniq.$extension");
            return $refimgyol;
        }
    }

    public function Delete($x, $id)
    {
        $sql = "DELETE FROM " . $x . " WHERE " . $x . "_id=:id";
        $stmt = $this->baglan->prepare($sql);
        $stmt->execute(['id' => $id]);
        return true;
    }
    public function messageDelete($x, $id)
    {
        return $this->Delete($x, $id);
    }

    public function productDelete($x, $id)
    {
        return $this->Delete($x, $id);
    }

    public function OtherUser($id)
    {
        $sql = "SELECT * FROM kullanici WHERE kullanici_id NOT IN (:id)";
        $stmt = $this->baglan->prepare($sql);
        $stmt->execute(['id' => $id]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    public function addMessage($mesaj_detay, $kullanici_gel, $kullanici_gon)
    {
        $sql = "INSERT INTO mesaj SET
		mesaj_detay=:mesaj_detay,
		kullanici_gel=:kullanici_gel,
		kullanici_gon=:kullanici_gon
		";
        $stmt = $this->baglan->prepare($sql);
        $stmt->execute([
            'mesaj_detay' => $mesaj_detay,
            'kullanici_gel' => $kullanici_gel,
            'kullanici_gon' => $kullanici_gon
        ]);
        return true;
    }

    public function getAllMessageByUser($id)
    {
        $sql = "SELECT mesaj.*,kullanici.* 
        FROM mesaj 
        INNER JOIN kullanici ON mesaj.kullanici_gel=kullanici.kullanici_id 
        WHERE mesaj.kullanici_gon=:id 
        ORDER BY mesaj_okunma,mesaj_zaman DESC";
        $stmt = $this->baglan->prepare($sql);
        $stmt->execute(['id' => $id]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getMessageByUserID($msgId, $id)
    {
        $sql = "SELECT mesaj.*,kullanici.* 
        FROM mesaj 
        INNER JOIN kullanici ON mesaj.kullanici_gel=kullanici.kullanici_id 
        WHERE mesaj.kullanici_gon=:id  AND mesaj.mesaj_id=:mesaj_id";
        $stmt = $this->baglan->prepare($sql);
        $stmt->execute(['id' => $id, 'mesaj_id' => $msgId]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
    public function getAllInboxByUser($id)
    {
        $sql = "SELECT mesaj.*,kullanici.* 
        FROM mesaj 
        INNER JOIN kullanici ON mesaj.kullanici_gon=kullanici.kullanici_id 
        WHERE mesaj.kullanici_gel=:id 
        ORDER BY mesaj_okunma,mesaj_zaman DESC";
        $stmt = $this->baglan->prepare($sql);
        $stmt->execute(['id' => $id]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getMessageByUserIDInbox($msgId, $id)
    {
        $sql = "SELECT mesaj.*,kullanici.* 
        FROM mesaj 
        INNER JOIN kullanici ON mesaj.kullanici_gon=kullanici.kullanici_id 
        WHERE mesaj.kullanici_gel=:id  AND mesaj.mesaj_id=:mesaj_id";
        $stmt = $this->baglan->prepare($sql);
        $stmt->execute(['id' => $id, 'mesaj_id' => $msgId]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
    public function inboxRead($msgId)
    {
        $sql = "UPDATE mesaj SET mesaj_okunma=:mesaj_okunma WHERE mesaj_id=:msgId";
        $stmt = $this->baglan->prepare($sql);
        $stmt->execute(['mesaj_okunma' => 1, 'msgId' => $msgId]);
        return true;
    }

    public function messageCount($userId)
    {
        $sql = "SELECT COUNT(mesaj_okunma) as say FROM mesaj WHERE mesaj_okunma=:mesaj_okunma AND kullanici_gel=:kullanici_id";
        $stmt = $this->baglan->prepare($sql);
        $stmt->execute(['mesaj_okunma' => 0, 'kullanici_id' => $userId]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
    public function orderCount($userId)
    {
        $sql = "SELECT COUNT(kullanici_idsatici) as ordercount FROM siparis WHERE kullanici_idsatici=:id";
        $stmt = $this->baglan->prepare($sql);
        $stmt->execute(['id' => $userId]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function siparisdetayonay($siparisDetayId)
    {
        $sql = "UPDATE siparis_detay SET siparisdetay_onay=:onay WHERE siparisdetay_id=:id";
        $stmt = $this->baglan->prepare($sql);
        $stmt->execute(['onay' => 1, 'id' => $siparisDetayId]);
        return true;
    }

    public function getAllOrderByUser($id)
    {
        $sql = "SELECT siparis.*,siparis_detay.*,kullanici.*,urun.*
        FROM siparis 
        INNER JOIN siparis_detay ON siparis.siparis_id=siparis_detay.siparis_id 
        INNER JOIN kullanici ON kullanici.kullanici_id=siparis_detay.kullanici_id 
        INNER JOIN urun ON urun.urun_id=siparis_detay.urun_id 
        where siparis.kullanici_idsatici=:kullanici_idsatici 
        ORDER BY siparis_zaman DESC";
        $stmt = $this->baglan->prepare($sql);
        $stmt->execute(['kullanici_idsatici' => $id]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function allSumOrder()
    {
        $sql = "SELECT SUM(urun_fiyat) as toplamSatisTutari FROM siparis_detay";
        $stmt = $this->baglan->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
    public function allCountOrder()
    {
        $sql = "SELECT COUNT(siparis_id) as toplamSatisAdeti FROM siparis_detay";
        $stmt = $this->baglan->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
    public function allCountProduct()
    {
        $sql = "SELECT COUNT(urun_id) as toplamUrun FROM urun";
        $stmt = $this->baglan->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
    public function salesQuantity($saticiId)
    {
        $sql = "SELECT COUNT(kullanici_idsatici) as saticiSatisAdeti FROM siparis_detay where kullanici_idsatici=:id";
        $stmt = $this->baglan->prepare($sql);
        $stmt->execute(['id' => $saticiId]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function timeInAgo($timestamp)
    {
        //date_default_timezone_set('Europe/Istanbul');
        $timestamp = strtotime($timestamp) ? strtotime($timestamp) : $timestamp;
        $time = time() - $timestamp;
        switch ($time) {
            case $time <= 60:
                return 'Şimdi';
                break;
            case $time >= 60 && $time < 60 * 60:
                return (round($time / 60) == 1) ? ' 1 dakika önce' : round($time / 60) . ' dakika önce';
                break;
            case $time >= 60 * 60 && $time < 60 * 60 * 24:
                return (round($time / 3600) == 1) ? ' 1 saat önce' : round($time / 3600) . ' saat önce';
                break;
            case $time >= 60 * 60 * 24 && $time < 60 * 60 * 24 * 7:
                return (round($time / 86400) == 1) ? ' 1 gün önce' : round($time / 86400) . ' gün önce';
                break;
            case $time >= 60 * 60 * 24 * 7 && $time < 2629800:
                return (round($time / 604800) == 1) ? ' 1 hafta önce' : round($time / 604800) . ' hafta önce';
                break;
            case $time >= 2629800 && $time < 31557600: //60*60*24*(365,25/12)
                return (round($time / 2629800) == 1) ? ' 1 ay önce' : round($time / 2629800) . ' ay önce';
                break;
            case $time >= 31557600: //(365*(60*60*24))+(6*60*60) // 365,25*(60*60*24)
                return (round($time / 31557600) == 1) ? ' 1 yıl önce' : round($time / 31557600) . ' yıl önce';
                break;
        }
        //$bugun = tarih($yorumcek['yorum_zaman']);
        $bugun = date("Y-m-d");
        $cevir = strtotime('-1 day', strtotime($bugun));
        echo date("Y-m-d", $cevir);
    }

    public function totalProductsOfCategories()
    {
        $sql = "SELECT kategori.kategori_ad AS ad,COUNT(urun.kategori_id) AS say FROM urun
        INNER JOIN kategori ON urun.kategori_id = kategori.kategori_id
        WHERE urun.urun_durum='1' 
        GROUP BY kategori.kategori_id ";
        $stmt = $this->baglan->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function exportAllUser()
    {
        $sql = "SELECT * FROM kullanici where kullanici_yetki=1";
        $stmt = $this->baglan->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
}
