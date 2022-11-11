<?php
session_start();
if ($adet != 0) {
    $_SESSION["oturum"] = "var";
    setcookie("cerez", "var", time() + 3600);
    var_dump($_POST);
    var_dump($_SESSION);
    header("Location: sepet.php");
} else {
    header("Location: sepet.php");
}
