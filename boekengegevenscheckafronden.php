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

                                   ?>Uw boeking is succesvol verwerkt.<br>U kunt <a href="login.php">hier</a>
                                   uw reisinformatie inzien met uw zelf ingevoerde vakantienaam <?php
                                   print("<b>" . $vakantienaam . "</b>");?> en weeknummer: <?php
                                   print("<b>" . $weekjaar . "</b>.");

                                   $stmt10 = $pdo->prepare("SELECT voornaam, achternaam, gebdatum, adres, postcode, woonplaats, land, telefoonnummer, email FROM klantgegevens WHERE idklant = ? AND persoon = ?");
                                  $stmt10->execute(array($idklant, $i));

                                  $row10= $stmt10->fetch();
                                  $voornaam = $row10["voornaam"];
                                  $achternaam = $row10["achternaam"];
                                  $geboortedatum = $row10["gebdatum"];
                                  $adres = $row10["adres"];
                                  $postcode = $row10["postcode"];
                                  $woonplaats = $row10["woonplaats"];
                                  $land = $row10["land"];
                                  $telefoonnummer = $row10["telefoonnummer"];
                                  $email = $row10["email"];


                                  $stmt11 = $pdo->prepare("SELECT idKlant, idReservering, begindatum, einddatum, aantalPersonen, vervoerHeen, vervoerTerug, locatie, opmerking, status, betaling FROM boeking WHERE idklant = ? AND persoon = ?");
                                  $stmt11->execute(array($idklant, $i));

                                  $row11= $stmt11->fetch();
                                  $klantid = $row11["idKlant"];
                                  $reserveringid = $row11["idReservering"];
                                  $begindatum1 = $row11["begindatum"];
                                  $einddatum1 = $row11["einddatum"];
                                  $personenaantal = $row11["aantalPersonen"];
                                  $heenvervoer = $row11["vervoerHeen"];
                                  $terugvervoer = $row11["vervoerTerug"];
                                  $plaats = $row11["locatie"];
                                  $merkingop = $row11["opmerking"];
                                  $state = $row11["status"];
                                  $payment = $row11["betaling"];


                                  $stmt12 = $pdo->prepare("SELECT gebruikersnaam, wachtwoord FROM gebruikers WHERE idGebruiker = ?");
                                  $stmt12->execute(array($idGebruiker));
                                  $row12 = $stmt12->fetch();
                                  $gebruikersnaam1 = $row12["gebruikersnaam"];
                                  $wachtwoord1 = $row12["wachtwoord"];

                                  $Name = "Offroad Compass Portugal"; //senders name
                                  $email = "info@offroadcompassportugal.nl"; //senders e-mail adress
                                  $recipient = "$email"; //recipient

                                  $mail_body = "
                                  $voornaam
                                  $achternaam <br>
                                  $geboortedatum "; //mail body

                                  $subject = "Booking"; //subject
                                  $header = "From: ". "offroadcompassportugal" . " <" . "info@offroadcompassportugal.nl" . ">\r\n"; //optional headerfields

                                  mail($recipient, $subject, $mail_body, $header); //mail command :)

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
