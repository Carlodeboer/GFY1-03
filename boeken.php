<?php define("toegang", true); ?>
<!DOCTYPE html>
<html>
<head>
     <title>Boeken</title>
     <?php include 'head.php'; ?>
</head>
<body>
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
                              <input type="date" name="begindatum" class="form-control" id="i5i" required>
                              <span class="help-block">Voer een begindatum in</span>
                         </div>
                         <div class="form-group label-static is-empty">
                              <label for="i5i" class="control-label">Einddatum*</label>
                              <input type="date" name="einddatum" class="form-control" id="i5i" required>
                              <span class="help-block">Voer een einddatum in</span>
                         </div>
                         <div class="form-group label-static is-empty">
                              <label for="i5i" class="control-label">Aantal personen*</label>
                              <select id="s1" class="form-control" name="aantalPersonen">
                                   <option value="1">1</option>
                                   <option value="2">2</option>
                                   <option value="3">3</option>
                                   <option value="4">4</option>
                              </select>
                         </div>
                         <div class="form-group label-static is-empty">
                              <label for="i5i" class="control-label">Vervoer van Luchthaven Portela (Lissabon)*</label>
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
                              <label for="i5i" class="control-label">Vervoer naar Luchthaven Portela (Lissabon)*</label>
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



        <?php
        $pdo = newPDO();
        date_default_timezone_set("Europe/Amsterdam");
        $date = strtotime(date("Y-m-d"));
        $day = date('d', $date);

        if (!isset($year)) {
            $year = date('Y', $date);
        }
        if (!isset($month)) {
            $month = date('m', $date);
        }

        if (!isset($_SESSION['jaarnummer'])) {
            $_SESSION['jaarnummer'] = date('Y', $date);
        }


        if (!isset($_SESSION['maandnummer'])) {
            $_SESSION['maandnummer'] = date('m', $date);
        }


        if (isset($_POST['volgende'])) {
            ++$_SESSION['maandnummer'];
            if ($_SESSION['maandnummer'] > 12) {
                $_SESSION['maandnummer'] = 1;
                $_SESSION['jaarnummer'] ++;
            }
        }

        if (isset($_POST['vorige'])) {
            --$_SESSION['maandnummer'];
            if ($_SESSION['maandnummer'] < 1) {
                $_SESSION['jaarnummer'] --;
                $_SESSION['maandnummer'] = 12;
            }
        }

        $month = $_SESSION['maandnummer'];
        $year = $_SESSION['jaarnummer'];

        $firstDay = mktime(0, 0, 0, $month, 1, $year);
        $title = strftime('%B', $firstDay);
        $dayOfWeek = date('D', $firstDay);
        $daysInMonth = cal_days_in_month(0, $month, $year);
        /* Get the name of the week days */
        $timestamp = strtotime('next Sunday');
        $weekDays = array();
        for ($i = 0; $i < 7; $i++) {
            $weekDays[] = strftime('%a', $timestamp);
            $timestamp = strtotime('+1 day', $timestamp);
        }
        $blank = date('w', strtotime("{$year}-{$month}-01"));
        ?>


<div class="col-md-8">
                <table id="calendar">

                    <tr>
                        <th colspan="7">
                                    <form method="POST">
                                        <input type="submit" name="vorige" value="Vorige" class="btn btn-raised btn-primary">
                                        </div>

                                        <div class="col-md-6"><?php print("{$title} {$year}"); ?>
                                        </div>

                                            <input type="submit" name="volgende" value="Volgende" class="btn btn-raised btn-primary">
                                        </div>

                                        </th>

                                    </form>
                                    </tr>
                                    <tr>


<?php foreach ($weekDays as $key => $weekDay) { ?>
                                            <td class="text-center">
                                            <?php echo $weekDay ?>
                                            </td>
                                            <?php } ?>
                                    </tr><tr>
                                        <?php
                                        for ($i = 0; $i < $blank; $i++) {
                                            print("<td></td>");
                                        }

                                        $stmt = $pdo->prepare("SELECT * FROM beschikbaarheid
                                        WHERE Year(begindatum) = ?
                                        AND Month(begindatum) = ?
                                        ORDER BY einddatum");
                                        $stmt->execute(array($_SESSION['jaarnummer'], $_SESSION['maandnummer']));

                                        $objArray = array();
                                        while ($userRow = $stmt->fetch()) {
                                            $sDayStart = date('j', strtotime($userRow['begindatum']));
                                            $sDayEnd = date('j', strtotime($userRow['einddatum']));

                                            for ($dd = $sDayStart; $dd <= $sDayEnd; $dd++) {
                                                $objArray[$dd] = $userRow['omschrijving'];
                                            }
                                        }

                                        $y = 0;
                                        for ($i = 1; $i <= $daysInMonth; $i++) {


                                            echo "<td>";
                                            if (isset($objArray[$i])) {
                                                echo "<span style='color:lightgrey'>" . $i . ": Niet beschikbaar </span>" ;
                                            } else {
                                                echo $i;
                                            }


                                            echo "</td>";

                                            if (($i + $blank) % 7 == 0) {
                                                echo "</tr><tr>";
                                            }

                                            $y++;
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
