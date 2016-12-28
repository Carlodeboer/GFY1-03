<html>
<head>
     <title>Boekingopvraag</title>

</head>
<body>
     <div id="container">

          <div id="contentwrapper">
               <br><h2>Laat boekingen zien: </h2> <br>
               <?php

               $pdo = newPDO();
               $stmt = $pdo->prepare("SELECT idKlant, gebruikersnaam, begindatum, einddatum, status, betaling
               FROM boeking
               JOIN gebruikers
               ON idKlant=idGebruiker
               ORDER BY begindatum"); //haalt gegevens uit de tabel
               $stmt->execute();
               ?>

               <div class="row">
                    <div class="col-md-6">
                         <table class="table table-striped table-hover nieuwsberichtenbewerken">
                              <tr><th>Vakantienaam</th><th>Begindatum</th><th>Einddatum</th><th>Status</th><th>Betaling</th></tr>

                              <?php


                              while ($boeking = $stmt->fetch()) {
                                   $klantID=$boeking['idKlant'];
                                   $gebruikersnaam=$boeking['gebruikersnaam'];
                                   $begindatum=$boeking['begindatum'];
                                   $einddatum=$boeking['einddatum'];
                                   $status=$boeking['status'];
                                   $betaling=$boeking['betaling']; //maakt variabele van de gegevens

                                   if ($status=="Niet bevestigd") {
                                        $status="<b>" . $status . "<b>";
                                   } else {
                                        $status=$status;
                                   } //status is dikgedrukt als hij niet bevestigd is

                                   if ($betaling=="Niet betaald") {
                                        $betaling="<b>" . $betaling . "<b>";
                                   } else {
                                        $betaling=$betaling;
                                   } //betaling is dikgedrukt als hij niet bevestigd is

                                   echo "<tr onclick=\"location='beheerpaneel.php?beheer=Boekingenopvragen&boekingID={$boeking['idKlant']}'\">

                                   <td>" . $gebruikersnaam . "</td>
                                   <td>" . $begindatum . "</td>
                                   <td>" . $einddatum . "</td>
                                   <td>" . $status . "</td>
                                   <td>" . $betaling . "</td>

                                   </tr>"; //zet de variabelen (gegevens) in een tabel
                              }


                                   ?>

                              </table>
                         </div>
                    </div>
               </div>
          </div>
     </body>
     </html>
