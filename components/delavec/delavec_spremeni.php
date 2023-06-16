<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../style_menu.css">
    <link rel="stylesheet" href="../style_table.css">
    <title>Seminarska spremeni</title>
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

        // Preveri, ali je zahteva POST in izvede posodobitev podatkov
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $idDelavca = $_POST['idDelavca'];
            $ime = $_POST['ime'];
            $izobrazba = $_POST['izobrazba'];
            $placa = $_POST['placa'];
            $idPodjetja = $_POST['idPodjetja'];

            // Posodobi podatke delavca v bazi podatkov
            $sql = "UPDATE delavec SET ime = '$ime', izobrazba = '$izobrazba', placa = '$placa', id_podjetje = $idPodjetja WHERE id_delavec = $idDelavca";
            if (mysqli_query($conn, $sql)) {
                echo "<p class='success'>Sprememba je bila uspešna</p>";
            } else {
                echo "<p class='error'>Spremembe ni bilo mogoče izvesti</p>" . mysqli_error($conn);
            }
        }

        // Izberi vse podatke o delavcih
        $sql = "SELECT * FROM delavec";
        $result = mysqli_query($conn, $sql);

        if (!mysqli_query($conn, $sql)) {
            echo "Napaka: " . $sql . "<br>" . mysqli_error($conn);
        }

        // Ustvari tabelo za prikaz podatkov
        echo "<table>";
        echo "<tr><th>Id Delavca</th><th>Ime</th><th>Izobrazba</th><th>Plača</th><th>Naziv Podjetja</th><th class='action'>Akcije</th></tr>";

        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row["id_delavec"] . "</td>"; // Prikaz id-ja delavca
            echo "<td>" . $row["ime"] . "</td>"; // Prikaz imena delavca
            echo "<td>" . $row["izobrazba"] . "</td>"; // Prikaz izobrazbe delavca
            echo "<td>" . $row["placa"] . "</td>"; // Prikaz plače delavca
            echo "<td>";
            
            $idPodjetja = $row["id_podjetje"];
            $sqlCompany = "SELECT naziv FROM podjetje WHERE id_podjetje = $idPodjetja";
            $resultCompany = mysqli_query($conn, $sqlCompany);
            if ($rowCompany = mysqli_fetch_assoc($resultCompany)) {
                echo $rowCompany["naziv"]; // Prikaz naziva podjetja
            }
            
            echo "</td>";
            
            // Ustvari obrazec za posodobitev podatkov delavca
            echo "<td class='action'>
                    <form method='post' action='delavec_spremeni.php' class='form-container'>
                        <input type='hidden' name='idDelavca' value='" . $row["id_delavec"] . "'>
                        <input type='text' name='ime' value='" . $row["ime"] . "'>
                        <select name='izobrazba'>
                            <option value='osnovna'" . ($row["izobrazba"] == 'osnovna' ? " selected" : "") . ">Osnovna</option>
                            <option value='srednja'" . ($row["izobrazba"] == 'srednja' ? " selected" : "") . ">Srednja</option>
                            <option value='visoka'" . ($row["izobrazba"] == 'visoka' ? " selected" : "") . ">Visoka</option>
                            <option value='višja'" . ($row["izobrazba"] == 'višja' ? " selected" : "") . ">Višja</option>
                        </select>
                        <input type='text' name='placa' value='" . $row["placa"] . "'>
                        <select name='idPodjetja'>";

            // Izberi vsa podjetja za prikaz v seznamu
            $sqlCompanies = "SELECT * FROM podjetje";
            $resultCompanies = mysqli_query($conn, $sqlCompanies);
            while ($rowCompany = mysqli_fetch_assoc($resultCompanies)) {
                echo "<option value='" . $rowCompany["id_podjetje"] . "'";
                if ($rowCompany["id_podjetje"] == $row["id_podjetje"]) {
                    echo " selected";
                }
                echo ">" . $rowCompany["naziv"] . "</option>";
            }

            echo "</select>
                        <button type='submit'>Potrdi</button>
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
