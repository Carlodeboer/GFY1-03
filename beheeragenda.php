<!DOCTYPE html>
<html>
<head>
     <title>Agenda</title>
</head>
<body>

     <?php
     $pdo = newPDO();
     date_default_timezone_set("Europe/Amsterdam");
     $date = strtotime(date("Y-m-d"));
     $day = date('d', $date);

     if (!isset($_SESSION['jaarnummer'])) {
          $_SESSION['jaarnummer'] = date('Y', $date);
     }

     if (!isset($_SESSION['maandnummer'])) {
          $_SESSION['maandnummer'] = date('m', $date);
     }

     if (isset($_POST['volgende'])) {
          $_GET["dag"] = NULL;
          ++$_SESSION['maandnummer'];
          if ($_SESSION['maandnummer'] > 12) {
               $_SESSION['maandnummer'] = 1;
               $_SESSION['jaarnummer']++;
          }
     }

     if (isset($_POST['vorige'])) {
          unset($_GET["dag"]);
          --$_SESSION['maandnummer'];
          if ($_SESSION['maandnummer'] < 1) {
               $_SESSION['jaarnummer']--;
               $_SESSION['maandnummer'] = 12;
          }
     }

     $maand = $_SESSION['maandnummer'];
     $jaar = $_SESSION['jaarnummer'];

     $firstDay = mktime(0, 0, 0, $maand, 1, $jaar);
     $title = strftime('%B', $firstDay);
     $dayOfWeek = date('D', $firstDay);
     $daysInMonth = cal_days_in_month(0, $maand, $jaar);
     /* get the name of the week days */
     $timestamp = strtotime('next Sunday');
     $weekDays = array();
     for ($i = 0; $i < 7; $i++) {
          $weekDays[] = strftime('%a', $timestamp);
          $timestamp = strtotime('+1 day', $timestamp);
     }
     $blank = date('w', strtotime("{$jaar}-{$maand}-01"));

     $stmt1 = $pdo->prepare("SELECT waarde FROM instellingen WHERE instelling = 'aantalMotoren';");
     $stmt1->execute(array());
     $row1 = $stmt1->fetch();
     $aantalMotoren = $row1["waarde"];

     if (isset($_POST['invoeren'])) {
          $begindatum = $_POST['begindatum'];
          $uitval = $_POST['uitval'];
          $omschrijving = $_POST['omschrijving'];

          if ($begindatum == "") {
               print("Voer een begindatum in.");
          } elseif ($uitval == "") {
               print("Selecteer het aantal niet beschikbare motoren.");
          } elseif ($omschrijving == "") {
               print("Voer een omschrijving in.");
          } else {

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
                    $pdo->commit();
                    $stmt5 = $pdo->prepare("INSERT INTO blokkade (idReservering, begindatum, uitval, omschrijving) VALUES (?, ?, ?, ?)");
                    $stmt5->execute(array($idReservering, $begindatum, $uitval, $omschrijving));
                    //$row5 = $stmt5->fetch(PDO::FETCH_ASSOC);
                    $res5 = $stmt5->rowCount();

                    if ($res5 > 0) {
                         ?>
                         <script>
                         function popUpAgendaGewijzigd() {
                              $("#agendaGewijzigd").snackbar("show");
                         }
                         </script>
                         <span data-toggle=snackbar id="agendaGewijzigd" data-content="De reservering '<?php print($omschrijving);?>' is toegevoegd aan de agenda."></span>
                         <script>window.onload = popUpAgendaGewijzigd;</script>
                         <?php
                    }

               }
          }
     }
     ?>

     <br><br>
     <div class="row">
          <div class="col-md-8">
               <table id="calendar">
                    <tr>
                         <th colspan="7">
                              <div class="row">
                                   <form method="POST">
                                        <div class="col-md-2">

                                             <input type="submit" name="vorige" value="Vorige" class="btn btn-raised btn-primary">
                                        </div>

                                        <div class="col-md-8">
                                             <?php print("{$title} {$jaar}"); ?>
                                        </div>

                                        <div class="col-md-2">
                                             <input type="submit" name="volgende" value="Volgende" class="btn btn-raised btn-primary">
                                        </div>
                                   </form>
                              </div>
                         </th>
                    </tr>
                    <tr>
                         <?php
                         foreach ($weekDays as $key => $weekDay) {
                              print("<td class='text-center'>" . $weekDay . "</td>");
                         }
                         ?>
                    </tr>
                    <tr>
                         <?php
                         for ($i = 0; $i < $blank; $i++) {
                              print("<td></td>");
                         }
                         if ($_SESSION["maandnummer"] != 1) {
                              $stmt5 = $pdo->prepare("SELECT * FROM blokkade WHERE Year(begindatum) = ? AND (Month(begindatum) = ? OR (Month(begindatum) = ? AND day(begindatum) >= 22));");
                              $stmt5->execute(array($_SESSION['jaarnummer'], $_SESSION['maandnummer'], $_SESSION['maandnummer'] - 1));
                         } else {
                              $stmt5 = $pdo->prepare("SELECT * FROM blokkade WHERE (Year(begindatum) = ? AND Month(begindatum) = ?) OR (Year(begindatum) = ? AND Month(begindatum) = ? AND day(begindatum) >= 22);");
                              $stmt5->execute(array($_SESSION['jaarnummer'], $_SESSION['maandnummer'], $_SESSION['jaarnummer'] -1, 12));
                         }

                         $objArray = array();

                         while ($row5 = $stmt5->fetch()) {

                              $begindatum = strtotime($row5['begindatum']);
                              $einddatum = strtotime("+6 day", $begindatum);

                              $begindag = date('j', $begindatum);
                              $einddag = date('j', $einddatum);

                              $maand1 = date('n', $einddatum);
                              $maand2 = date('n', $begindatum);

                              if ($maand1 != $_SESSION["maandnummer"]) {
                                   $einddag = $daysInMonth;
                                   //$einddag = 6;
                              }

                              if ($maand2 != $_SESSION["maandnummer"]) {
                                   $begindag = 1;
                              }

                              if (!($maand2 != $_SESSION["maandnummer"] && $einddag > 6)) {
                                   for ($i = $begindag; $i <= $einddag; $i++) {
                                        $stmt6 = $pdo->prepare("SELECT aantal FROM reserveringen WHERE begindatum = ?");
                                        $stmt6->execute(array($row5["begindatum"]));
                                        $row6 = $stmt6->fetch();
                                        $objArray[$i . "omschrijving"] = $row5['omschrijving'];
                                        $uitval = $row6["aantal"];
                                        if (isset($objArray[$i . "uitval"])) {
                                             $objArray[$i . "uitval"] = $objArray[$i . "uitval"] - $uitval;
                                        } else {
                                             $objArray[$i . "uitval"] = $aantalMotoren - $uitval;
                                        }
                                   }
                              }
                         }

                         for ($i = 1; $i <= $daysInMonth; $i++) {

                              if (($i + $blank) % 7 != 0) {
                                   print ("<td>");
                                   if (isset($objArray[$i . "omschrijving"])) {
                                        print ($i . ": " . $objArray[$i . "omschrijving"] . "<br>" . $objArray[$i . "uitval"] . " motor(en) beschikbaar");
                                   } else {
                                        print ($i);
                                   }
                                   print ("</td>");
                              }
                              if (($i + $blank) % 7 == 0) {
                                   print ("<td><a href='http://" . $_SERVER['HTTP_HOST'] . "/GFY1-03/admin/beheerpaneel.php?beheer=Agenda&dag={$i}'>");
                                   if (isset($objArray[$i . "omschrijving"])) {
                                        print ($i . ": " . $objArray[$i . "omschrijving"] . "<br>" . $objArray[$i . "uitval"] . " motor(en) beschikbaar");
                                   } else {
                                        print ($i);
                                   }
                                   print ("</a></td></tr><tr>");
                              }

                         }
                         for ($i = 0; ($i + $blank + $daysInMonth) % 7 != 0; $i++) {
                              print("<td></td>");
                         }
                         ?>
                    </tr>
               </table>
          </div>
          <div class="col-md-4">
               <form method="POST">
                    <div class="form-group">
                         <label for="inputdatum1" class="col-md-2 control-label" >Begindatum</label>

                         <div class="col-md-10">
                              <input type="date" name="begindatum" readonly

                              <?php
                              if (isset($_GET["dag"])) {
                                   $dag2 = $_GET["dag"];
                                   $jaar2 = $_SESSION["jaarnummer"];
                                   $maand2 = $_SESSION["maandnummer"];

                                   if ($dag2 < 10) {
                                        $dag2 = 0 . $dag2;
                                   }
                                   if ($maand2 < 10) {
                                        $maand2 = 0 . $maand2;
                                   }
                                   print("value=\"" . $jaar2 . "-" . $maand2 . "-" . $dag2 . "\"");
                              }
                              ?>
                              class="form-control" id="inputdatum1">
                         </div>
                    </div>

                    <div class="form-group">
                         <label for="inputdatum2" class="col-md-2 control-label">Einddatum</label>

                         <div class="col-md-10">
                              <input type="date" name="einddatum" readonly
                              <?php
                              if (isset($_GET["dag"])) {
                                   $dag3 = $_GET["dag"] + 6;

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
                              }
                              ?>
                              class="form-control" id="inputdatum2">
                         </div>
                    </div>

                    <div class="form-group">
                         <label for="select111" class="col-md-2 control-label">Uitval</label>

                         <div class="col-md-10">
                              <select name="uitval" id="select111" class="form-control">
                                   <?php
                                   for ($i = 1; $i < $aantalMotoren; $i++) {
                                        print ("<option value='{$i}'>{$i} motor(en) niet beschikbaar</option>");
                                   }
                                   ?>
                                   <option value='4'>Gesloten</option>
                              </select>
                         </div>
                    </div>
                    <div class="form-group">
                         <label for="inputomschrijving" class="col-md-2 control-label">Omschrijving</label>

                         <div class="col-md-10">
                              <input type="text" name="omschrijving" class="form-control" id="inputomschrijving">
                         </div>
                    </div>
                    <br><br>
                    <input class="btn btn-raised btn-primary" type="submit" name="invoeren" value="Invoeren">
               </form>
          </div>
     </div>
     <?php
     $pdo = NULL;
     ?>
</body>
</html>
