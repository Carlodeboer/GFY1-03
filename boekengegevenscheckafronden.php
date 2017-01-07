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
                    <?php
                    $labels = boekenTaal4();
                    $j = 0;
                    if (isset($_POST["afronden"])) {
                         // Haalt alle elementen uit array en maakt variablen met als naam de indes en waarde de key.
                         extract($_SESSION["klantGegevens"]);

                         date_default_timezone_set("Europe/Amsterdam");

                         // Weekjaar is het nummer van de week en het nummer van het jaar aan elkaar; wordt gebruikt om in te loggen.
                         $datum = strtotime($begindatum);
                         $weekjaar = date('Wy', $datum);

                         try {
                              // Nieuwe verbinding database
                              $pdo = newPDO();
                              $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                              $pdo->beginTransaction();

                              // Toevoegen aan database
                              $stmt1 = $pdo->prepare("INSERT INTO reserveringen (begindatum, type, aantal) VALUES (?, 'boeking', ?)");
                              $stmt1->execute(array($begindatum, $aantalPersonen));

                              // Ophalen van het maximale id van de reservering zodat hij daarna toegevoegd kan worden bij het volgende statement.
                              $stmt2 = $pdo->prepare("SELECT max(idReservering) FROM reserveringen");
                              $stmt2->execute(array());
                              $row2 = $stmt2->fetch();
                              $idReservering = $row2["max(idReservering)"];

                              $stmt3 = $pdo->prepare("INSERT INTO boeking (idReservering, begindatum, einddatum, aantalPersonen, vervoerHeen, vervoerTerug, opmerking) VALUES (?, ?, ?, ?, ?, ?, ?)");
                              $stmt3->execute(array($idReservering, $begindatum, $einddatum, $aantalPersonen, $vervoerHeen, $vervoerTerug, $opmerkingen));

                              // Ophalen van het maximale id van de klant zodat hij daarna toegevoegd kan worden bij het volgende statement.
                              $stmt4 = $pdo->prepare("SELECT max(idKlant) FROM boeking");
                              $stmt4->execute(array());
                              $row4 = $stmt4->fetch();
                              $idKlant = $row4["max(idKlant)"];

                              // Voor elke persoon die mee gaat per boeking worden apart de klantgegevens opgeslagen.
                              for ($i = 1; $i <= $_SESSION["klantGegevens"]["aantalPersonen"]; $i++) {
                                   $adres = (${"straat" . $i} . " " . ${"huisnummer" . $i});
                                   $stmt5 = $pdo->prepare("INSERT INTO klantgegevens (idklant, persoon, voornaam, achternaam, adres, postcode, woonplaats, land, gebdatum, telefoonnummer, email, kledingmaat, schoenmaat, bijzonderheden) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                                   $stmt5->execute(array($idKlant, $i, ${"voornaam" . $i}, ${"achternaam" . $i}, $adres, ${"postcode" . $i}, ${"woonplaats" . $i}, ${"land" . $i}, ${"geboortedatum" . $i}, ${"telefoonnummer" . $i},
                                   ${"email" . $i}, ${"kledingmaat" . $i}, ${"schoenmaat" . $i}, ${"bijzonderheden" . $i}));
                              }

                              // Account aanmaken zodat er later kan worden ingelogd.
                              $stmt6 = $pdo->prepare("INSERT INTO gebruikers (idGebruiker, gebruikersnaam, wachtwoord, privilegeniveau) VALUES (?, ?, ?, 1)");
                              $stmt6->execute(array($idKlant, $vakantienaam, $weekjaar));

                              $pdo->commit();
                              $pdo = NULL;

                              // Feedback geven aan de gebruiker met linkje naar inlogscherm.
                              print($labels[$j]); $j++; ?><a href="login.php"><?php print($labels[$j]); $j++; ?></a>
                              <?php print($labels[$j]); $j++;
                              print("<strong class='text-primary'>" . $vakantienaam . "</strong>");?><?php print($labels[$j]); $j++; ?><?php
                              print("<strong class='text-primary'>" . $weekjaar . "</strong>.");

                         } catch (Exception $e) {
                              // Als de boeking niet succesvol verwerkt is geeft hij een melding.
                              print("Uw boeking is niet succesvol verwerkt. Neem contact op met de beheerder.");
                         }
                    }
                    ?>
               </div>
          </div>
          <?php include "footer.php";?>
     </div>
</body>
</html>
