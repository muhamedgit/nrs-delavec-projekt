<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Izbriši sodeluje</title>
    <link rel="stylesheet" href="../style_menu.css">
    <link rel="stylesheet" href="../style_table.css">
</head>

<body>
    <?php
    include("../head.php");
    ?>

    <div class="tableContainer">
        <?php
        include "../common_var.php";
        $conn = mysqli_connect($servername, $username, $password, $dbname);
        mysqli_query($conn, "set names 'utf8'");

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $idProjekta = $_POST['idProjekta'];
            $idDelavca = $_POST['idDelavca'];

            $sql = "DELETE FROM sodeluje WHERE id_projekt = $idProjekta AND id_delavec = $idDelavca";
            if (mysqli_query($conn, $sql)) {
                echo "<p class='success'>Podatek uspešno izbrisan</p>";
            } else {
                echo "Napaka: " . $sql . "<br>" . mysqli_error($conn);
            }
        }

        $sql = "SELECT s.id_projekt, s.id_delavec, s.funkcija, s.datum_nastopa, d.ime AS delavec_ime, p.naziv AS projekt_naziv
                FROM sodeluje s
                JOIN delavec d ON s.id_delavec = d.id_delavec
                JOIN projekt p ON s.id_projekt = p.id_projekt";
        $result = mysqli_query($conn, $sql);

        if (!mysqli_query($conn, $sql)) {
            echo "Napaka: " . $sql . "<br>" . mysqli_error($conn);
        }

        echo "<table>";
        echo "<tr><th>Projekt</th><th>Delavec</th><th>Funkcija</th><th>Datum Nastopa</th><th class='action'>Akcije</th></tr>";

        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row["projekt_naziv"] . "</td>";
            echo "<td>" . $row["delavec_ime"] . "</td>";
            echo "<td>" . $row["funkcija"] . "</td>";
            echo "<td>" . $row["datum_nastopa"] . "</td>";
            echo "<td class='action'>
                    <form method='post' action='sodeluje_brisi.php'>
                        <input type='hidden' name='idProjekta' value='" . $row["id_projekt"] . "'>
                        <input type='hidden' name='idDelavca' value='" . $row["id_delavec"] . "'>
                        <button class='deleteButton' type='submit'>Izbriši</button>
                    </form>
                </td>";
            echo "</tr>";
        }
        echo "</table>";

        mysqli_close($conn);
        ?>
    </div>
</body>

</html>
