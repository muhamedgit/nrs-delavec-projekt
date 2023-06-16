<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../style_menu.css">
    <link rel="stylesheet" href="../style_table.css">
    <title>Seminarska Spremeni</title>
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

        // Preveri, ali je bil obrazec poslan
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $idPodjetja = $_POST['idPodjetja'];
            $naziv = $_POST['naziv'];
            $mesto = $_POST['mesto'];

            // Izvedi poizvedbo UPDATE za posodobitev podatkov
            $sql = "UPDATE podjetje SET naziv = '$naziv', mesto = '$mesto' WHERE id_podjetje = $idPodjetja";
            if (mysqli_query($conn, $sql)) {
                echo "<p class='success'>Sprememba je bila uspešna</p>";
            } else {
                echo "<p class='error'>Sprememb ni bilo mogoče izvesti: " . mysqli_error($conn) . "</p>";
            }
        }

        // Pridobi podatke o podjetjih iz baze podatkov
        $sql = "SELECT * FROM podjetje";
        $result = mysqli_query($conn, $sql);

        if (!mysqli_query($conn, $sql)) {
            echo "Napaka: " . $sql . "<br>" . mysqli_error($conn);
        }

        echo "<table>";
        echo "<tr><th>Id Podjetja</th><th>Naziv Podjetja</th><th>Mesto</th><th class='action'>Akcije</th></tr>";

        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td class='numColumn'>" . $row["id_podjetje"] . "</td>";
            echo "<td>" . $row["naziv"] . "</td>";
            echo "<td>" . $row["mesto"] . "</td>";
            echo "<td class='action'>
                    <form method='post' action='podjetje_spremeni.php' class='form-container'>
                        <input type='hidden' name='idPodjetja' value='" . $row["id_podjetje"] . "'>
                        <input type='text' name='naziv' value='" . $row["naziv"] . "'>
                        <input type='text' name='mesto' value='" . $row["mesto"] . "'>
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
