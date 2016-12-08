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
                    extract($_SESSION["klantGegevens"]);
                    print_r($_SESSION["klantGegevens"]);
                    $pdo = newPDO();
                    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                    $stmt1 = $pdo->prepare("INSERT INTO boeking (aantalPersonen, vervoerHeen, vervoerTerug, locatie, opmerking) VALUES (?, ?, ?, ?, ?)");
                    $stmt1->execute(array($aantalPersonen, $vervoerHeen, $vervoerTerug, $locatie, $opmerkingen));

                    $stmt2 = $pdo->prepare("SELECT max(idKlant) FROM boeking");
                    $stmt2->execute(array());
                    $row = $stmt2->fetch();
                    $idKlant = $row["max(idKlant)"];

                    $adres = ($straat1 . " " . $huisnummer1);

                    //$stmt3 = $pdo->prepare("INSERT INTO klantgegevens (idklant, persoon, voornaam, achternaam, adres, postcode, woonplaats, telefoonnummer, email) VALUES ?,?,?,?,?,?,?,?,?");

//                    try {
//                        $stmt3->execute(array($idKlant, "1", $voornaam1, $achternaam1, $adres, $postcode1, $woonplaats1, $telefoonnummer1, $email1));
//                    } catch (PDOException $e) {
//                        
//                    }





                    $stmt3 = $pdo->prepare("INSERT INTO klantgegevens (idklant, persoon, voornaam, achternaam, adres, postcode, woonplaats, telefoonnummer, email) VALUES ?,?,?,?,?,?,?,?,?");
                    $stmt3->execute(array($idKlant, "1", $voornaam1, $achternaam1, $adres, $postcode1, $woonplaats1, $telefoonnummer1, $email1));

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
