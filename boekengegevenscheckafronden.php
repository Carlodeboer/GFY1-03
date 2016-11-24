<?php
include "functions.php";
?>
<html>
    <head>
        <title>Boeken</title>
        <?php include 'head.php'; ?>
    </head>
    <body>
        <div id="container">
            <?php include 'header.php'; ?>
            <div id="content">
                <?php
                if (isset($_POST["boeken"])) {
                    session_start();
                    extract($_SESSION["klantGegevens"]);
                    print_r($_SESSION["klantGegevens"]);
                    $pdo = newPDO();
                    $stmt = $pdo->prepare("INSERT INTO boeking (aantalPersonen, vervoerHeen, vervoerTerug, locatie, opmerking) VALUES (?, ?, ?, ?, ?)");
                    $stmt->execute(array($aantalPersonen, $vervoerHeen, $vervoerTerug, $locatie, $opmerkingen));
                    //$stmt = $pdo->prepare("SELECT idKlant FROM boeking WHERE aantalPersonen = ? AND vervoerHeen = ? AND vervoerTerug = ? AND locatie = ? AND opmerking = ?");
                    //$stmt->execute(array($aantalPersonen, $vervoerHeen, $vervoerTerug, $locatie, $opmerkingen));
                    
                    $pdo = NULL;
                }
                ?>
            </div>
        </div>
    </body>
</html>
