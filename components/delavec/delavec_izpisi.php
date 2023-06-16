<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../style_menu.css">
    <link rel="stylesheet" href="../style_table.css">
    <title>Seminarska izpis</title>
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
    
    // Poizvedba, ki izbere podatke o delavcih in povezanem podjetju
    $sql = "SELECT delavec.id_delavec, delavec.ime, delavec.izobrazba, delavec.placa, podjetje.naziv AS naziv_podjetja FROM delavec INNER JOIN podjetje ON delavec.id_podjetje = podjetje.id_podjetje";
    
    $result = mysqli_query($conn, $sql);
    
    // Preverjanje, ali je poizvedba uspela
    if (!mysqli_query($conn, $sql)) {
        echo "Napaka: " . $sql . "<br>" . mysqli_error($conn);
    }
    
    // Izpisovanje tabele s podatki
    echo "<table>";
    echo "<tr><th>Id Delavca</th><th>Ime</th><th>Izobrazba</th><th>Plača</th><th>Naziv Podjetja</th></tr>";
    
    while($row = mysqli_fetch_assoc($result)) {
        echo  "<tr>".
                "<td>" .  $row["id_delavec"] . "</td>" . // Prikaz id-ja delavca
                "<td>" . $row["ime"] . "</td>" . // Prikaz imena delavca
                "<td>" . $row["izobrazba"]. "</td>" . // Prikaz izobrazbe delavca
                "<td>" . $row["placa"] . "</td>". // Prikaz plače delavca
                "<td>".$row["naziv_podjetja"]. "</td>" . // Prikaz naziva povezanega podjetja
                "</tr>";
    }
    echo "</table>";
    
    mysqli_close($conn);
    ?>
</div>
</body>
</html>
