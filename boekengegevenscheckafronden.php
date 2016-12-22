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

                                   $stmt1 = $pdo->prepare("INSERT INTO reserveringen (begindatum, type, aantal) VALUES (?, 'boeking', ?)");
                                   $stmt1->execute(array($begindatum, $aantalPersonen));

                                   $stmt2 = $pdo->prepare("SELECT max(idReservering) FROM reserveringen");
                                   $stmt2->execute(array());
                                   $row2 = $stmt2->fetch();
                                   $idReservering = $row2["max(idReservering)"];

                                   $stmt3 = $pdo->prepare("INSERT INTO boeking (idReservering, begindatum, einddatum, aantalPersonen, vervoerHeen, vervoerTerug, locatie, opmerking) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
                                   $stmt3->execute(array($idReservering, $begindatum, $einddatum, $aantalPersonen, $vervoerHeen, $vervoerTerug, $locatie, $opmerkingen));

                                   $stmt4 = $pdo->prepare("SELECT max(idKlant) FROM boeking");
                                   $stmt4->execute(array());
                                   $row4 = $stmt4->fetch();
                                   $idKlant = $row4["max(idKlant)"];

                                   for ($i = 1; $i <= $_SESSION["klantGegevens"]["aantalPersonen"]; $i++) {
                                        $adres = (${"straat" . $i} . " " . ${"huisnummer" . $i});
                                        $stmt5 = $pdo->prepare("INSERT INTO klantgegevens (idklant, persoon, voornaam, achternaam, adres, postcode, woonplaats, land, gebdatum, telefoonnummer, email) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                                        $stmt5->execute(array($idKlant, $i, ${"voornaam" . $i}, ${"achternaam" . $i}, $adres, ${"postcode" . $i}, ${"woonplaats" . $i}, ${"land" . $i}, ${"geboortedatum" . $i}, ${"telefoonnummer" . $i}, ${"email" . $i}));

                                   }

                                   $stmt6 = $pdo->prepare("INSERT INTO gebruikers (idGebruiker, gebruikersnaam, wachtwoord, privilegeniveau) VALUES (?, ?, ?, 1)");
                                   $stmt6->execute(array($idKlant, $vakantienaam, $weekjaar));

                                   $pdo->commit();
                                   $pdo = NULL;

                                   ?>Uw boeking is succesvol verwerkt.<br>U kunt <a href="login.php">hier</a> uw reisinformatie inzien met uw zelf ingevoerde vakantienaam en weeknummer: <?php
                                   print($weekjaar . ".");

                                   $email_to = "sophie@famroos.nu";
                                   $email_from = "s1@famroos.nu";
                                   $email_subject = "Bericht verstuurd via contactformulier";
                                   $email_message = "BLOB";
                                   $headers = 'From: '.$email_from."\r\n" . 'Reply-To: '.$email_from."\r\n" . 'X-Mailer: PHP/' . phpversion();
                                   mail($email_to, $email_subject, $email_message, $headers);

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
