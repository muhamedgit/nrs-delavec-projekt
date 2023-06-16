<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../style_menu.css">
    <link rel="stylesheet" href="../style_table.css">
    <style>
        .tableContainer table th:nth-child(6),
        .tableContainer table td:nth-child(6) {
            width: 10%;
            text-align: center;
        }
    </style>
    <title>Seminarska brisi</title>
</head>

<body>
    <?php
    include("../head.php");

    include "../common_var.php";
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    mysqli_query($conn, "set names 'utf8'");
    $sql = "SELECT * FROM delavec";

    $result = mysqli_query($conn, $sql);

    if ($_SERVER['REQUEST_METHOD'] === "POST") {
        $idDelavca = $_POST["idDelavca"];

        $deleteFromDB = "DELETE FROM delavec WHERE id_delavec = $idDelavca";
        if (mysqli_query($conn, $deleteFromDB)) {
            header("Location: delavec_brisi.php?success=true"); // Preusmeritev z uspešno spremenljivko "success"
            exit();
        } else {
            echo "Napaka: " . $deleteFromDB . "<br>" . mysqli_error($conn);
        }
    }

    if (isset($_GET['success']) && $_GET['success'] == 'true') {
        echo "<p class='success'>Delavec je bil uspešno izbrisan</p>"; // Sporočilo o uspehu, če je spremenljivka "success" prisotna v naslovu
    }

    echo "<div class='tableContainer'>";
    echo "<table>";
    echo "<tr><th>Id Delavca</th><th>Ime</th><th>Izobrazba</th><th>Plača</th><th>Id Podjetje</th><th>Akcije</th></tr>";

    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row["id_delavec"] . "</td>"; // Prikaz id-ja delavca
        echo "<td>" . $row["ime"] . "</td>"; // Prikaz imena delavca
        echo "<td>" . $row["izobrazba"] . "</td>"; // Prikaz izobrazbe delavca
        echo "<td>" . $row["placa"] . "</td>"; // Prikaz plače delavca
        echo "<td>" . $row["id_podjetje"] . "</td>"; // Prikaz id-ja podjetja
        echo "<td>
            <form action='delavec_brisi.php' method='post'>
                <input type='hidden' name='idDelavca' value='" . $row["id_delavec"] . "'>
                <button class='deleteButton' type='submit'>Izbriši</button>
            </form>
        </td>"; // Gumb za izbris delavca
        echo "</tr>";
    }
    echo "</table>";
    echo "</div>";

    mysqli_close($conn);
    ?>
</body>

</html>
