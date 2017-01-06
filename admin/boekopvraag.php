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
               $stmt = $pdo->prepare("SELECT idKlant, gebruikersnaam, begindatum, einddatum, status, betaling, actief
                    FROM boeking
                    JOIN gebruikers
                    ON idKlant=idGebruiker
                    WHERE actief=1;
                    ORDER BY begindatum"); //haalt gegevens uit de tabel
                    $stmt->execute();
                    ?>

                    <div class="row">
                         <div class="col-md-6">
                              <table class="table table-striped table-hover nieuwsberichtenbewerken">
                                   <tr>
                                        <th>Vakantienaam</th>
                                        <th>Begindatum</th>
                                        <th>Einddatum</th>
                                        <th>Status</th>
                                        <th>Betaling</th>
                                        <th>Annuleren</th>
                                   </tr>


                                   <?php

                                   $pdo = newPDO();
                                   $stmt8 = $pdo->prepare("SELECT idKlant FROM boeking");
                                   $stmt8->execute(array($boekingID));
                                   $row8=$stmt8->fetch();
                                   $klantID= $row8["idKlant"];
                                   //maakt variabelen van de gegevens uit de database

                                   if (isset($_POST["annuleren"])) {
                                        $stmt2 = $pdo->prepare("UPDATE boeking SET actief=0 WHERE idKlant=?");
                                        $stmt2->execute(array($klantID));
                                        ?>
                                        <script>
                                        function popUpBevestigd() {
                                             $("#bevestigd").snackbar("show");
                                        }
                                        </script>
                                        <span data-toggle=snackbar id="bevestigd" data-content="De boeking is geannuleerd."></span>
                                        <script>window.onload = popUpBevestigd;</script>
                                        <?php
                                   }

                                   while ($boeking = $stmt->fetch()) {
                                        $klantID=$boeking['idKlant'];
                                        $gebruikersnaam=$boeking['gebruikersnaam'];
                                        $begindatum=$boeking['begindatum'];
                                        $einddatum=$boeking['einddatum'];
                                        $status=$boeking['status'];
                                        $betaling=$boeking['betaling'];
                                        $actief=$boeking['actief']; //maakt variabele van de gegevens


                                        if (isset($_POST["annuleren"])) {
                                             $stmt2 = $pdo->prepare("UPDATE boeking SET actief=0 WHERE idKlant=?");
                                             $stmt2->execute(array($klantID));
                                             ?>
                                             <script>
                                             function popUpBevestigd() {
                                                  $("#bevestigd").snackbar("show");
                                             }
                                             </script>
                                             <span data-toggle=snackbar id="bevestigd" data-content="De boeking is geannuleerd."></span>
                                             <script>window.onload = popUpBevestigd;</script>
                                             <?php
                                        }

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

                                        echo ("<tr>

                                        <td onclick=\"location='beheerpaneel.php?beheer=Boekingenopvragen&boekingID={$boeking['idKlant']}'\">" . $gebruikersnaam . "</td>
                                        <td onclick=\"location='beheerpaneel.php?beheer=Boekingenopvragen&boekingID={$boeking['idKlant']}'\">" . $begindatum . "</td>
                                        <td onclick=\"location='beheerpaneel.php?beheer=Boekingenopvragen&boekingID={$boeking['idKlant']}'\">" . $einddatum . "</td>
                                        <td onclick=\"location='beheerpaneel.php?beheer=Boekingenopvragen&boekingID={$boeking['idKlant']}'\">" . $status . "</td>
                                        <td onclick=\"location='beheerpaneel.php?beheer=Boekingenopvragen&boekingID={$boeking['idKlant']}'\">" . $betaling . "</td>");

                                        if($actief=="1") {
                                             print("<td><form method='POST'><input type='submit' name='annuleren' value='Annuleren'
                                             class='btn btn-raised btn-warning' onclick='return confirm('Weet je het zeker?')'> </form> </td>");
                                        }
                                        print ("</tr>");
                                   }
                                   ?>

                              </table>
                         </div>
                    </div>
               </div>
          </div>
     </div>
</body>
</html>
