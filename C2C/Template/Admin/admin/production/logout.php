<?php
session_start();
//session_destroy();
unset($_SESSION['kullanici_mail']);
header("Location:login.php?durum=exit");
