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
                if (isset($_GET["afronden"])) {
                    session_start();
                    extract($_SESSION["klantGegevens"]);
                    print_r($_SESSION["klantGegevens"]);

                    $pdo = newPDO();

                    $stmt1 = $pdo->prepare("INSERT INTO boeking (aantalPersonen, vervoerHeen, vervoerTerug, locatie, opmerking) VALUES (?, ?, ?, ?, ?)");
                    $stmt1->execute(array($aantalPersonen, $vervoerHeen, $vervoerTerug, $locatie, $opmerkingen));

                    $stmt2 = $pdo->prepare("SELECT max(idKlant) FROM boeking");
                    $stmt2->execute(array());
                    $row = $stmt2->fetch();
                    $idKlant = $row["max(idKlant)"];

                    $stmt3 = $pdo->prepare("INSERT INTO klantgegevens (idKlant, persoon, voornaam, achternaam, adres, postcode, woonplaats, telefoonnummer, email) VALUES ?,?,?,?,?,?,?,?,?");
                    $stmt3->execute(array($idKlant, "1", $voornaam1, $achternaam1, ($straat1 . $huisnummer1), $postcode1, $woonplaats1, $telefoonnummer1, "Sjaak"));

                    //$res = $stmt->rowCount();
                    $pdo = NULL;

//                    if ($res == 2) {
//                        print("Uw boeking is succesvol verwerkt.");
//                    } else {
//                        print("Uw boeking is niet succesvol verwerkt. Neem contact op met de beheerder.");
//                    }
                }
                ?>
            </div>
        </div>
    </body>
</html>
