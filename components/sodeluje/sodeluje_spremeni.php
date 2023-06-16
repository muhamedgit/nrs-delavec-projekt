<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sodeluje izpis</title>
    <link rel="stylesheet" href="../style_menu.css">
    <link rel="stylesheet" href="../style_table.css">
    <style>
        .form-container {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .form-container select,
        .form-container input[type="text"],
        .form-container input[type="datetime-local"],
        .form-container button {
            padding: 5px;
            margin-right: 10px;
        }
    </style>
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
            $idDelavca = $_POST['idDelavca'];
            $idProjekt = $_POST['idProjekt'];
            $funkcija = $_POST['funkcija'];
            $datumNastopa = $_POST['datumNastopa'];

            $sql = "UPDATE sodeluje SET funkcija = '$funkcija', datum_nastopa = '$datumNastopa' WHERE id_delavec = $idDelavca AND id_projekt = $idProjekt";
            if (mysqli_query($conn, $sql)) {
                echo "<p class='success'>Sprememba je bila uspešna</p>"; // Izpiše sporočilo o uspešni spremembi
            } else {
                echo "<p class='success'>Spremebe ni bilo mogoče izvesti</p>" . mysqli_error($conn); // Izpiše sporočilo o neuspešni spremembi
            }
        }

        // Fetching project and worker names from related tables
        $sql = "SELECT s.id_delavec, d.ime AS delavec_ime, s.id_projekt, p.naziv AS projekt_naziv, s.funkcija, s.datum_nastopa
                FROM sodeluje s
                JOIN delavec d ON s.id_delavec = d.id_delavec
                JOIN projekt p ON s.id_projekt = p.id_projekt";
        $result = mysqli_query($conn, $sql);

        if (!mysqli_query($conn, $sql)) {
            echo "Napaka: " . $sql . "<br>" . mysqli_error($conn); // Izpiše sporočilo o napaki pri izvajanju poizvedbe
        }

        echo "<table>";
        echo "<tr><th>ID Delavca</th><th>ID Projekt</th><th>Funkcija</th><th>Datum Nastopa</th><th class='action'>Akcije</th></tr>";

        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row["delavec_ime"] . "</td>"; // Izpiše ime delavca
            echo "<td>" . $row["projekt_naziv"] . "</td>"; // Izpiše naziv projekta
            echo "<td>" . $row["funkcija"] . "</td>"; // Izpiše funkcijo
            echo "<td>" . $row["datum_nastopa"] . "</td>"; // Izpiše datum nastopa

            echo "<td class='action'>";
            echo "<form method='post' action='sodeluje_spremeni.php' class='form-container'>";
            // Fetching worker names for the dropdown list
            $sql_delavci = "SELECT id_delavec, ime FROM delavec";
            $result_delavci = mysqli_query($conn, $sql_delavci);
            echo "<select name='idDelavca' class='form-select'>";
            while ($row_delavec = mysqli_fetch_assoc($result_delavci)) {
                $selected = ($row_delavec['id_delavec'] == $row['id_delavec']) ? "selected" : "";
                echo "<option value='" . $row_delavec['id_delavec'] . "' " . $selected . ">" . $row_delavec['ime'] . "</option>";
            }
            echo "</select>";

            // Fetching project names for the dropdown list
            $sql_projekti = "SELECT id_projekt, naziv FROM projekt";
            $result_projekti = mysqli_query($conn, $sql_projekti);
            echo "<select name='idProjekt' class='form-select'>";
            while ($row_projekt = mysqli_fetch_assoc($result_projekti)) {
                $selected = ($row_projekt['id_projekt'] == $row['id_projekt']) ? "selected" : "";
                echo "<option value='" . $row_projekt['id_projekt'] . "' " . $selected . ">" . $row_projekt['naziv'] . "</option>";
            }
            echo "</select>";

            echo "<input type='text' name='funkcija' value='" . $row["funkcija"] . "' class='form-input'> 
                  <input type='datetime-local' name='datumNastopa' value='" . date('Y-m-d\TH:i', strtotime($row["datum_nastopa"])) . "' class='form-input'> 
                  <button type='submit' class='form-button'>Potrdi</button> 
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
