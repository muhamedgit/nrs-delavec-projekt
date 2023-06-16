<?php
// Povezava z bazo podatkov
include("../common_var.php");

$conn = new mysqli($servername, $username, $password, $dbname);

// Preverjanje povezave
if ($conn->connect_error) {
    die("Povezava ni uspela: " . $conn->connect_error);
}

// Obdelava obrazca za registracijo
$errorMessage = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    if ($pass == '' || $email == '') {
        $errorMessage = "Niste vpisali gesla ali emaila";
    } else {
        // Priprava in izvedba poizvedbe za vstavljanje podatkov
        $sql = "INSERT INTO uporabnik (email, password) VALUES ('$email', '$pass')";
        if ($conn->query($sql) === TRUE) {
            // Uspešno vstavljanje podatkov, preusmeritev na stran za prijavo
            header('Location: login.php');
            exit();
        } else {
            // Napaka pri vstavljanju podatkov
            echo "Napaka pri vstavljanju podatkov: " . $conn->error;
        }
    }
}

// Zapiranje povezave z bazo podatkov
$conn->close();
?>

<!DOCTYPE html>
<html lang="sl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="style_register.css">
    <title>Register</title>
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
                <input autofocus placeholder="Email" type="email" name="email" id="email">
                <input placeholder="Geslo" type="password" name="pass" id="pass">
                <input type="submit" value="Registracija">
            </div>
        </form>
    </div>
    <?php if (!empty($errorMessage)): ?>
            <div class="error"><?php echo $errorMessage; ?></div>
        <?php endif; ?>
</body>
</html>
