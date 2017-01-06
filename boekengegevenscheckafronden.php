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

                              date_default_timezone_set("Europe/Amsterdam");
                              $datum = strtotime($begindatum);
                              $weekjaar = date('Wy', $datum);

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

                                   $stmt3 = $pdo->prepare("INSERT INTO boeking (idReservering, begindatum, einddatum, aantalPersonen, vervoerHeen, vervoerTerug, opmerking) VALUES (?, ?, ?, ?, ?, ?, ?)");
                                   $stmt3->execute(array($idReservering, $begindatum, $einddatum, $aantalPersonen, $vervoerHeen, $vervoerTerug, $opmerkingen));

                                   $stmt4 = $pdo->prepare("SELECT max(idKlant) FROM boeking");
                                   $stmt4->execute(array());
                                   $row4 = $stmt4->fetch();
                                   $idKlant = $row4["max(idKlant)"];

                                   for ($i = 1; $i <= $_SESSION["klantGegevens"]["aantalPersonen"]; $i++) {
                                        $adres = (${"straat" . $i} . " " . ${"huisnummer" . $i});
                                        $stmt5 = $pdo->prepare("INSERT INTO klantgegevens (idklant, persoon, voornaam, achternaam, adres, postcode, woonplaats, land, gebdatum, telefoonnummer, email, kledingmaat, schoenmaat, bijzonderheden) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                                        $stmt5->execute(array($idKlant, $i, ${"voornaam" . $i}, ${"achternaam" . $i}, $adres, ${"postcode" . $i}, ${"woonplaats" . $i}, ${"land" . $i}, ${"geboortedatum" . $i}, ${"telefoonnummer" . $i},
                                        ${"email" . $i}, ${"kledingmaat" . $i}, ${"schoenmaat" . $i}, ${"bijzonderheden" . $i}));
                                   }

                                   $stmt6 = $pdo->prepare("INSERT INTO gebruikers (idGebruiker, gebruikersnaam, wachtwoord, privilegeniveau) VALUES (?, ?, ?, 1)");
                                   $stmt6->execute(array($idKlant, $vakantienaam, $weekjaar));

                                   $pdo->commit();
                                   $pdo = NULL;

                                   ?>Uw boeking is succesvol verwerkt.<br>U kunt <a href="login.php">hier</a>
                                   uw reisinformatie inzien met uw zelf ingevoerde vakantienaam <?php
                                   print("<b>" . $vakantienaam . "</b>");?> en weeknummer: <?php
                                   print("<b>" . $weekjaar . "</b>.");

                                   //      $stmt10 = $pdo->prepare("SELECT voornaam, achternaam, gebdatum, adres, postcode, woonplaats, land, telefoonnummer, email FROM klantgegevens WHERE idklant = ? AND persoon = ?");
                                   //     $stmt10->execute(array($idklant, $i));
                                   //
                                   //     $row10= $stmt10->fetch();
                                   //     $voornaam = $row10["voornaam"];
                                   //     $achternaam = $row10["achternaam"];
                                   //     $geboortedatum = $row10["gebdatum"];
                                   //     $adres = $row10["adres"];
                                   //     $postcode = $row10["postcode"];
                                   //     $woonplaats = $row10["woonplaats"];
                                   //     $land = $row10["land"];
                                   //     $telefoonnummer = $row10["telefoonnummer"];
                                   //     $email = $row10["email"];
                                   //
                                   //
                                   //     $stmt11 = $pdo->prepare("SELECT idKlant, idReservering, begindatum, einddatum, aantalPersonen, vervoerHeen, vervoerTerug, opmerking, status, betaling FROM boeking WHERE idklant = ? AND persoon = ?");
                                   //     $stmt11->execute(array($idklant, $i));
                                   //
                                   //     $row11= $stmt11->fetch();
                                   //     $klantid = $row11["idKlant"];
                                   //     $reserveringid = $row11["idReservering"];
                                   //     $begindatum1 = $row11["begindatum"];
                                   //     $einddatum1 = $row11["einddatum"];
                                   //     $personenaantal = $row11["aantalPersonen"];
                                   //     $heenvervoer = $row11["vervoerHeen"];
                                   //     $terugvervoer = $row11["vervoerTerug"];
                                   //     $merkingop = $row11["opmerking"];
                                   //     $state = $row11["status"];
                                   //     $payment = $row11["betaling"];
                                   //
                                   //
                                   //     $stmt12 = $pdo->prepare("SELECT gebruikersnaam, wachtwoord FROM gebruikers WHERE idGebruiker = ?");
                                   //     $stmt12->execute(array($idGebruiker));
                                   //     $row12 = $stmt12->fetch();
                                   //     $gebruikersnaam1 = $row12["gebruikersnaam"];
                                   //     $wachtwoord1 = $row12["wachtwoord"];
                                   //
                                   //     $Name = "Offroad Compass Portugal"; //senders name
                                   //     $email = "info@offroadcompassportugal.nl"; //senders e-mail adress
                                   //     $recipient = $email; //recipient
                                   //
                                   //     $mail_body = " hallo
                                   //     $voornaam
                                   //     $achternaam <br>
                                   //     $geboortedatum "; //mail body
                                   //
                                   //     $subject = "Booking"; //subject
                                   //     $header = "From: ". "offroadcompassportugal" . " <" . "info@offroadcompassportugal.nl" . ">\r\n"; //optional headerfields
                                   //
                                   //     mail($recipient, $subject, $mail_body, $header); //mail command :)
                                   
                                   for($i = 1; $i <= $aantalPersonen; $i++) {
                                        //$email_to = ${"email" . $i};
                                        $email_to = "sophie@famroos.nu";
                                        $email_from = "info@offroadcompassportugal.nl";
                                        $email_subject = "Bericht verstuurd via contactformulier";
                                        $email_message = "Beste " . ${"naam" . $i} . "\n\n";

                                        $email_message .= "Bedankt voor het boeken van reis met Offroad Compass Portugal. Hieronder vind u uw ingevulde gegevens:\n\n";

                                        $email_message .= "Vakantienaam:" . $vakantienaam . "\n";
                                        $email_message .= "Vakantieweek:" . $weekjaar . "\n";
                                        $email_message .= "Begindatum:" . $begindatum . "\n";
                                        $email_message .= "Einddatum:" . $einddatum . "\n";
                                        $email_message .= "Vervoer van luchthaven Lissabon:" . $vervoerHeen . "\n";
                                        $email_message .= "Vervoer naar luchthaven Lissabon:" . $vervoerTerug . "\n";
                                        $email_message .= "Aantal personen:" . $aantalPersonen . "\n";
                                        if ($opmerkingen != NULL) {
                                             $email_message .= "Opmerkingen:" . $opmerkingen . "\n";
                                        }

                                        $email_message .= "Naam:" . ${"voornaam" . $i} . " " . ${"voornaam" . $i}"\n";
                                        $email_message .= "Adres:" . ${"straat" . $i} . " " . ${"huisnummer" . $i} . "\n";
                                        $email_message .= "Postcode:" . ${"postcode" . $i} . "\n";
                                        $email_message .= "Woonplaats:" . ${"woonplaats" . $i} . "\n";
                                        $email_message .= "Land:" . ${"land" . $i} . "\n";
                                        $email_message .= "Telefoonnummer:" . ${"telefoonnummer" . $i} . "\n";
                                        $email_message .= "Email:" . ${"email" . $i} . "\n";
                                        $email_message .= "Kledingmaat:" . ${"kledingmaat" . $i} . "\n";
                                        $email_message .= "Schoenmaat:" . ${"schoenmaat" . $i} . "\n";
                                        if (${"Bijzonderheden" . $i} != NULL) {
                                             $email_message .= "Bijzonderheden:" . ${"Bijzonderheden" . $i} . "\n";
                                        }

                                        $email_message .= "\n\nVoor eventuele vragen kunt u contact opnemen via het contactformulier\n\n";
                                        $email_message .= "Met vriendelijke groet,\nMichael Mairhofer\nOffroad Compass Portugal";

                                        $headers = 'From: '.$email_from."\r\n".

                                        'Reply-To: '.$email_from."\r\n" .

                                        'X-Mailer: PHP/' . phpversion();

                                        //versturen van de mail
                                        @mail($email_to, $email_subject, $email_message, $headers);
                                   }

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
