<?php
$baglan = new PDO("mysql:host=localhost;dbname=deneme", "Sahra", "1234");
$baglan->query("set charset set utf8");
$baglan->exec("set names utf8");
$baglan->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
