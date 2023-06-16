<?php
session_start();
include("../common_var.php");

// Preverjanje ali je uporabnik že prijavljen
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
    header('Location: /index.php'); // Preusmeritev na domačo stran ali drugo ustrezno stran
    exit();
}

// Preverjanje, ali je obrazec za prijavo oddan
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $pass = $_POST['pass'];

    // Povezava z bazo podatkov
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Preverjanje povezave
    if ($conn->connect_error) {
        die("Povezava ni uspela: " . $conn->connect_error);
    }

    // Priprava in izvedba poizvedbe za preverjanje uporabniških podatkov v bazi
    $sql = "SELECT * FROM uporabnik WHERE email='$email' AND password='$pass'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Uporabniški podatki so pravilni
        $_SESSION['email'] = $email;
        $_SESSION['logged_in'] = true;
        $_SESSION['start_time'] = time(); // Za beleženje začetka seje

        // Preverjanje, ali je bila označena kljukica "Zapomni si me"
        if (isset($_POST['remember']) && $_POST['remember'] === 'on') {
            // Nastavitev piškotka za shranjevanje podatkov o prijavi na odjemalcu
            setcookie('login_email', $email, time() + (86400 * 1)); // Piškotek veljaven 1 dan
        }

        header('Location: /index.php'); // Preusmeritev na domačo stran ali drugo ustrezno stran
        exit();
    } else {
        // Uporabniški podatki niso pravilni
        $errorMessage = "Napačen email ali geslo";
    }

    // Zapiranje povezave z bazo podatkov
    $conn->close();
}

// Preverjanje, ali je piškotek za prijavo prisoten
if (isset($_COOKIE['login_email']) && !isset($_SESSION['logged_in'])) {
    $email = $_COOKIE['login_email'];

    // Povezava z bazo podatkov
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Preverjanje povezave
    if ($conn->connect_error) {
        die("Povezava ni uspela: " . $conn->connect_error);
    }

    // Priprava in izvedba poizvedbe za preverjanje uporabniških podatkov v bazi
    $sql = "SELECT * FROM uporabnik WHERE email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Uporabnik najden na podlagi piškotka
        $_SESSION['email'] = $email;
        $_SESSION['logged_in'] = true;
        $_SESSION['start_time'] = time(); // Za beleženje začetka seje

        header('Location: /index.php'); // Preusmeritev na domačo stran ali drugo ustrezno stran
        exit();
    }

    // Zapiranje povezave z bazo podatkov
    $conn->close();
} elseif (isset($_COOKIE['login_email']) && isset($_SESSION['logged_in'])) {
    // Če je uporabnik že prijavljen, izbrišemo piškotek za prijavo
    setcookie('login_email', '', time() - 3600, '/');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">
    <title>Login</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 98vh;
        }
    </style>
</head>
<body>
    <div class="formCont">
        <form action="" method="post">
            <div class="forminner">
                <input required autofocus placeholder="Email" type="email" name="email" id="">
                <input required placeholder="Geslo" type="password" name="pass" id="">
                <label for="remember">
                    <input type="checkbox" name="remember" id="remember"> Zapomni si me
                </label>
                <input type="submit" value="Login">
               <div class="linkCont">
                    <a href="register.php">Registracija</a>
                    <a href="/index.php">Domov</a>
               </div>
            </div>
        </form>
    </div>
    <?php if (isset($errorMessage)): ?>
            <div class="error"><?php echo $errorMessage; ?></div>
        <?php endif; ?>
</body>
</html>
