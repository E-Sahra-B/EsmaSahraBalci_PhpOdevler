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
}
