<?php
class Database
{
    private $host = "mysql:host=localhost;dbname=c2c;charset=utf8";
    private $username = "Sahra";
    private $password = "1234";
    private $options  = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ);
    protected $baglan;
    public function __construct()
    {
        try {
            $this->baglan = new PDO($this->host, $this->username, $this->password, $this->options);
            return $this->baglan;
        } catch (PDOException $e) {
            echo "Bağlantı Hatası : " . $e->getMessage() . "<br>";
        }
    }

    public function guvenlik($deger)
    {
        $boslukSil = trim($deger);
        $tagTemizle = strip_tags($boslukSil);
        $etkisizYap = htmlspecialchars($tagTemizle, ENT_QUOTES);
        return $etkisizYap;
    }

    public function sonuc($result, $message)
    {
        return '<div class="alert alert-' . $result . ' alert-dismissible">
        <button class="close" data-dismiss="alert" aria-label="close">&times;</button>
        <strong class="text-center">' . $message . '</strong></div>';
    }

    public function __destruct()
    {
        $this->baglan = null;
    }
}
