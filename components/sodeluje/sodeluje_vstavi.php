<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seminarska vstavi</title>
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="../style_menu.css">
</head>

<body>
    <?php
    include("../head.php");
    ?>

    <div class="formCont">
        <form action="sodeluje_vstavi.php" method="post">
            <div class="forminner">
                <?php
                include "../common_var.php";

                // Fetching worker names for the dropdown list
                $conn = mysqli_connect($servername, $username, $password, $dbname);
                mysqli_query($conn, "set names 'utf8'");
                $sql_delavci = "SELECT id_delavec, ime FROM delavec";
                $result_delavci = mysqli_query($conn, $sql_delavci);

                echo "<select name='idDelavca' class='form-select'>";
                while ($row_delavec = mysqli_fetch_assoc($result_delavci)) {
                    echo "<option value='" . $row_delavec['id_delavec'] . "'>" . $row_delavec['ime'] . "</option>";
                }
                echo "</select>";

                // Fetching project names for the dropdown list
                $sql_projekti = "SELECT id_projekt, naziv FROM projekt";
                $result_projekti = mysqli_query($conn, $sql_projekti);

                echo "<select name='idProjekta' class='form-select'>";
                while ($row_projekt = mysqli_fetch_assoc($result_projekti)) {
                    echo "<option value='" . $row_projekt['id_projekt'] . "'>" . $row_projekt['naziv'] . "</option>";
                }
                echo "</select>";

                mysqli_close($conn);
                ?>

                <input type="text" placeholder="Funkcija" name="funkcija" id="funkcija">
                <input type="datetime-local" name="datumNastopa" id="datumNastopa">
                <input type="submit" value="Pošlji">
            </div>
        </form>
    </div>

    <?php
    include "../common_var.php";

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if ($_POST["idProjekta"] !== "" && $_POST["idDelavca"] !== "" && $_POST["funkcija"] !== "" && $_POST["datumNastopa"] !== "") {
            $conn = mysqli_connect($servername, $username, $password, $dbname);
            mysqli_query($conn, "set names 'utf8'");

            $idProjekta = $_POST["idProjekta"];
            $idDelavca = $_POST["idDelavca"];
            $funkcija = $_POST["funkcija"];
            $datumNastopa = $_POST["datumNastopa"];

            $sql = "INSERT INTO sodeluje (id_projekt, id_delavec, funkcija, datum_nastopa) VALUES ($idProjekta, $idDelavca, '$funkcija', '$datumNastopa')";

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
