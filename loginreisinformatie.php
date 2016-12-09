<!DOCTYPE html>
<html>
<head>
     <meta charset="UTF-8">
     <?php include 'head.php'; ?>
     <title>Reisinformatie</title>
</head>
<body>
     <div id="container">
          <?php
          include 'header.php';
          ?>
          <div id="content">
               <div id="contentwrapper">
                    <?php
                    if (isset($_POST["verzenden"])) {
                         $weekJaar = $_POST["vakantieweek"];
                         $naam = $_POST["vakantienaam"];

                         $pdo = newPDO();
                         $stmt1 = $pdo->prepare("SELECT idklant FROM reis WHERE weekjaar = ? AND vakantienaam = ?");
                         $stmt1->execute(array($weekJaar, $naam));
                         $row = $stmt1->fetch();

                         if ($stmt1->rowCount() == 1) {
                              $idklant = $row["idklant"];

                              $stmt2 = $pdo->prepare("SELECT begindatum, einddatum, aantalPersonen, vervoerHeen, vervoerTerug, locatie, opmerking, status, betaling FROM boeking WHERE idklant = ?");
                              $stmt2->execute(array($idklant));
                              $row = $stmt2->fetch();

                              $begindatum = $row["begindatum"];
                              $einddatum = $row["einddatum"];
                              $aantalPersonen = $row["aantalPersonen"];
                              $vervoerHeen = $row["vervoerHeen"];
                              $vervoerTerug = $row["vervoerTerug"];
                              $locatie = $row["locatie"];
                              $opmerking = $row["opmerking"];
                              $status = $row["status"];
                              $betaling = $row["betaling"];

                              $week = substr($weekJaar, 0, 2);
                              ?>

                              <h1>Reisinfo voor <?php print($naam);?> in week <?php print($week);?></h1>
                              <h2>Reisgegevens:</h2>
                              <table>
                                   <tr>
                                        <td>Begindatum:</td>
                                        <td><?php print($begindatum); ?></td>
                                   </tr><tr>
                                        <td>Einddatum:</td>
                                        <td><?php print($einddatum); ?></td>
                                   </tr><tr>
                                        <td>Aantal personen:</td>
                                        <td><?php print ($aantalPersonen) ?></td>
                                   </tr><tr>
                                        <td>Vervoer van Luchthaven Portela (Lissabon):</td>
                                        <td><?php
                                        if ($vervoerHeen) {
                                             print("Ja");
                                        } else {
                                             print("Nee");
                                        }
                                        ?></td>
                                   </tr><tr>
                                        <td>Vervoer naar Luchthaven Portela (Lissabon):</td>
                                        <td><?php
                                        if ($vervoerTerug) {
                                             print("Ja");
                                        } else {
                                             print("Nee");
                                        }
                                        ?></td>
                                   </tr><tr>
                                        <td>Locatie van overnachting:</td>
                                        <td><?php
                                        print (ucfirst($locatie));
                                        ?></td>
                                   </tr>
                                   <?php
                                   if ($opmerking != NULL) {
                                        print ("<tr><td>Opmerkingen</td><td>" . $opmerking . "</td></tr>");
                                   }
                                   ?>
                                   <tr>
                                        <td>Status:</td>
                                        <td><?php
                                        if ($status != NULL) {
                                             print("Bevestigd");
                                        } else {
                                             print ("Niet bevestigd");
                                        }
                                        ?></td>
                                   </tr><tr>
                                        <td>Betaald:</td>
                                        <td><?php
                                        if ($betaling == 1) {
                                             print("Ja");
                                        } else {
                                             print ("Nee");
                                        }
                                        ?></td>
                                   </tr>
                              </table>
                              <h2>Persoonlijke gegevens:</h2>
                              <table>
                                   <?php
                                   for ($i = 1; $i <= $aantalPersonen; $i++) {
                                        $stmt3 = $pdo->prepare("SELECT voornaam, achternaam, gebdatum, adres, postcode, woonplaats, land, telefoonnummer, email FROM klantgegevens WHERE idklant = ? AND persoon = ?");
                                        $stmt3->execute(array($idklant, $i));

                                        $row = $stmt3->fetch();
                                        $voornaam = $row["voornaam"];
                                        $achternaam = $row["achternaam"];
                                        $geboortedatum = $row["gebdatum"];
                                        $adres = $row["adres"];
                                        $postcode = $row["postcode"];
                                        $woonplaats = $row["woonplaats"];
                                        $land = $row["land"];
                                        $telefoonnummer = $row["telefoonnummer"];
                                        $email = $row["email"];
                                        if ($aantalPersonen != 1) {
                                             ?>
                                             <tr>
                                                  <td><h3>Persoon <?php print ($i) ?></h3></td>
                                             </tr><?php
                                        }
                                        ?>
                                        <tr>
                                             <td>Voornaam:</td>
                                             <td><?php print($voornaam); ?></td>
                                        </tr><tr>
                                             <td>Achternaam:</td>
                                             <td><?php print($achternaam); ?></td>
                                        </tr><tr>
                                             <td>Adres:</td>
                                             <td><?php print($adres); ?></td>
                                        </tr><tr>
                                             <td>Postcode:</td>
                                             <td><?php print($postcode); ?></td>
                                        </tr><tr>
                                             <td>Woonplaats:</td>
                                             <td><?php print($woonplaats); ?></td>
                                        </tr><tr>
                                             <td>Land:</td>
                                             <td><?php print($land); ?></td>
                                        </tr><tr>
                                             <td>Geboortedatum:</td>
                                             <td><?php print($geboortedatum); ?></td>
                                        </tr><tr>
                                             <td>Telefoonnummer</td>
                                             <td><?php print($telefoonnummer); ?></td>
                                        </tr><tr>
                                             <td>Emailadres:</td>
                                             <td><?php print($email); ?></td>
                                        </tr>
                                        <?php
                                   }
                                   ?>
                              </table>
                              <?php
                              $pdo = NULL;
                         }
                         else {
                              ?><p>Onjuiste vakantienaam of vakantieweek. Ga terug naar de <a href=login.php>loginpagina</a>.</p><?php
                         }
                    }
                    ?>
               </div>
          </div>
          <?php include "footer.php";?>
     </div>
</body>
</html>
