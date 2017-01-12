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
<?php

$pdo = newPDO();
// Als de beheerder een blokkade wil invoeren, gebeurt dit:
if (isset($_POST['verzendenBlokkade'])) {
     if (!isset($_POST["uitval"])) {
          // Als het veld 'uitval' niet ingevuld is, komt er een pop-up.
          ?>
          <script>
          function popUp() {
               $("#periodeVol").snackbar("show");
          }
          </script>
          <span data-toggle=snackbar id="periodeVol" data-content="Geen motoren meer beschikbaar in deze periode."></span>
          <script>window.onload = popUp;</script>
          <?php
     } elseif ($_POST["omschrijving"] == "") {
          // Als het veld 'omschrijving' niet ingevuld is, komt er een pop-up.
          ?>
          <script>
          function popUp() {
               $("#omschrijvingLeeg").snackbar("show");
          }
          </script>
          <span data-toggle=snackbar id="omschrijvingLeeg" data-content="Voer een omschrijving in."></span>
          <script>window.onload = popUp;</script>
          <?php
     } else {
          // Als alles ingevuld is worden er variabelen aangemaakt.
          $begindatum = $_POST['begindatum'];
          $uitval = $_POST['uitval'];
          $omschrijving = $_POST['omschrijving'];
          // De informatie uit de velden vergeleken met de database.
          $stmt2 = $pdo->prepare("SELECT aantal FROM reseveringen WHERE begindatum = ?");
          $stmt2->execute(array($begindatum));
          $row2 = $stmt2->fetch();
          $res2 = $stmt2->rowCount();
          if ($res2 > 0 && ($aantalMotoren - ($row2["aantal"] + $uitval) < 0)) {
               // Als er in een periode geen blokkade meer toegevoegd kunnen worden, komt er een pop-up en kan de beheerder het formulier aanpassen
               print("In deze periode kunnen er geen reserveringen meer worden toegevoegd.");
          } else {
               // Anders worden de gegevens toegoegd aan database
               $pdo->beginTransaction();
               $stmt3 = $pdo->prepare("INSERT INTO reserveringen (begindatum, type, aantal) VALUES (?, 'reservering', ?)");
               $stmt3->execute(array($begindatum, $uitval));

               // Haalt het reserveringsid op
               $stmt4 = $pdo->prepare("SELECT max(idReservering) FROM reserveringen;");
               $stmt4->execute(array());
               $row4 = $stmt4->fetch();
               $idReservering = $row4["max(idReservering)"];

               // Daarna toevoegen aan database
               $stmt5 = $pdo->prepare("INSERT INTO blokkade (idReservering, begindatum, uitval, omschrijving) VALUES (?, ?, ?, ?)");
               $stmt5->execute(array($idReservering, $begindatum, $uitval, $omschrijving));

               $res5 = $stmt5->rowCount();
               $pdo->commit();
               if ($res5 > 0) {
                    // Als er een rij is toegevoegd is aan de database, komt er een pop-up.
                    ?>
                    <script>
                    function popUp() {
                         $("#agendaGewijzigd").snackbar("show");
                    }
                    </script>
                    <span data-toggle=snackbar id="agendaGewijzigd" data-content="De reservering '<?php print($omschrijving);?>' is toegevoegd aan de agenda."></span>
                    <script>window.onload = popUp;</script>
                    <?php
               }

          }
     }
}
// Als de beheerder een blokkade wil verwijderen, gebeurt dit:
elseif(isset($_POST["verwijderenBlokkade"])) {
     if (!isset($_POST["beschikbaar"])) {
          // Als het veld 'aantal beschikbaar' niet ingevuld is, komt er een pop-up.
          ?>
          <script>
          function popUp() {
               $("#periodeVol").snackbar("show");
          }
          </script>
          <span data-toggle=snackbar id="periodeVol" data-content="Alle motoren zijn al beschikbaar in deze periode."></span>
          <script>window.onload = popUp;</script>
          <?php
     } else {
          // Als alles ingevuld is worden er variabelen aangemaakt.
          $begindatum = $_POST['begindatum'];
          $beschikbaar = $_POST['beschikbaar'];
          $pdo->beginTransaction();

          // Haalt het reserveringsid op
          $stmt8 = $pdo->prepare("SELECT max(idReservering) FROM reserveringen WHERE begindatum = ?");
          $stmt8->execute(array($begindatum));
          $row8 = $stmt8->fetch();
          $idReservering = $row8["max(idReservering)"];

          // Daarna toevoegen aan database. De nieuwe waarde wordt de oude waarde min het aantal beschikbare motoren.
          // In principe is het dus mogelijk om negatieve getallen te krijgen, dat is niet erg.
          $stmt7 = $pdo->prepare("UPDATE blokkade SET uitval = uitval - ? WHERE idReservering = ?");
          $stmt7->execute(array($beschikbaar, $idReservering));

          // Het aantal beschikbare motoren wordt in beide tabellen aangepast.
          $stmt9 = $pdo->prepare("UPDATE reserveringen SET aantal = aantal - ? WHERE idReservering = ?");
          $stmt9->execute(array($beschikbaar, $idReservering));
          $pdo->commit();
          $res7 = $stmt7->rowCount();
          if ($res7 == 1) {
               // Als er een rij is toegevoegd is aan de database, komt er een pop-up.
               ?>
               <script>
               function popUp() {
                    $("#agendaGewijzigd").snackbar("show");
               }
               </script>
               <span data-toggle=snackbar id="agendaGewijzigd" data-content="De reservering is verwijderd uit de agenda."></span>
               <script>window.onload = popUp;</script>
               <?php
          }

     }
}
?>
<div id="contentwrapper">
     <h2>Agenda</h2>
     <div class="row">
          <?php
          // Toevoegen van agendaVariabelen en het weergeven van agenda.
          include ("agenda/agendaVariabelen.php");
          include ("agenda/agenda.php");
          ?>
          <div class="col-md-4">
               <?php
               // Knoppen bovenaan formulier worden weggeschreven in een SESSION, zodat er nog onbeperkt geklikt kan worden in de agenda.
               if (isset($_POST["verwijderen"])) {
                    $_SESSION["invoerenOfVerwijderen"] = "verwijderen";
               } elseif (isset($_POST["invoeren"])) {
                    $_SESSION["invoerenOfVerwijderen"] = "invoeren";
               }
               // Als er op geen enkele knop is geklikt, automatisch naar 'invoeren' in plaats van 'verwijderen'.
               elseif (!isset($_POST["invoeren"]) || !isset($_POST["verwijderen"])) {
                    $_SESSION["invoerenOfVerwijderen"] = "invoeren";
               }

               // Als gebruiker wil verwijderen, wordt dit formulier getoond:
               if($_SESSION["invoerenOfVerwijderen"] == "verwijderen") {
                    // Knop voor invoeren boven aan, om naar ander formulier te gaan
                    ?>
                    <form method="POST">
                         <input class="btn btn-raised btn-primary" type="submit" name="invoeren" value="Invoeren">
                    </form>
                    <form method="POST">
                         <div class="form-group control-label label-static is-empty">
                              <label class="control-label label-static is-empty" >Begindatum</label>

                              <input type="date" name="begindatum" readonly
                              <?php
                              $jaar2 = $_SESSION["jaarnummer"];
                              $maand2 = $_SESSION["maandnummer"];
                              // Als er een dag is geselecteerd in de kalender, wordt hij ingevuld in het formulier. Daarom ook een 'readonly'-veld, het kan niet worden aangepast.
                              if (isset($_GET["dag"])) {
                                   $dag2 = $_GET["dag"];
                                   // Als de lengte van de dag of maand gelijk is aan 1 karakter, wordt er een 0 voor geplakt. Dit heeft te maken met de notitie van de datum.
                                   if (strlen($dag2) == 1) {
                                        $dag2 = 0 . $dag2;
                                   }
                                   if (strlen($maand2) == 1) {
                                        $maand2 = 0 . $maand2;
                                   }
                                   $begindatum = date("Y-m-d", mktime(0,0,0, $maand2, $dag2, $jaar2));
                              }
                              // Als er geen dag geselecteerd is, wordt aankomende zaterdag in het veld gezet.
                              else {
                                   $aankomendeZaterdag = strtotime('next saturday', $date);
                                   $begindatum = date('Y-m-d', $aankomendeZaterdag);
                                   $dag2 = date('d', $aankomendeZaterdag);
                              }

                              print("value=\"" . $begindatum . "\"");
                              // Variable 'begindatum' wordt teruggezet naar oude notatie, voor het selecteren van einddatum.
                              $begindatum = mktime(0,0,0, $maand2, $dag2, $jaar2);
                              ?>
                              class="form-control">

                         </div>
                         <div class="form-group control-label label-static is-empty">
                              <label for="i5i" class="control-label">Einddatum</label>
                              <input type="date" name="einddatum" readonly
                              <?php
                              // Variabele 'einddatum' is zes dagen groter dan de begindatum.
                              $einddatum = strtotime('+ 6 days', $begindatum);
                              $einddatum = date('Y-m-d', $einddatum);

                              print("value=\"" . $einddatum . "\"");
                              // Variable 'begindatum'  wordt teruggezet naar oude notatie, voor het ophalen uit database.
                              $begindatum = date("Y-m-d", mktime(0,0,0, $maand2, $dag2, $jaar2));
                              ?>
                              class="form-control">

                         </div>
                         <?php
                         // Uit de database wordt gehaald hoeveel motoren er op in een bepaalde periode beschikbaar zijn.
                         $stmt7 = $pdo->prepare("SELECT uitval FROM blokkade WHERE begindatum = ?");
                         $stmt7->execute(array($begindatum));
                         $aantalNietBeschikbaar = 0;
                         while ($row7 = $stmt7->fetch()) {
                              // Het aantal motoren wat niet beschikbaar is doordat de beheerder heeft gereserveerd wordt bij elkaar opgeteld.
                              $aantal = $row7["uitval"];
                              $aantalNietBeschikbaar = $aantalNietBeschikbaar + $aantal;
                         }
                         ?>
                         <div class="form-group control-label label-static is-empty">
                              <label for="select111" class="control-label label-static is-empty">Beschikbaar</label>

                              <?php
                              // Als er in die periode geen motoren zijn gereserveerd, worden alle komende velden op 'disabled' gezet en komt er geen menu om te selecteren hoeveel motoren er wel beschikbaar zijn,
                              // maar de tekst "Alle motoren zijn beschikbaar".
                              if($aantalNietBeschikbaar <= 0) {
                                   print("<input type='text' class='form-control' disabled='' value='Alle motoren zijn beschikbaar'>");
                              } else {
                                   ?>
                                   <select name="beschikbaar" id="select111" class="form-control">
                                        <?php
                                        // Voor elke niet beschikbare motor wordt een 'option' geprint.
                                        for ($i = 1; $i <= $aantalNietBeschikbaar; $i++) {
                                             print ("<option value='{$i}'>{$i} motor(en) wel beschikbaar</option>");
                                        }
                                        ?>
                                   </select>
                                   <?php
                              }
                              ?>

                         </div>
                         <input class="btn btn-raised btn-warning" type="submit" name="verwijderenBlokkade" value="Verzenden"  <?php if($aantalNietBeschikbaar <= 0) {
                              print("disabled=''");
                         }?> >
                    </form>
                    <?php
               }
               // Als gebruiker wil verwijderen, wordt dit formulier getoond:
               else {
                    // Knop voor invoeren boven aan, om naar ander formulier te gaan
                    ?>
                    <form method="POST">
                         <input class="btn btn-raised btn-warning" type="submit" name="verwijderen" value="Verwijderen">
                    </form>
                    <form method="POST">
                         <div class="form-group control-label label-static is-empty">
                              <label for="inputdatum1" class="control-label label-static is-empty" >Begindatum</label>

                              <input type="date" name="begindatum" readonly
                              <?php
                              $jaar2 = $_SESSION["jaarnummer"];
                              $maand2 = $_SESSION["maandnummer"];
                              // Als er een dag is geselecteerd in de kalender, wordt hij ingevuld in het formulier. Daarom ook een 'readonly'-veld, het kan niet worden aangepast.
                              if (isset($_GET["dag"])) {
                                   $dag2 = $_GET["dag"];

                                   // Als de lengte van de dag of maand gelijk is aan 1 karakter, wordt er een 0 voor geplakt. Dit heeft te maken met de notitie van de datum.
                                   if (strlen($dag2) == 1) {
                                        $dag2 = 0 . $dag2;
                                   }
                                   if (strlen($maand2) == 1) {
                                        $maand2 = 0 . $maand2;
                                   }
                                   $begindatum = date("Y-m-d", mktime(0,0,0, $maand2, $dag2, $jaar2));
                              }
                              // Als er geen dag geselecteerd is, wordt aankomende zaterdag in het veld gezet.
                              else {
                                   $aankomendeZaterdag = strtotime('next saturday', $date);
                                   $begindatum = date('Y-m-d', $aankomendeZaterdag);
                                   $dag2 = date('d', $aankomendeZaterdag);
                              }

                              print("value=\"" . $begindatum . "\"");
                              // Variable 'begindatum' wordt teruggezet naar oude notatie, voor het selecteren van einddatum.
                              $begindatum = mktime(0,0,0, $maand2, $dag2, $jaar2);
                              ?>
                              class="form-control">

                         </div>
                         <div class="form-group control-label label-static is-empty">
                              <label for="i5i" class="control-label">Einddatum</label>
                              <input type="date" name="einddatum" readonly
                              <?php
                              // Variabele 'einddatum' is zes dagen groter dan de begindatum.
                              $einddatum = strtotime('+ 6 days', $begindatum);
                              $einddatum = date('Y-m-d', $einddatum);

                              print("value=\"" . $einddatum . "\"");
                              // Variable 'begindatum'  wordt teruggezet naar oude notatie, voor het ophalen uit database.
                              $begindatum = date("Y-m-d", mktime(0,0,0, $maand2, $dag2, $jaar2));
                              ?>
                              class="form-control">

                         </div>
                         <div class="form-group control-label label-static is-empty">
                              <label for="i5i" class="control-label">Uitval</label>
                              <?php

                              // Uit de database wordt gehaald hoeveel motoren er op in een bepaalde periode niet beschikbaar zijn.
                              $stmt7 = $pdo->prepare("SELECT aantal FROM reserveringen WHERE begindatum = ?");
                              $stmt7->execute(array($begindatum));
                              $aantalNietBeschikbaar = 0;
                              // Het aantal motoren wat niet beschikbaar is doordat de beheerder heeft gereserveerd of er een boeking is geplaatst, wordt bij elkaar opgeteld.
                              while ($row7 = $stmt7->fetch()) {
                                   $aantal = $row7["aantal"];
                                   $aantalNietBeschikbaar = $aantalNietBeschikbaar + $aantal;
                              }
                              // Het aantal niet beschikbare motoren wordt afgetrokken van het aantal totale motoren.
                              $aantalBeschikbaar = $aantalMotoren - $aantalNietBeschikbaar;

                              // Als er in die periode geen motoren zijn beschikbaar, worden alle komende velden op 'disabled' gezet en komt er geen menu om te selecteren hoeveel motoren er op
                              // niet beschikbaar gezet kunnen worden, maar de tekst "Geen motoren beschikbaar".
                              if($aantalBeschikbaar <= 0) {
                                   print("<input type='text' class='form-control' disabled='' value='Geen motoren beschikbaar'>");
                              } else {
                                   ?>
                                   <select id="s1" class="form-control" name="uitval">
                                        <?php
                                        // Voor elke beschikbare motor wordt een 'option' geprint.
                                        for ($i = 1; $i <= $aantalBeschikbaar; $i++) {
                                             if ($i != $aantalMotoren) {
                                                  print ("<option value='{$i}'>{$i} motor(en) niet beschikbaar</option>");
                                             } else {
                                                  print ("<option value='" . $aantalMotoren . "'>Gesloten</option>");
                                             }
                                        }
                                        ?>
                                   </select>
                                   <?php
                              }
                              ?>

                         </div>
                         <!-- De beheerder kan bij een reservering een omschrijving plaatsen, die wordt weergegeven in de agenda. -->
                         <div class="form-group control-label label-static is-empty">
                              <label for="i5i" class="control-label">Omschrijving</label>
                              <input type="text" name="omschrijving" class="form-control" <?php
                              if($aantalBeschikbaar <= 0) {
                                   print("disabled=''");
                              }?> >
                         </div>
                         <input class="btn btn-raised btn-primary" type="submit" name="verzendenBlokkade" value="Verzenden" <?php
                         if($aantalBeschikbaar <= 0) {
                              print("disabled=''");
                         }
                         ?>
                         >
                    </form>
                    <?php
               }
               ?>
          </div>
     </div>
     <?php
     $pdo = NULL;

     ?>

     <script> $.material.init(); </script>
</div>
