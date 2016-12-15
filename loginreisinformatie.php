<?php define("toegang", true); ?>
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

                         if ($stmt1->rowCount() >= 1) {
                              $stmt2 = $pdo->prepare("SELECT max(idklant) AS idklant FROM reis WHERE weekjaar = ? AND vakantienaam = ?");
                              $stmt2->execute(array($weekJaar, $naam));
                              $row2 = $stmt1->fetch();
                              $idklant = $row2["idklant"];

                              $stmt3 = $pdo->prepare("SELECT begindatum, einddatum, aantalPersonen, vervoerHeen, vervoerTerug, locatie, opmerking, status, betaling FROM boeking WHERE idklant = ?");
                              $stmt3->execute(array($idklant));
                              $row3 = $stmt3->fetch();

                              $begindatum = $row3["begindatum"];
                              $einddatum = $row3["einddatum"];
                              $aantalPersonen = $row3["aantalPersonen"];
                              $vervoerHeen = $row3["vervoerHeen"];
                              $vervoerTerug = $row3["vervoerTerug"];
                              $locatie = $row3["locatie"];
                              $opmerking = $row3["opmerking"];
                              $status = $row3["status"];
                              $betaling = $row3["betaling"];

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
                                        <td><?php print($status);?></td>
                                   </tr><tr>
                                        <td>Betaald:</td>

                                   </tr>
                              </table>
                              <h2>Persoonlijke gegevens:</h2>
                              <table>
                                   <?php
                                   for ($i = 1; $i <= $aantalPersonen; $i++) {
                                        $stmt4 = $pdo->prepare("SELECT voornaam, achternaam, gebdatum, adres, postcode, woonplaats, land, telefoonnummer, email FROM klantgegevens WHERE idklant = ? AND persoon = ?");
                                        $stmt4->execute(array($idklant, $i));

                                        $row4= $stmt4->fetch();
                                        $voornaam = $row4["voornaam"];
                                        $achternaam = $row4["achternaam"];
                                        $geboortedatum = $row4["gebdatum"];
                                        $adres = $row4["adres"];
                                        $postcode = $row4["postcode"];
                                        $woonplaats = $row4["woonplaats"];
                                        $land = $row4["land"];
                                        $telefoonnummer = $row4["telefoonnummer"];
                                        $email = $row4["email"];
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
                                             <td>Telefoonnummer:</td>
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
