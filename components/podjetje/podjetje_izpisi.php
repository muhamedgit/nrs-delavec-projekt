<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../style_table.css">
    <link rel="stylesheet" href="../style_menu.css">
    <title>Seminarska izpisi</title>
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

        // Poizvedba za pridobitev podatkov iz tabele 'podjetje'
        $sql = "SELECT * FROM podjetje";
        $result = mysqli_query($conn, $sql);

        // Preveri, ali je prišlo do napake pri izvajanju poizvedbe
        if (!mysqli_query($conn, $sql)) {
            echo "Napaka: " . $sql . "<br>" . mysqli_error($conn);
        }

        echo "<table>";
        echo "<tr><th>Id Podjetja</th><th>Naziv Podjetja</th><th>Mesto</th></tr>";

        // Izpiši podatke v tabeli
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr><td class='numColumn'>" . $row["id_podjetje"] . "</td><td>" . $row["naziv"] . "</td><td>" . $row["mesto"] . "</td></tr>";
        }
        echo "</table>";

        mysqli_close($conn);
        ?>
    </div>
</body>
</html>
