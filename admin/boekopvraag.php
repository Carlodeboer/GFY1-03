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
               if (isset($_POST["annuleren"])) {
                    $pdo->beginTransaction();
                    $idKlant = $_POST["idklant"];
                    $idReservering = $_POST["idReservering"];
                    $stmt2 = $pdo->prepare("UPDATE boeking SET actief=0 WHERE idKlant=?");
                    $stmt2->execute(array($idKlant));
                    $stmt5 = $pdo->prepare("UPDATE gebruikers SET actief=0 WHERE idKlant=?");
                    $stmt5->execute(array($idKlant));
                    $stmt6 = $pdo->prepare("UPDATE reserveringen SET actief=0 WHERE idReservering=?");
                    $stmt6->execute(array($idReservering));
                    $pdo->commit();
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
               $stmt = $pdo->prepare("SELECT idKlant, idReservering, gebruikersnaam, begindatum, einddatum, status, betaling, actief
                    FROM boeking
                    JOIN gebruikers
                    ON idKlant=idGebruiker
                    WHERE actief=1;
                    ORDER BY begindatum"); //haalt gegevens uit de tabel
                    $stmt->execute();
                    ?>

                    <div class="row">
                         <div class="col-md-12">
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
                                   while ($boeking = $stmt->fetch()) {
                                        $klantID=$boeking['idKlant'];
                                        $idReservering=$boeking['idReservering'];
                                        $gebruikersnaam=$boeking['gebruikersnaam'];
                                        $begindatum=$boeking['begindatum'];
                                        $einddatum=$boeking['einddatum'];
                                        $status=$boeking['status'];
                                        $betaling=$boeking['betaling'];
                                        $actief=$boeking['actief']; //maakt variabele van de gegevens

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

                                             ?>
                                             <td>
                                                  <form method='POST'>
                                                       <input type="hidden" name="idklant" value="<?php print($klantID)?>">
                                                       <input type="hidden" name="idReservering" value="<?php print($idReservering)?>">
                                                       <input type='submit' name='annuleren' value='Annuleren' class='btn btn-raised btn-warning' onclick="return confirm('Weet je het zeker?')">
                                                  </form>
                                             </td>
                                             <?php
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
