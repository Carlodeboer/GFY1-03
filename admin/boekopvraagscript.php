<html>
<head>
     <title>Boekinggegevens</title>
</head>
<body>
     <div id="container">
          <div id="contentwrapper">
               <?php
               if (isset($_GET['boekingID'])) {
                    $boekingID = $_GET['boekingID']; //maakt een variabele van het ID van de klant
                    //(dat is hier boekingID genoemd, omdat het om de boeking gaat)

                    $pdo = newPDO();
                    $stmt1 = $pdo->prepare("SELECT idKlant, status, betaling
                    FROM boeking
                    WHERE idKlant=?"); //haalt de gegevens op van het ID, de status en de betaling
                    $stmt1->execute(array($boekingID));
                    $row1=$stmt1->fetch();
                    $klantID= $row1["idKlant"];
                    $status = $row1["status"];
                    $betaling = $row1["betaling"]; //maakt variabelen van de gegevens uit de database

                    if (isset($_GET["bevestigen"])) {
                         $stmt2 = $pdo->prepare("UPDATE boeking
                         SET status='Bevestigd'
                         WHERE idKlant=?"); //wanneer op de knop 'bevestigen' wordt geklikt, wordt de boeking bevestigd in de database
                         $stmt2->execute(array($klantID));
                         ?>
                         <script>
                         function popUpBevestigd() {
                              $("#bevestigd").snackbar("show");
                         }
                         </script>
                         <span data-toggle=snackbar id="bevestigd" data-content="De boeking is bevestigd."></span>
                         <script>window.onload = popUpBevestigd;</script>
                         <?php
                    }

                    if (isset($_GET["betaald"])) {
                         $stmt3 = $pdo->prepare("UPDATE boeking
                         SET betaling='Betaald'
                         WHERE idKlant=?"); //wanneer op de knop 'betalen' wordt geklikt, staat in de database dat de boeking is betaald
                         $stmt3->execute(array($klantID));
                         ?>
                         <script>
                         function popUpBetaald() {
                              $("#betaald").snackbar("show");
                         }
                         </script>
                         <span data-toggle=snackbar id="betaald" data-content="De boeking is betaald."></span>
                         <script>window.onload = popUpBetaald;</script>
                         <?php
                    }

                    $stmt4 = $pdo->prepare("SELECT gebruikersnaam, begindatum, einddatum, aantalPersonen,
                    vervoerHeen, vervoerTerug, locatie, opmerking, status, betaling
                    FROM boeking
                    JOIN gebruikers
                    ON idKlant=idGebruiker
                    WHERE idklant = ?"); //haalt de gegevens uit de database
                    //opnieuw worden de status en betaling uit de database gehaald,
                    //omdat deze gegevens nu misschien veranderd zijn (door de knop 'bevestigen' en 'betalen')
                    //er wordt gebruikgemaakt van een JOIN, omdat de vakantienaam ('gebruikersnaam') ook in de tabel komt
                    $stmt4->execute(array($boekingID));
                    $row4 = $stmt4->fetch();

                    $gebruikersnaam= $row4["gebruikersnaam"];
                    $begindatum = $row4["begindatum"];
                    $einddatum = $row4["einddatum"];
                    $aantalPersonen = $row4["aantalPersonen"];
                    $vervoerHeen = $row4["vervoerHeen"];
                    $vervoerTerug = $row4["vervoerTerug"];
                    $locatie = $row4["locatie"];
                    $opmerking = $row4["opmerking"];
                    $status = $row4["status"];
                    $betaling = $row4["betaling"]; //maakt variabelen van de gegevens uit de database

                    ?>
                    <div id="centercontent">
                         <div id="reisgegevens">
                              <h2>Reisgegevens van <?php print($gebruikersnaam); ?>:</h2>
                              <table>
                                   <!-- in deze tabel komen de reisgegevens te staan -->
                                   <tr>
                                        <td>Vakantienaam:</td>
                                        <td><?php print($gebruikersnaam); ?></td>
                                   </tr><tr>
                                        <td>KlantID:</td>
                                        <td><?php print($klantID); ?></td>
                                   </tr><tr>
                                        <td>Begindatum:</td>
                                        <td><?php print($begindatum); ?></td>
                                   </tr><tr>
                                        <td>Einddatum:</td>
                                        <td><?php print($einddatum); ?></td>
                                   </tr><tr>
                                        <td>Aantal personen:</td>
                                        <td><?php print ($aantalPersonen) ?></td>
                                   </tr><tr>
                                        <td>Vervoer van luchthaven Lissabon:</td>
                                        <td><?php
                                        if ($vervoerHeen) {
                                             print("Ja");
                                        } else {
                                             print("Nee");
                                        } //als het vervoer 1 is, staat er 'ja' en als het 0 is, staat er 'nee'
                                        ?></td>
                                   </tr><tr>
                                        <td>Vervoer naar luchthaven Lissabon:</td>
                                        <td><?php
                                        if ($vervoerTerug) {
                                             print("Ja");
                                        } else {
                                             print("Nee");
                                        } //als het vervoer 1 is, staat er 'ja' en als het 0 is, staat er 'nee'
                                        ?></td>
                                   </tr><tr>
                                        <td>Locatie van overnachting:</td>
                                        <td><?php
                                        print (ucfirst($locatie));
                                        ?></td>
                                   </tr>
                                   <?php
                                   if ($opmerking != NULL) {
                                        print ("<tr><td>Opmerkingen:</td><td>" . $opmerking . "</td></tr>");
                                   }
                                   ?>
                                   <tr>
                                        <td>Status:</td>
                                        <td><?php
                                        if ($status=="Niet bevestigd") {
                                             print("<b>" . $status . "<b>");
                                        } else {
                                             print($status);
                                        } //status is dikgedrukt als hij niet bevestigd is
                                        ?></td>
                                   </tr><tr>
                                        <td>Betaald:</td>
                                        <td><?php
                                        if ($betaling=="Niet betaald") {
                                             print("<b>" . $betaling . "<b>");
                                        } else {
                                             print($betaling);
                                        } //betaling is dikgedrukt als hij niet bevestigd is
                                        ?></td>
                                   </tr>
                              </table>
                              <form method='GET' action='beheerpaneel.php'>
                                   <input type='hidden' name='beheer' value='Boekingenopvragen'>
                                   <input type='hidden' name='boekingID' value="<?php print($boekingID);?>">
                                   <?php
                                   if ($status=="Niet bevestigd") {
                                        print("<input type='submit' name='bevestigen' value='Bevestigen' class='btn btn-raised btn-primary'>");

                                   } //als de boeking nog niet bevestigd is, is er een knop waarmee de boeking wel wordt bevestigd

                                   if($betaling=="Niet betaald") {
                                        print("<input type='submit' name='betaald' value='Betaald' class='btn btn-raised btn-primary'>");
                                   } //als de boeking nog niet betaald is, is er een knop waarmee
                                   //de boeking wel als betaald kan worden weergegeven
                                   ?>
                              </form>
                         </div>

                         <div id="reispersonen">
                              <h2>Persoonlijke gegevens:</h2>
                              <table>
                                   <!-- in deze tabel komen de persoonlijke gegevens -->
                                   <?php
                                   for ($i = 1; $i <= $aantalPersonen; $i++) {
                                        $stmt5 = $pdo->prepare("SELECT voornaam, achternaam, gebdatum, adres,
                                        postcode, woonplaats, land, telefoonnummer, email
                                        FROM klantgegevens
                                        WHERE idklant = ?
                                        AND persoon = ?"); //haalt de persoonlijke gegevens op uit de database
                                        $stmt5->execute(array($boekingID, $i));

                                        $row5 = $stmt5->fetch();
                                        $voornaam = $row5["voornaam"];
                                        $achternaam = $row5["achternaam"];
                                        $geboortedatum = $row5["gebdatum"];
                                        $adres = $row5["adres"];
                                        $postcode = $row5["postcode"];
                                        $woonplaats = $row5["woonplaats"];
                                        $land = $row5["land"];
                                        $telefoonnummer = $row5["telefoonnummer"];
                                        $email = $row5["email"]; //maakt variabelen van de gegevens uit de database
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
                                             <td><?php print(ucwords($adres)); ?></td>
                                        </tr><tr>
                                             <td>Postcode:</td>
                                             <td><?php print($postcode); ?></td>
                                        </tr><tr>
                                             <td>Woonplaats:</td>
                                             <td><?php print(ucwords($woonplaats)); ?></td>
                                        </tr><tr>
                                             <td>Land:</td>
                                             <td><?php print(ucwords($land)); ?></td>
                                        </tr><tr>
                                             <td>Geboortedatum:</td>
                                             <td><?php print($geboortedatum); ?></td>
                                        </tr><tr>
                                             <td>Telefoonnummer:</td>
                                             <td><?php print($telefoonnummer); ?></td>
                                        </tr><tr>
                                             <td>Emailadres:</td>
                                             <td><?php print(strtolower($email)); ?></td>
                                        </tr>
                                        <?php
                                   }
                                   ?>
                              </table>
                         </div>
                    </div>
                    <?php
                    $pdo = NULL;
               }
               ?>
          </div>
     </div>

</body>
</html>
