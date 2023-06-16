<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seminarska izpis</title>
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

        $sql = "SELECT * FROM projekt";
        $result = mysqli_query($conn, $sql);

        if (!mysqli_query($conn, $sql)) {
            echo "Napaka: " . $sql . "<br>" . mysqli_error($conn);
        }

        echo "<table>";
        echo "<tr><th>ID Projekta</th><th>Naziv</th><th>Sredstva</th></tr>";

        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row["id_projekt"] . "</td>"; // Izpiše ID projekta
            echo "<td>" . $row["naziv"] . "</td>"; // Izpiše naziv projekta
            echo "<td>" . $row["sredstva"] . "</td>"; // Izpiše sredstva projekta
            echo "</tr>";
        }
        echo "</table>";

        mysqli_close($conn);
        ?>
    </div>
</body>

</html>
