<?php
// $baglan = new PDO("mysql:host=localhost;dbname=deneme", "Sahra", "1234");
// $baglan->query("set charset set utf8");
// $baglan->exec("set names utf8");
// $baglan->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

try {
    $baglan = new PDO("mysql:host=localhost;dbname=deneme;charset=utf8", "Sahra", "1234");
    $baglan->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Bağlantı Hatası : " . $e->getMessage() . "<br>";
}
