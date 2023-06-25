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
    public function __destruct()
    {
        $this->baglan = null;
    }
}
