<?php

require_once 'db.class.php'; //Veritabanı Sınıfı
require_once 'filtre.class.php'; // Filtreleme Sınıfı
require_once 'sepet.class.php'; // Sepet Sınıfı

# Veritabanı Bağlantı Bilgileri
define('DB_HOST', 'localhost');
define('DB_USER', 'Sahra');
define('DB_PASS', '1234');
define('DB_NAME', 'eii_proje');

# Veritabanı Bağlantı Nesnesi
$baglan = new SunDB(null, DB_HOST, DB_USER, DB_PASS, DB_NAME);

# Temizleme ve Doğrulama Nesnesi
$guvenlik = new Guvenlik();

# Sepet Nesnesi
$sepet = new Sepet();
