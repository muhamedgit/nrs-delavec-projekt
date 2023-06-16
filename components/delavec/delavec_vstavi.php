<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="../style_menu.css">
    <title>Seminarska vstavi</title>
</head>

<body>
<?php
    include("../head.php");
?>

<div class="formCont">
    <form action="delavec_vstavi.php" method="post">
        <div class="forminner">
            <input type="text" placeholder="Ime" name="imeDelavca" id="ime">
            <select name="izobrazba" id="izobrazba">
                <option value="visoka">Visoka</option>
                <option value="višja">Višja</option>
                <option value="srednja">Srednja</option>
                <option value="osnovna">Osnovna</option>
            </select>
            <input type="number" placeholder="Plača" name="placa" id="placa">
            <select name="id_podjetje" id="id_podjetje">
                <?php
                include "../common_var.php";
                $conn = mysqli_connect($servername, $username, $password, $dbname);
                mysqli_query($conn, "set names 'utf8'");

                $podjetje_query = "SELECT id_podjetje, naziv FROM podjetje";
                $result = mysqli_query($conn, $podjetje_query);

                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<option value='" . $row['id_podjetje'] . "'>" . $row['naziv'] . "</option>";
                }

                mysqli_close($conn);
                ?>
            </select>
            <input type="submit" value="Pošlji">
        </div>
    </form>
</div>

<?php
include "../common_var.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Preveri, če so vsa polja izpolnjena
    if ($_POST["imeDelavca"] !== "" || $_POST["izobrazba"] !== "" || $_POST["placa"] !== "" || $_POST["id_podjetje"] !== "") {
        $conn = mysqli_connect($servername, $username, $password, $dbname);
        mysqli_query($conn, "set names 'utf8'");

        $imeDelavca = $_POST["imeDelavca"];
        $izobrazba = $_POST["izobrazba"];
        $placa = $_POST["placa"];
        $id_podjetje = $_POST["id_podjetje"];

        // Vstavi novega delavca v bazo podatkov
        $sql = "INSERT INTO delavec (ime, izobrazba, placa, id_podjetje) VALUES ('$imeDelavca', '$izobrazba', '$placa', '$id_podjetje')";

        if (mysqli_query($conn, $sql)) {
            echo "<p class='success'>Podatek uspešno vstavljen</p>";
        } else {
            echo "Napaka: " . $sql . "<br>" . mysqli_error($conn);
        }

        mysqli_close($conn);
    } else {
        echo "Prazna forma, preveri še enkrat";
    }
}
?>
</body>
</html>
