<!DOCTYPE html>
<?php
include "functions.php";
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link type="text/css" rel="stylesheet" href="style.css">
    </head>
    <body>
        <?php
        banner();
        if (isset($_GET["verzenden"])) {
            //$begindatum = $_GET["begindatum"];
            //$einddatum = $_GET["einddatum"];
            $vervoerHeen = $_GET["heen"];
            $vervoerTerug = $_GET["terug"];
            $locatie = $_GET["locatie"];
            
            if ($_GET["nieuweLocatie"] != "") {
                $locatie = $_GET["nieuweLocatie"];
            }
            
            $omschrijving = "";
            $opmerkingen = $_GET["opmerkingen"];
            $aantalPersonen = $_GET["aantalPersonen"];
            
            $sql = "INSERT INTO reisinformatie VALUES (?, CURDATE(), CURDATE(), ?, ?, ?, ?, ?, ?)";
            
            $pdo = newPDO();
            $stmt = $pdo->prepare("INSERT INTO reisinformatie VALUES (?, CURDATE(), CURDATE(), ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute(array("", $omschrijving, $opmerkingen, $vervoerHeen, $vervoerTerug, $locatie, $aantalPersonen, "false", "false"));
            $pdo = NULL;
        }
        ?>
    </body>
</html>
