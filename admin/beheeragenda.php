     <?php
     $pdo = newPDO();
     if (isset($_POST['verzendenBlokkade'])) {
          if (!isset($_POST["uitval"])) {
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
               $begindatum = $_POST['begindatum'];
               $uitval = $_POST['uitval'];
               $omschrijving = $_POST['omschrijving'];

               $stmt2 = $pdo->prepare("SELECT aantal FROM reseveringen WHERE begindatum = ?");
               $stmt2->execute(array($begindatum));
               $row2 = $stmt2->fetch();
               $res2 = $stmt2->rowCount();
               if ($res2 > 0 && ($aantalMotoren - ($row2["aantal"] + $uitval) < 0)) {
                    print("In deze periode kunnen er geen reserveringen meer worden toegevoegd.");
               } else {
                    $pdo->beginTransaction();
                    $stmt3 = $pdo->prepare("INSERT INTO reserveringen (begindatum, type, aantal) VALUES (?, 'reservering', ?)");
                    $stmt3->execute(array($begindatum, $uitval));

                    $stmt4 = $pdo->prepare("SELECT max(idReservering) FROM reserveringen;");
                    $stmt4->execute(array());
                    $row4 = $stmt4->fetch();
                    $idReservering = $row4["max(idReservering)"];

                    $stmt5 = $pdo->prepare("INSERT INTO blokkade (idReservering, begindatum, uitval, omschrijving) VALUES (?, ?, ?, ?)");
                    $stmt5->execute(array($idReservering, $begindatum, $uitval, $omschrijving));

                    $res5 = $stmt5->rowCount();
                    $pdo->commit();
                    if ($res5 > 0) {
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
     } elseif(isset($_POST["verwijderenBlokkade"])) {
          if (!isset($_POST["beschikbaar"])) {
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
               $begindatum = $_POST['begindatum'];
               $beschikbaar = $_POST['beschikbaar'];
               $pdo->beginTransaction();
               $stmt8 = $pdo->prepare("SELECT max(idReservering) FROM reserveringen WHERE begindatum = ?");
               $stmt8->execute(array($begindatum));
               $row8 = $stmt8->fetch();
               $idReservering = $row8["max(idReservering)"];

               $stmt7 = $pdo->prepare("UPDATE blokkade SET uitval = uitval - ? WHERE idReservering = ?");
               $stmt7->execute(array($beschikbaar, $idReservering));

               $stmt9 = $pdo->prepare("UPDATE reserveringen SET aantal = aantal - ? WHERE idReservering = ?");
               $stmt9->execute(array($beschikbaar, $idReservering));
               $pdo->commit();
               $res7 = $stmt7->rowCount();
               if ($res7 == 1) {
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
     include ("agenda/agendaVariabelen.php");
     include ("agenda/agenda.php");
     ?>
     <div class="col-md-4">
          <?php
          if (isset($_POST["verwijderen"])) {
               $_SESSION["invoerenOfVerwijderen"] = "verwijderen";
          } elseif (isset($_POST["invoeren"])) {
               $_SESSION["invoerenOfVerwijderen"] = "invoeren";
          } elseif (!isset($_POST["invoeren"]) || !isset($_POST["verwijderen"])) {
               $_SESSION["invoerenOfVerwijderen"] = "invoeren";
          }

          if($_SESSION["invoerenOfVerwijderen"] == "verwijderen") {
               ?>
               <form method="POST">
                    <input class="btn btn-raised btn-primary" type="submit" name="invoeren" value="Invoeren">
               </form>
               <form method="POST">
                    <div class="form-group control-label label-static is-empty">
                         <label class="control-label label-static is-empty" >Begindatum</label>

                              <input type="date" name="begindatum" readonly
                              <?php
                              if (isset($_GET["dag"])) {
                                   $dag2 = $_GET["dag"];
                                   $jaar2 = $_SESSION["jaarnummer"];
                                   $maand2 = $_SESSION["maandnummer"];

                                   if (strlen($dag2) == 1) {
                                        $dag2 = 0 . $dag2;
                                   }
                                   if (strlen($maand2) == 1) {
                                        $maand2 = 0 . $maand2;
                                   }
                              } else {
                                   $aankomendeZaterdag = strtotime('next saturday', $date);

                                   $dag2 = date('d', $aankomendeZaterdag);
                                   $maand2 = date('m', $aankomendeZaterdag);
                                   $jaar2 = date('Y', $aankomendeZaterdag);
                              }
                              $begindatum = $jaar2 . "-" . $maand2 . "-" . $dag2;
                              print("value=\"" . $begindatum . "\"");
                              ?>
                              class="form-control">

                    </div>
                    <div class="form-group control-label label-static is-empty">
                         <label for="i5i" class="control-label">Einddatum</label>
                         <input type="date" name="einddatum" readonly
                              <?php
                              $dag3 = $dag2 + 6;

                              if ($dag3 > $daysInMonth) {
                                   $dag3 = $dag3 - $daysInMonth;
                                   $maand3 = $maand2 + 1;
                              } else {
                                   $maand3 = $maand2;
                              }

                              if ($maand3 > 12) {
                                   $jaar3 = $jaar + 1;
                                   $maand3 = 1;
                              } else {
                                   $jaar3 = $jaar2;
                              }

                              if (strlen($dag3) == 1) {
                                   $dag3 = 0 . $dag3;
                              }
                              if (strlen($maand3) == 1) {
                                   $maand3 = 0 . $maand3;
                              }

                              print("value=\"" . $jaar3 . "-" . $maand3 . "-" . $dag3 . "\"");

                              ?>
                              class="form-control">

                    </div>
                    <?php
                    $stmt7 = $pdo->prepare("SELECT uitval FROM blokkade WHERE begindatum = ?");
                    $stmt7->execute(array($begindatum));
                    $aantalNietBeschikbaar = 0;
                    while ($row7 = $stmt7->fetch()) {
                         $aantal = $row7["uitval"];
                         $aantalNietBeschikbaar = $aantalNietBeschikbaar + $aantal;
                    }
                    // for="select111"
                    ?>
                    <div class="form-group control-label label-static is-empty">
                         <label for="select111" class="control-label label-static is-empty">Beschikbaar</label>

                              <?php
                              if($aantalNietBeschikbaar <= 0) {
                                   print("<input type='text' class='form-control' disabled='' value='Alle motoren zijn beschikbaar'>");
                              } else {
                                   ?>
                                   <select name="beschikbaar" id="select111" class="form-control">
                                        <?php
                                        for ($i = 1; $i <= $aantalNietBeschikbaar; $i++) {
                                             print ("<option value='{$i}'>{$i} motor(en) wel beschikbaar</option>");
                                        }
                                        ?>
                                   </select>
                                   <?php
                              }
                              ?>

                    </div>
                    <input class="btn btn-raised btn-warning" type="submit" name="verwijderenBlokkade" value="Verzenden">
               </form>
               <?php
          } else {
               ?>
               <form method="POST">
                    <input class="btn btn-raised btn-warning" type="submit" name="verwijderen" value="Verwijderen">
               </form>
               <form method="POST">
                    <div class="form-group control-label label-static is-empty">
                         <label for="inputdatum1" class="control-label label-static is-empty" >Begindatum</label>

                              <input type="date" name="begindatum" readonly
                              <?php
                              if (isset($_GET["dag"])) {
                                   $dag2 = $_GET["dag"];
                                   $jaar2 = $_SESSION["jaarnummer"];
                                   $maand2 = $_SESSION["maandnummer"];

                                   if (strlen($dag2) == 1) {
                                        $dag2 = 0 . $dag2;
                                   }
                                   if (strlen($maand2) == 1) {
                                        $maand2 = 0 . $maand2;
                                   }
                              } else {
                                   $aankomendeZaterdag = strtotime('next saturday', $date);

                                   $dag2 = date('d', $aankomendeZaterdag);
                                   $maand2 = date('m', $aankomendeZaterdag);
                                   $jaar2 = date('Y', $aankomendeZaterdag);
                              }
                              $begindatum = $jaar2 . "-" . $maand2 . "-" . $dag2;
                              print("value=\"" . $begindatum . "\"");
                              ?>
                              class="form-control">

                    </div>
                    <div class="form-group control-label label-static is-empty">
                         <label for="i5i" class="control-label">Einddatum</label>
                              <input type="date" name="einddatum" readonly
                              <?php
                              $dag3 = $dag2 + 6;

                              if ($dag3 > $daysInMonth) {
                                   $dag3 = $dag3 - $daysInMonth;
                                   $maand3 = $maand2 + 1;
                              } else {
                                   $maand3 = $maand2;
                              }

                              if ($maand3 > 12) {
                                   $jaar3 = $jaar + 1;
                                   $maand3 = 1;
                              } else {
                                   $jaar3 = $jaar2;
                              }

                              if (strlen($dag3) == 1) {
                                   $dag3 = 0 . $dag3;
                              }
                              if (strlen($maand3) == 1) {
                                   $maand3 = 0 . $maand3;
                              }

                              print("value=\"" . $jaar3 . "-" . $maand3 . "-" . $dag3 . "\"");
                              ?>
                              class="form-control">

                    </div>
                    <div class="form-group control-label label-static is-empty">
                         <label for="i5i" class="control-label">Uitval</label>
                                   <?php

                                   $stmt7 = $pdo->prepare("SELECT aantal FROM reserveringen WHERE begindatum = ?");
                                   $stmt7->execute(array($begindatum));
                                   $aantalNietBeschikbaar = 0;
                                   while ($row7 = $stmt7->fetch()) {
                                        $aantal = $row7["aantal"];
                                        $aantalNietBeschikbaar = $aantalNietBeschikbaar + $aantal;
                                   }
                                   $aantalBeschikbaar = $aantalMotoren - $aantalNietBeschikbaar;

                                   if($aantalBeschikbaar <= 0) {
                                        print("<input type='text' class='form-control' disabled='' value='Geen motoren beschikbaar'>");
                                   } else {
                                        ?>
                                        <select id="s1" class="form-control" name="uitval">
                                             <?php
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
                              </select>
                    </div>
                    <div class="form-group control-label label-static is-empty">
                         <label for="i5i" class="control-label">Omschrijving</label>
                              <input type="text" name="omschrijving" class="form-control">
                    </div>
                    <!-- <div class="form-group control-label label-static is-empty"> -->
                    <input class="btn btn-raised btn-primary" type="submit" name="verzendenBlokkade" value="Verzenden">
                    <!-- </div> -->
               </form>
               <?php
          }
          ?>
     </div>
<?php
$pdo = NULL;

?>

<script> $.material.init(); </script>
