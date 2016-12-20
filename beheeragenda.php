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

<br><br>
        <div class="row">
            <div class="col-md-8">
                <table id="calendar">

                    <tr>
                        <th colspan="7"><div class="row"> <div class="col-md-2">
                                    <form method="POST">
                                        <input type="submit" name="vorige" value="Vorige" class="btn btn-raised btn-primary">
                                        </div>

                                        <div class="col-md-8"><?php print("{$title} {$year}"); ?>
                                        </div>

                                        <div class="col-md-2"> 
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
                                                echo $i . ": " . $objArray[$i];
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

                                <div class="col-md-4">

                                    <form method="post">
                                        <div class="form-group">
                                            <label for="inputomschrijving" class="col-md-2 control-label">Omschrijving</label>

                                            <div class="col-md-10">
                                                <input type="text" name="omschrijving" class="form-control" id="inputomschrijving">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="inputdatum1" class="col-md-2 control-label">Begindatum</label>

                                            <div class="col-md-10">
                                                <input type="date" name="begindatum" class="form-control" id="inputdatum1">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="inputdatum2" class="col-md-2 control-label">Einddatum</label>

                                            <div class="col-md-10">
                                                <input type="date" name="einddatum" class="form-control" id="inputdatum2">
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <label for="select111" class="col-md-2 control-label">Status</label>

                                            <div class="col-md-10">
                                                <select name="status" id="select111" class="form-control">
                                                    <option value="1">Boeking</option>
                                                    <option value="2">Privé</option>
                                                </select>
                                            </div>
                                        </div> <br><br>
                                        <input class="btn btn-raised btn-primary" type="submit" name="invoeren" value="Invoeren">

                                    </form>

                                </div>
                            </div>
                            <br><br>




<?php
if (isset($_POST['invoeren'])) {
    $omschrijving = $_POST['omschrijving'];
    $begindatum = $_POST['begindatum'];
    $einddatum = $_POST['einddatum'];
    $status = $_POST['status'];

    if ($omschrijving == "") {
        print("Voer een omschrijving in.");
    } elseif ($begindatum == "") {
        print("Voer een begindatum in.");
    } elseif ($einddatum == "") {
        print("Voer een einddatum in.");
    } elseif ($status == "") {
        print("Selecteer een status.");
    } else {
        // $stmt2 = $pdo->prepare("SELECT * FROM beschikbaarheid WHERE (begindatum BETWEEN ? AND ?)
        // 															(AND einddatum BETWEEN ? AND ?)");
        $stmt2 = $pdo->prepare("SELECT * FROM beschikbaarheid WHERE begindatum >= ? AND einddatum <= ?");
        // $stmt2 = $pdo->prepare("SELECT * FROM beschikbaarheid WHERE begindatum BETWEEN ? AND ?");
        $stmt2->execute(array($begindatum,$einddatum));
		$userRow = $stmt2->fetch(PDO::FETCH_ASSOC);
        $res2 = $stmt2->rowCount();
        if ($res2 > 0) {
        	print("Deze bestaat al");
        	exit;
        } else {

        $stmt = $pdo->prepare("INSERT INTO beschikbaarheid (omschrijving,begindatum,einddatum,status) VALUES (?,?,?,?)");
        $stmt->execute(array($omschrijving, $begindatum, $einddatum, $status));
        $userRow = $stmt->fetch(PDO::FETCH_ASSOC);
        $res = $stmt->rowCount();
        if ($res > 0) {
            //feedback aan gebruiker geven
            print("De boeking " . $omschrijving . " is toegevoegd.");
        }
    }
    }
}
?>
                            </body>
                            </html>
