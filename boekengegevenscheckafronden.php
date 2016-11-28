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
                    $pdo = newPDO();
                    $stmt = $pdo->prepare("INSERT INTO boeking (aantalPersonen, vervoerHeen, vervoerTerug, locatie, opmerking) VALUES (?, ?, ?, ?, ?)");
                    $stmt->execute(array($aantalPersonen, $vervoerHeen, $vervoerTerug, $locatie, $opmerkingen));
                    //$stmt = $pdo->prepare("SELECT SCOPE_IDENTITY()");
                    //$stmt->execute(array());
                    //$stmt = $pdo->prepare("SELECT idKlant FROM boeking WHERE aantalPersonen = ? AND vervoerHeen = ? AND vervoerTerug = ? AND locatie = ? AND opmerking = ?");
                    //$stmt->execute(array($aantalPersonen, $vervoerHeen, $vervoerTerug, $locatie, $opmerkingen));

                    $res = $stmt->rowCount();
                    $pdo = NULL;
                    
                    if ($res == 2) {
                        print("Uw boeking is succesvol verwerkt.");
                    } else {
                        print("Uw boeking is niet succesvol verwerkt. Neem contact op met de beheerder.");
                    }
                }
                ?>
            </div>
        </div>
    </body>
</html>
