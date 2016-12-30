<?php define("toegang", true); ?>
<!DOCTYPE html>
<html>
<head>
     <title>Boeken</title>
     <?php include 'head.php'; ?>
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
                    $uitval = $row5["uitval"];
                    if (isset($objArray[$i . "uitval"])) {
                         $objArray[$i . "uitval"] = $objArray[$i . "uitval"] - $uitval;
                    } else {
                         $objArray[$i . "uitval"] = $aantalMotoren - $uitval;
                    }
               }
          }
     }
     ?>
     <div id="container">
          <?php include 'header.php'; ?>
          <div id="content">
               <div id="contentwrapper">
                    <h2>Boeken</h2>

                    <div class="row">
                         <div class="col-md-4">

                              <form method="POST" action="boekengegevens.php" class="form-horizontal">
                                   <div class="form-group label-static is-empty">
                                        <label for="i5i" class="control-label">Begindatum*</label>

                                        <input type="date" name="begindatum" readonly required

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
                                        <span class="help-block">Voer een begindatum in</span>
                                   </div>


                                   <div class="form-group label-static is-empty">
                                        <label for="i5i" class="control-label">Einddatum*</label>


                                        <input type="date" name="einddatum" readonly required
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
                                        class="form-control" id="i5i">
                                        <span class="help-block">Voer een einddatum in</span>

                                   </div>

                                   <div class="form-group label-static is-empty">
                                        <label for="i5i" class="control-label">Aantal personen*</label>
                                        <select id="s1" class="form-control" name="aantalPersonen">
                                             <?php
                                             if (!(isset($objArray[$_GET["dag"] . "uitval"]))) {
                                                  $objArray[$_GET["dag"] . "uitval"] = 0;
                                             }
                                             for ($i = 1; $i <= ($aantalMotoren - $objArray[$_GET["dag"] . "uitval"]); $i++) {
                                                  print ("<option value='{$i}'>{$i}</option>");
                                             }
                                             ?>

                                        </select>
                                   </div>
                                   <div class="form-group label-static is-empty">
                                        <label for="i5i" class="control-label">Vervoer van Luchthaven Lissabon*</label>
                                        <div class="radio">
                                             <label>
                                                  <input type="radio" name="vervoerHeen" value="1" checked> Ja
                                             </label>
                                        </div>
                                        <div class="radio">
                                             <label>
                                                  <input type="radio" name="vervoerHeen" value="0"> Nee
                                             </label>
                                        </div>
                                   </div>
                                   <div class="form-group label-static is-empty">
                                        <label for="i5i" class="control-label">Vervoer naar Luchthaven Lissabon*</label>
                                        <div class="radio">
                                             <label>
                                                  <input type="radio" name="vervoerTerug" value="1" checked> Ja
                                             </label>
                                        </div>
                                        <div class="radio">
                                             <label>
                                                  <input type="radio" name="vervoerTerug" value="0"> Nee
                                             </label>
                                        </div>
                                   </div>
                                   <div class="form-group label-static is-empty">
                                        <label for="i5i" class="control-label">Locatie van overnachting*</label>
                                        <div class="radio">
                                             <label>
                                                  <input type="radio" name="locatie" value="standaard" checked=""> Standaard locatie
                                             </label>
                                        </div>
                                        <div class="radio">
                                             <label>
                                                  <input type="radio" name="locatie" value=""> Anders, namelijk:
                                             </label><label>
                                                  <input type="text" name="nieuweLocatie" class="form-control">
                                             </label>
                                        </div>
                                   </div>
                                   <div class="form-group label-static is-empty">
                                        <label for="i5i" class="control-label">Opmerkingen</label>
                                        <textarea name="opmerkingen" class="form-control"></textarea>
                                   </div>
                                   <div class="form-group label-static is-empty">
                                        <label for="i5i" class="control-label">Vakantienaam*</label>
                                        <input type="text" name="vakantienaam" class="form-control" id="i5i" required>
                                        <span class="help-block">Deze naam gebruikt u later om uw reisgegevens in te zien. Deze gegevens zou u ook eventueel kunnen delen met reisgenoten.</span>
                                   </div>
                                   <div class="form-group label-static is-empty">
                                        <input type="submit" name="volgende" value="Volgende" class="btn btn-raised btn-primary">
                                   </div>
                              </form>
                         </div>
                         <!-- </div> -->



                         <div class="col-md-8">
                              <table id="calendar">

                                   <tr>
                                        <th colspan="7">
                                             <form method="POST">
                                                  <input type="submit" name="vorige" value="Vorige" class="btn btn-raised btn-primary">
                                             </div>

                                             <div class="col-md-6"><?php print("{$title} {$jaar}"); ?>
                                             </div>

                                             <input type="submit" name="volgende" value="Volgende" class="btn btn-raised btn-primary">
                                        </div>

                                   </th>

                              </form>
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


                              for ($i = 1; $i <= $daysInMonth; $i++) {

                                   if (($i + $blank) % 7 != 0) {
                                        print ("<td>");
                                        if (isset($objArray[$i . "uitval"])) {
                                             print ($i . ":<br>" . $objArray[$i . "uitval"] . " motor(en) beschikbaar");
                                        } else {
                                             print ($i);
                                        }
                                        print ("</td>");
                                   }
                                   if (($i + $blank) % 7 == 0) {
                                        print ("<td><a href='http://" . $_SERVER['HTTP_HOST'] . "/GFY1-03/boeken.php?&dag={$i}'>");
                                        if (isset($objArray[$i . "omschrijving"])) {
                                             print ($i . ":<br>" . $objArray[$i . "uitval"] . " motor(en) beschikbaar");
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
          </div>
     </div>
</div>

<?php include 'footer.php'; ?>
</div>
<script>
$.material.init();
</script>
</body>
</html>
