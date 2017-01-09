<?php
/*******************************************************************************
* Copyright (c) 2017 Carlo de Boer, Floris de Grip, Thijs Marschalk,
* Ralphine de Roo, Sophie Roos and Ian Vredenburg
*
* This Source Code Form is subject to the terms of the MIT license.
* If a copy of the MIT license was not distributed with this file. You can
* obtain one at https://opensource.org/licenses/MIT
*******************************************************************************/
?>
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
                    // Als er op verzenden geklikt is, wordt het volgende uitgevoerd.
                    if (isset($_POST["verzenden"])) {
                         $labels = reisinformatieTaal();
                         $j=0;
                         $weekJaar = $_POST["vakantieweek"];
                         $naam = $_POST["vakantienaam"];
                         // Nieuwe verbinding.
                         $pdo = newPDO();
                         // Checken of de ingevulde gegevens correct zijn, haalt gelijk 'idGebruiker' op.
                         $stmt1 = $pdo->prepare("SELECT idGebruiker FROM gebruikers WHERE wachtwoord = ? AND gebruikersnaam = ?");
                         $stmt1->execute(array($weekJaar, $naam));
                         // ALs er een resultaat uit komt, gaat hij verder:
                         if ($stmt1->rowCount() == 1) {
                              $stmt2 = $pdo->prepare("SELECT idGebruiker FROM gebruikers WHERE wachtwoord = ? AND gebruikersnaam = ?");
                              $stmt2->execute(array($weekJaar, $naam));
                              $row2 = $stmt1->fetch();
                              $idklant = $row2["idGebruiker"];
                              // Reisgegevens ophalen voor klant.
                              $stmt3 = $pdo->prepare("SELECT begindatum, einddatum, aantalPersonen, vervoerHeen, vervoerTerug, opmerking, status, betaling FROM boeking WHERE idklant = ?");
                              $stmt3->execute(array($idklant));
                              $row3 = $stmt3->fetch();
                              // Voor het gemakt variabelen aanmaken.
                              $begindatum = $row3["begindatum"];
                              $einddatum = $row3["einddatum"];
                              $aantalPersonen = $row3["aantalPersonen"];
                              $vervoerHeen = $row3["vervoerHeen"];
                              $vervoerTerug = $row3["vervoerTerug"];
                              $opmerking = $row3["opmerking"];
                              $status = $row3["status"];
                              $betaling = $row3["betaling"];
                              // Weeknummer is altijd de eerste twee cijfers van het meegegeven weeknummer.
                              $week = substr($weekJaar, 0, 2);
                              // Reisgegevens printen.
                              ?>

                              <h1><?php print($labels[$j]); $j++; ?><?php print($naam);?><?php print($labels[$j]); $j++; ?><?php print($week);?></h1>
                              <h2><?php print($labels[$j]); $j++; ?>:</h2>
                              <table class="table table-striped table-hover personentabel">
                                   <tr>
                                        <td><?php print($labels[$j]); $j++; ?>:</td>
                                        <td><?php print($begindatum); ?></td>
                                   </tr><tr>
                                        <td><?php print($labels[$j]); $j++; ?>:</td>
                                        <td><?php print($einddatum); ?></td>
                                   </tr><tr>
                                        <td><?php print($labels[$j]); $j++; ?>:</td>
                                        <td><?php print ($aantalPersonen) ?></td>
                                   </tr><tr>
                                        <td><?php print($labels[$j]); $j++; ?>:</td>
                                        <td>
                                             <?php
                                             if ($vervoerHeen) {
                                                  print($labels[$j]);
                                                  $j++;
                                             } else {
                                                  $j++;
                                                  print($labels[$j]);
                                             }
                                             $j++
                                             ?>
                                        </td>
                                   </tr><tr>
                                        <td><?php print($labels[$j]); $j++; ?>:</td>
                                        <td>
                                             <?php
                                             if ($vervoerTerug) {
                                                  print($labels[$j]);
                                                  $j++;
                                             } else {
                                                  $j++;
                                                  print($labels[$j]);
                                             }
                                             $j++;
                                             ?>
                                        </td>
                                   </tr>
                                   <?php
                                   // Geeft alleen 'opmerkingen' weer wanneer ingevuld.
                                   if ($opmerking != NULL) {
                                        print ("<tr><td>" . $labels[$j] . ":</td><td>" . $opmerking . "</td></tr>");
                                   }
                                   $j++;
                                   // ALs reis niet bevestigd is of de reis niet betaald is, worden de gegevens dikgedrukt.
                                   ?>
                                   <tr>
                                        <td><?php print($labels[$j]); $j++; ?>:</td>
                                        <td><?php
                                        if ($status=="Niet bevestigd") {
                                             print("<b>" . $status . "<b>");
                                        } else {
                                             print($status);
                                        }
                                        ?></td>
                                   </tr><tr>
                                        <td><?php print($labels[$j]); $j++; ?>:</td>
                                        <td><?php
                                        if ($betaling=="Niet betaald") {
                                             print("<b>" . $betaling . "<b>");
                                        } else {
                                             print($betaling);
                                        }
                                        ?></td>
                                   </tr>
                              </table>
                              <h2><?php print($labels[$j]); $j++; ?>:</h2>
                              <table class="table table-striped table-hover personentabel">
                                   <?php
                                   // Voor elk persoon de persoonlijke gegevens ophalen.
                                   for ($i = 1; $i <= $aantalPersonen; $i++) {
                                        $stmt4 = $pdo->prepare("SELECT voornaam, achternaam, gebdatum, adres, postcode, woonplaats, land, telefoonnummer, email, kledingmaat, schoenmaat, bijzonderheden FROM klantgegevens WHERE idklant = ? AND persoon = ?");
                                        $stmt4->execute(array($idklant, $i));
                                        // Voor het gemak weer variabelen.
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
                                        $kledingmaat = $row4["kledingmaat"];
                                        $schoenmaat = $row4["schoenmaat"];
                                        $bijzonderheden = $row4["bijzonderheden"];
                                        // $j terug naar '16' voor het herhalen van labels
                                        $j= 16;
                                        // Kopje "Persoon x" alleen getoond wanneer er meerdere personen mee gaan.
                                        if ($aantalPersonen != 1) {
                                             ?>
                                             <tr>
                                                  <td><br><h3><?php print($labels[$j]); ?> <?php print ($i) ?></h3></td>
                                                  <td></td>
                                             </tr>
                                             <?php
                                        }
                                        $j++;
                                        // Persoonlijke gegevens worden getoond.
                                        ?>
                                        <tr>
                                             <td><?php print($labels[$j]); $j++; ?>:</td>
                                             <td><?php print($voornaam); ?></td>
                                        </tr><tr>
                                             <td><?php print($labels[$j]); $j++; ?>:</td>
                                             <td><?php print($achternaam); ?></td>
                                        </tr><tr>
                                             <td><?php print($labels[$j]); $j++; ?>:</td>
                                             <td><?php print(ucwords($adres)); ?></td>
                                        </tr><tr>
                                             <td><?php print($labels[$j]); $j++; ?>:</td>
                                             <td><?php print($postcode); ?></td>
                                        </tr><tr>
                                             <td><?php print($labels[$j]); $j++; ?>:</td>
                                             <td><?php print(ucwords($woonplaats)); ?></td>
                                        </tr><tr>
                                             <td><?php print($labels[$j]); $j++; ?>:</td>
                                             <td><?php print(ucwords($land)); ?></td>
                                        </tr><tr>
                                             <td><?php print($labels[$j]); $j++; ?>:</td>
                                             <td><?php print($geboortedatum); ?></td>
                                        </tr><tr>
                                             <td><?php print($labels[$j]); $j++; ?>:</td>
                                             <td><?php print($telefoonnummer); ?></td>
                                        </tr><tr>
                                             <td><?php print($labels[$j]); $j++; ?>:</td>
                                             <td><?php print(strtolower($email)); ?></td>
                                        </tr>
                                        <tr>
                                             <td><?php print($labels[$j]); $j++; ?>:</td>
                                             <td><?php print($kledingmaat); ?></td>
                                        </tr>
                                        <tr>
                                             <td><?php print($labels[$j]); $j++; ?>:</td>
                                             <td><?php print($schoenmaat); ?></td>
                                        </tr>
                                        <?php
                                        // Ziekten en allergieen alleen getoond wanneer ingevuld.
                                        if ($bijzonderheden != NULL) {
                                             ?><tr>
                                                  <td><?php print($labels[$j]); $j++; ?>:</td>
                                                  <td><?php print($bijzonderheden); ?></td>
                                             </tr><?php
                                        }
                                   }

                                   ?>
                              </table>
                              <?php
                              $pdo = NULL;
                         }
                         // Bij geen correcte gegevens foutmelding.
                         else {
                              $j = 29;
                              ?><p><?php print($labels[$j]); $j++; ?> <a href=login.php><?php print($labels[$j]);?></a>.</p><?php
                         }
                    }
                    ?>
               </div>
          </div>
          <?php include "footer.php";?>
     </div>
</body>
</html>
