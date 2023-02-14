<?php
try {
	$db = new PDO("mysql:host=localhost;dbname=c2c;charset=utf8", "Sahra", "1234");
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
	echo "Bağlantı Hatası : " . $e->getMessage() . "<br>";
}
