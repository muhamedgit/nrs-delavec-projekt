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

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $idProjekta = $_POST['idProjekta'];
            $naziv = $_POST['naziv'];
            $sredstva = $_POST['sredstva'];

            $sql = "UPDATE projekt SET naziv = '$naziv', sredstva = '$sredstva' WHERE id_projekt = $idProjekta";
            if (mysqli_query($conn, $sql)) {
                echo "<p class='success'>Sprememba je bila uspešna</p>"; // Izpiše sporočilo o uspešni spremembi
            } else {
                echo "<p class='success'>Spremebe ni bilo mogoče izvesti</p>" . mysqli_error($conn); // Izpiše sporočilo o neuspešni spremembi
            }
        }

        $sql = "SELECT * FROM projekt";
        $result = mysqli_query($conn, $sql);

        if (!mysqli_query($conn, $sql)) {
            echo "Napaka: " . $sql . "<br>" . mysqli_error($conn); // Izpiše sporočilo o napaki pri izvajanju poizvedbe
        }

        echo "<table>";
        echo "<tr><th>ID Projekta</th><th>Naziv</th><th>Sredstva</th><th class='action'>Akcije</th></tr>";

        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td class='id'>" . $row["id_projekt"] . "</td>"; // Add the class 'id' for ID projekta
            echo "<td class='naziv'>" . $row["naziv"] . "</td>"; // Add the class 'naziv' for naziv projekta
            echo "<td class='sredstva'>" . $row["sredstva"] . "</td>"; // Add the class 'sredstva' for sredstva projekta
            echo "<td class='action'>
                    <form method='post' action='projekt_spremeni.php' class='form-container'>
                        <input type='hidden' name='idProjekta' value='" . $row["id_projekt"] . "'>
                        <input type='text' name='naziv' value='" . $row["naziv"] . "' class='input-field'> 
                        <input type='number' step='0.01' name='sredstva' value='" . $row["sredstva"] . "' class='input-field'> 
                        <button type='submit' class='confirm-button'>Potrdi</button> 
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
