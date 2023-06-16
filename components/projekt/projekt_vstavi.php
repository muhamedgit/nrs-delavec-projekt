<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seminarska vstavi</title>
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="../style_menu.css">
</head>

<body>
    <?php
    include("../head.php");
    ?>

    <div class="formCont">
        <form action="projekt_vstavi.php" method="post">
            <div class="forminner">
                <input type="text" placeholder="Naziv" name="naziv" id="naziv">
                <input type="number" step="0.01" placeholder="Sredstva" name="sredstva" id="sredstva">
                <input type="submit" value="Pošlji">
            </div>
        </form>
    </div>

    <?php
    include "../common_var.php";

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if ($_POST["naziv"] !== "" || $_POST["sredstva"] !== "") {
            $conn = mysqli_connect($servername, $username, $password, $dbname);
            mysqli_query($conn, "set names 'utf8'");

            $naziv = $_POST["naziv"];
            $sredstva = $_POST["sredstva"];

            $sql = "INSERT INTO projekt (naziv, sredstva) VALUES ('$naziv', '$sredstva')";

            if (mysqli_query($conn, $sql)) {
                echo "<p class='success'>Podatek uspešno vstavljen</p>"; // Izpiše sporočilo o uspešnem vstavljanju
            } else {
                echo "Napaka: " . $sql . "<br>" . mysqli_error($conn); // Izpiše sporočilo o napaki pri vstavljanju
            }

            mysqli_close($conn);
        } else {
            echo "Prazna forma, preveri še enkrat"; // Izpiše sporočilo, če so polja prazna
        }
    }
    ?>
</body>

</html>
