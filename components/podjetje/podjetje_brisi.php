<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../style_menu.css">
    <link rel="stylesheet" href="../style_table.css">
    <title>Seminarska brisi</title>
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
    $sql = "SELECT * FROM podjetje";

    $result = mysqli_query($conn, $sql);

    // Preveri, če je bil obrazec poslan in če je bil podan parameter "idPodjetja"
    if ($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST["idPodjetja"])) {
        $idPodjetja = $_POST["idPodjetja"];

        $deleteFromDB = "DELETE FROM podjetje WHERE id_podjetje = $idPodjetja";
        if (mysqli_query($conn, $deleteFromDB)) {
            header("Location: podjetje_brisi.php?success=true"); // Preusmeri na stran s parametrom "success" za sporočilo o uspehu
            exit();
        } else {
            echo "Napaka: " . $deleteFromDB . "<br>" . mysqli_error($conn);
        }
    }

    // Preveri, ali je bil parameter "success" podan v URL-ju in če je enak "true"
    if (isset($_GET['success']) && $_GET['success'] == 'true') {
        echo "<p class='success'>Podjetje je bilo uspešno izbrisano</p>"; // Izpiši sporočilo o uspehu, če je parameter prisoten
    }

    echo "<div class='tableContainer'>";
    echo "<table>";
    echo "<tr><th>Id Podjetja</th><th>Naziv Podjetja</th><th>Mesto</th><th>Akcije</th></tr>";

    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row["id_podjetje"] . "</td>";
        echo "<td>" . $row["naziv"] . "</td>";
        echo "<td>" . $row["mesto"] . "</td>";
        echo "<td>
            <form action='podjetje_brisi.php' method='post'>
                <input type='hidden' name='idPodjetja' value='" . $row["id_podjetje"] . "'>
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
