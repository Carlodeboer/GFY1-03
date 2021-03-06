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
<html>
<head>
     <title>Boekingopvraag</title>

</head>
<body>
     <div id="container">
          <div id="contentwrapper">
               <h2>Boekingen</h2>
               <?php
               $pdo = newPDO();
               if (isset($_POST["annuleren"])) {
                    $pdo->beginTransaction();
                    $idKlant = $_POST["idklant"];
                    $idReservering = $_POST["idReservering"];
                    $stmt1 = $pdo->prepare("UPDATE boeking SET actief=0 WHERE idKlant=?");
                    $stmt1->execute(array($idKlant));
                    $stmt2 = $pdo->prepare("UPDATE gebruikers SET actief=0 WHERE idKlant=?");
                    $stmt2->execute(array($idKlant));
                    $stmt3 = $pdo->prepare("UPDATE reserveringen SET actief=0 WHERE idReservering=?");
                    $stmt3->execute(array($idReservering));
                    $pdo->commit(); //als er op 'annuleren' wordt geklikt, wordt bij de tabellen boeking, gebruikers en reserveringen 'actief' op nul gezet
                    ?>
                    <script>
                    function popUpBevestigd() {
                         $("#bevestigd").snackbar("show");
                    }
                    </script>
                    <span data-toggle=snackbar id="bevestigd" data-content="De boeking is geannuleerd."></span>
                    <script>window.onload = popUpBevestigd;</script> <!--dit is de popup die aangeeft dat de boeking is geannuleerd-->
                    <?php
               }
               $pdo->beginTransaction();
               $stmt4 = $pdo->prepare("SELECT idKlant, idReservering, gebruikersnaam, begindatum, einddatum, status, betaling, a.actief FROM boeking AS a JOIN gebruikers AS b ON a.idKlant = b.idGebruiker WHERE a.actief=1 ORDER BY begindatum"); //haalt gegevens uit de tabel
               $stmt4->execute(array());
               $pdo->commit();
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
                              while ($boeking = $stmt4->fetch()) {
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
                                   }  //status is dikgedrukt als hij niet bevestigd is

                                   if ($betaling=="Niet betaald") {
                                        $betaling="<b>" . $betaling . "<b>";
                                   } //betaling is dikgedrukt als de boeking niet betaald is

                                   echo ("<tr>

                                   <td onclick=\"location='beheerpaneel.php?beheer=Boekingenopvragen&boekingID={$boeking['idKlant']}'\">" . $gebruikersnaam . "</td>
                                   <td onclick=\"location='beheerpaneel.php?beheer=Boekingenopvragen&boekingID={$boeking['idKlant']}'\">" . $begindatum . "</td>
                                   <td onclick=\"location='beheerpaneel.php?beheer=Boekingenopvragen&boekingID={$boeking['idKlant']}'\">" . $einddatum . "</td>
                                   <td onclick=\"location='beheerpaneel.php?beheer=Boekingenopvragen&boekingID={$boeking['idKlant']}'\">" . $status . "</td>
                                   <td onclick=\"location='beheerpaneel.php?beheer=Boekingenopvragen&boekingID={$boeking['idKlant']}'\">" . $betaling . "</td>");

                                   if($actief == 1) {
                                        ?>
                                        <td>
                                             <form method='POST'>
                                                  <input type="hidden" name="idklant" value="<?php print($klantID)?>">
                                                  <input type="hidden" name="idReservering" value="<?php print($idReservering)?>">
                                                  <input type='submit' name='annuleren' value='Annuleren' class='btn btn-raised btn-warning' onclick="return confirm('Weet je het zeker?')">
                                                  <!--als je op de knop 'annuleren' klikt, wordt er nog gevraagd 'weet je het zeker?'-->
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
