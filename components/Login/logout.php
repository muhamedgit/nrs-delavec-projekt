<?php
session_start();

// Preveri, ali je nastavljen in veljaven piškotek za prijavo
if (isset($_COOKIE['login_email'])) {
    // Odstrani piškotek za prijavo
    setcookie('login_email', '', time() - 86400);
}

// Počisti vse spremenljivke seje
$_SESSION = array();

// Uniči sejo
session_destroy();

// Preusmeritev na stran za prijavo
header('Location: /components/Login/login.php');
exit();
?>
