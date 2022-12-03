<?php
error_reporting(0);
//session_destroy();
unset($_SESSION["giris"]);
setcookie("user", "", strtotime('-1 day'));
echo "<script>
        window.location.href='../login.php';
        </script>";
