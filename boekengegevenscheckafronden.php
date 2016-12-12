<?php define("toegang", true); ?>
<!DOCTYPE html>
<head>
     <title>Boeken</title>
     <?php include 'head.php'; ?>
</head>
<body>
     <div id="container">
          <?php include 'header.php'; ?>
          <div id="content">
               <div id="contentwrapper">
                    <p>
                         <?php
                         if (isset($_POST["afronden"])) {
                              extract($_SESSION["klantGegevens"]);

                              $adres = ($straat1 . " " . $huisnummer1);

                              date_default_timezone_set("Europe/Amsterdam");
                              $weekjaar = date('Wy');

                              try {
                                   $pdo = newPDO();
                                   $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                                   $pdo->beginTransaction();

                                   $stmt1 = $pdo->prepare("INSERT INTO boeking (aantalPersonen, vervoerHeen, vervoerTerug, locatie, opmerking) VALUES (?, ?, ?, ?, ?)");
                                   $stmt1->execute(array($aantalPersonen, $vervoerHeen, $vervoerTerug, $locatie, $opmerkingen));

                                   $stmt2 = $pdo->prepare("SELECT max(idKlant) FROM boeking");
                                   $stmt2->execute(array());
                                   $row = $stmt2->fetch();
                                   $idKlant = $row["max(idKlant)"];

                                   for ($i = 1; $i <= $_SESSION["klantGegevens"]["aantalPersonen"]; $i++) {
                                        $adres = (${"straat" . $i} . " " . ${"huisnummer" . $i});
                                        $stmt3 = $pdo->prepare("INSERT INTO klantgegevens (idklant, persoon, voornaam, achternaam, adres, postcode, woonplaats, land, gebdatum, telefoonnummer, email) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                                        $stmt3->execute(array($idKlant, $i, ${"voornaam" . $i}, ${"achternaam" . $i}, $adres, ${"postcode" . $i}, ${"woonplaats" . $i}, ${"land" . $i}, ${"geboortedatum" . $i}, ${"telefoonnummer" . $i}, ${"email" . $i}));

                                   }

                                   $stmt4 = $pdo->prepare("INSERT INTO reis (idklant, vakantienaam, weekjaar) VALUES (?, ?, ?)");
                                   $stmt4->execute(array($idKlant, $vakantienaam, $weekjaar));

                                   $pdo->commit();
                                   $pdo = NULL;

                                   ?>Uw boeking is succesvol verwerkt.<br>U kunt <a href="login.php">hier</a> uw reisinformatie inzien met uw zelf ingevoerde vakantienaam en weeknummer: <?php
                                   print($weekjaar . ".");

                              } catch (Exception $e) {
                                   print("Uw boeking is niet succesvol verwerkt. Neem contact op met de beheerder.");
                              }
                         }
                         ?>
                    </p>
               </div>
          </div>
          <?php include "footer.php";?>
     </div>
</body>
</html>
