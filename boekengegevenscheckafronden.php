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
                    $pdo->beginTransaction();
                    $stmt1 = $pdo->prepare("INSERT INTO boeking (aantalPersonen, vervoerHeen, vervoerTerug, locatie, opmerking) VALUES (?, ?, ?, ?, ?)");
                    $stmt2->execute(array($aantalPersonen, $vervoerHeen, $vervoerTerug, $locatie, $opmerkingen));
                    $stmt2 = $pdo->prepare("SELECT max(idKlant) FROM boeking;");
                    $stmt2->execute(array());
                    $row = $stmt2->fetch();
                    $idKlant = row["idKlant"];
                    $stmt3 = $pdo->prepare("INSERT INTO klantgegevens ");
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
