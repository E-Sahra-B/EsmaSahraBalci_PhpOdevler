<?php
session_start();
//session_destroy();
unset($_SESSION['userkullanici_mail']);
header("Location:index.php?durum=exit");
