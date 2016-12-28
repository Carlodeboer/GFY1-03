<!DOCTYPE html>
<html>
<head>
     <title>Motorcross</title>
</head>
<body>

     <?php
     $pdo = newPDO();
     date_default_timezone_set("Europe/Amsterdam");
     $date = strtotime(date("Y-m-d"));
     $day = date('d', $date);

     if (!isset($jaar)) {
          $jaar = date('Y', $date);
     }
     if (!isset($maand)) {
          $maand = date('m', $date);
     }

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
               $_SESSION['jaarnummer'] ++;
          }
     }

     if (isset($_POST['vorige'])) {
          unset($_GET["dag"]);
          --$_SESSION['maandnummer'];
          if ($_SESSION['maandnummer'] < 1) {
               $_SESSION['jaarnummer'] --;
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
          $einddatum = $_POST['einddatum'];
          $uitval = $_POST['uitval'];
          $omschrijving = $_POST['omschrijving'];

          if ($begindatum == "") {
               print("Voer een begindatum in.");
          } elseif ($einddatum == "") {
               print("Voer een einddatum in.");
          } elseif ($uitval == "") {
               print("Selecteer het aantal niet beschikbare motoren.");
          } elseif ($omschrijving == "") {
               print("Voer een omschrijving in.");
          } else {

               $stmt2 = $pdo->prepare("SELECT * FROM blokkade WHERE begindatum >= ? AND einddatum <= ?");
               $stmt2->execute(array($begindatum,$einddatum));
               $row2 = $stmt2->fetch(PDO::FETCH_ASSOC);
               $res2 = $stmt2->rowCount();
               if ($res2 > 0) {
                    print("Deze bestaat al");
               } else {

                    $stmt = $pdo->prepare("INSERT INTO blokkade (begindatum,einddatum,uitval,omschrijving) VALUES (?,?,?,?)");
                    $stmt->execute(array($begindatum, $einddatum, $uitval, $omschrijving));
                    $row2 = $stmt->fetch(PDO::FETCH_ASSOC);
                    $res2 = $stmt->rowCount();
                    if ($res2 > 0) {
                         //feedback aan gebruiker geven
                         print("De boeking " . $omschrijving . " is toegevoegd.");
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
                              ?>
                              <td class="text-center">
                                   <?php print ($weekDay); ?>
                              </td>
                              <?php
                         }
                         ?>
                    </tr>
                    <tr>
                         <?php
                         for ($i = 0; $i < $blank; $i++) {
                              print("<td></td>");
                         }

                         $stmt3 = $pdo->prepare("SELECT * FROM blokkade
                         WHERE Year(begindatum) = ?
                         AND Month(begindatum) = ?
                         ORDER BY einddatum");
                         $stmt3->execute(array($_SESSION['jaarnummer'], $_SESSION['maandnummer']));

                         $objArray = array();
                         while ($row3 = $stmt3->fetch()) {
                              $sDayStart = date('j', strtotime($row3['begindatum']));
                              $sDayEnd = date('j', strtotime($row3['einddatum']));

                              for ($i = $sDayStart; $i <= $sDayEnd; $i++) {
                                   $objArray[$i . "omschrijving"] = $row3['omschrijving'];
                                   $uitval = $row3["uitval"];
                                   if ($uitval == $aantalMotoren) {
                                        $objArray[$i . "uitval"] = "Geen motoren beschikbaar";
                                   } elseif ($uitval > 0) {
                                        $objArray[$i . "uitval"] = $uitval . " motor(en) niet beschikbaar";
                                   }

                              }
                         }

                         for ($i = 1; $i <= $daysInMonth; $i++) {

                              if (($i + $blank) % 7 != 0) {
                                   print ("<td>");
                                   if (isset($objArray[$i . "omschrijving"])) {
                                        print ($i . ": " . $objArray[$i . "omschrijving"] . "<br>" . $objArray[$i . "uitval"]);
                                   } else {
                                        print ($i);
                                   }
                                   print ("</td>");
                              }
                              if (($i + $blank) % 7 == 0) {
                                   print ("<td><a href='http://" . $_SERVER['HTTP_HOST'] . "/GFY1-03/admin/beheerpaneel.php?beheer=Agenda&dag={$i}'>");
                                   if (isset($objArray[$i . "omschrijving"])) {
                                        print ($i . ": " . $objArray[$i . "omschrijving"] . "<br>" . $objArray[$i . "uitval"]);
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
                         <label for="inputdatum1" class="col-md-2 control-label">Begindatum</label>

                         <div class="col-md-10">
                              <input type="date" name="begindatum"

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
                              <input type="date" name="einddatum"
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
     <br><br>




     <?php

     $pdo = NULL;
     ?>
</div>
</body>
</html>
