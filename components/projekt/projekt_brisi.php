<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../style_menu.css">
    <link rel="stylesheet" href="../style_table.css">
    <title>Izpis</title>
</head>
<style>
    .tableContainer table th:nth-child(4),
    .tableContainer table td:nth-child(4) {
        width: 10%;
        text-align: center;
    }
</style>

<body>
    <?php
    include("../head.php");

    include "../common_var.php";
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    mysqli_query($conn, "set names 'utf8'");
    $sql = "SELECT * FROM projekt";

    $result = mysqli_query($conn, $sql);

    // Obdelava brisanja projekta
    if ($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST["idProjekta"])) {
        $idProjekta = $_POST["idProjekta"];

        $deleteFromDB = "DELETE FROM projekt WHERE id_projekt = $idProjekta";
        if (mysqli_query($conn, $deleteFromDB)) {
            header("Location: projekt_brisi.php?success=true"); // Preusmeritev s parametrom za uspešnost
            exit();
        } else {
            echo "Napaka: " . $deleteFromDB . "<br>" . mysqli_error($conn);
        }
    }

    if (isset($_GET['success']) && $_GET['success'] == 'true') {
        echo "<p class='success'>Projekt je bil uspešno izbrisan</p>"; // Prikaži sporočilo o uspešnem brisanju, če je parameter prisoten
    }

    echo "<div class='tableContainer'>";
    echo "<table>";
    echo "<tr><th>ID Projekta</th><th>Naziv</th><th>Sredstva</th><th>Akcije</th></tr>";

    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row["id_projekt"] . "</td>";
        echo "<td>" . $row["naziv"] . "</td>";
        echo "<td>" . $row["sredstva"] . "</td>";
        echo "<td>
            <form action='projekt_brisi.php' method='post'>
                <input type='hidden' name='idProjekta' value='" . $row["id_projekt"] . "'>
                <button class='deleteButton' type='submit'>Izbriši</button>
            </form>
        </td>";
        echo "</tr>";
    }
    echo "</table>";
    echo "</div>";

    mysqli_close($conn);
    ?>
</body>

</html>
