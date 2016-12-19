<!DOCTYPE html>
<html>
    <head>
        <title>Motorcross</title>
        <link type="text/css" rel="stylesheet" href="style/style.css">

    </head>
    <body>
    <form method="post">
        <select name="jaar">
            <option value="2016">2016</option>
            <option value="2017">2017</option>
            <option value="2018">2018</option>
            <option value="2019">2019</option>
        </select>
        <select name="maand">
            <option value="1">januari</option>
            <option value="2">februari</option>
            <option value="3">maart</option>
            <option value="4">april</option>
            <option value="5">mei</option>
            <option value="6">juni</option>
            <option value="7">juli</option>
            <option value="8">augustus</option>
            <option value="9">september</option>
            <option value="10">oktober</option>
            <option value="11">november</option>
            <option value="12">december</option>
        </select>
       <input type="submit" name="test" value="Ga">
        </form>
        <?php
        $pdo = newPDO();

        /* Set the default timezone */
        date_default_timezone_set("Europe/Amsterdam");

        /* Set the date */
        $date = strtotime(date("Y-m-d"));
        $day = date('d', $date);


        if(isset($_POST['jaar'])) {
        	$year = $_POST['jaar'];
        }

                if(isset($_POST['maand'])) {
        	$month = $_POST['maand'];
        }
        if(!isset($year)) {
        	$year = date('Y', $date);
        }
                if(!isset($month)) {
        	$month = date('m', $date);
        }

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
        <table id="calendar">
            <tr>
                <th colspan="7">

                <?php print("{$title} {$year}"); ?></th>
            </tr><tr>

<!-- Dit deel evt later nog toevoegen -->
<!--                         <tr>
                <th colspan="7"><div class="row"> <div class="col-md-2">

                <input type="submit" name="vorige" value="Vorige" class="btn btn-raised btn-primary"></div><div class="col-md-8"><?php print("{$title} {$year}"); ?></div><div class="col-md-2"> <input type="submit" name="volgende" value="Volgende" class="btn btn-raised btn-primary"></div></th>
            </tr><tr> -->


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
                $stmt->execute(array($year,$month));
                $resultaat = array();

                $objArray = array();
                while( $userRow = $stmt->fetch() ) {
                    $sDayStart 	= date('j', strtotime($userRow['begindatum']));
                    $sDayEnd 	= date('j', strtotime($userRow['einddatum']));

                    for($dd = $sDayStart; $dd <= $sDayEnd; $dd++) {
                    	$objArray[$dd] = $userRow['omschrijving'];
                    }
                }

                $y = 0;
                for ($i = 1; $i <= $daysInMonth; $i++) {

                	
                	echo "<td>";
                		if( isset($objArray[$i] ) ) {
                			echo $i . ": " . $objArray[$i];
                		}
                		else {
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
        <form method="post">
            Omschrijving: <input type="text" name="omschrijving"><br>
            Begindatum: <input type="date" name="begindatum"><br>
            Einddatum: <input type="date" name="einddatum"><br>
            Status:
            <select name="status">
                <option value="1">Boeking</option>
                <option value="2">Privé</option>
            </select>
            <input type="submit" name="verzenden" value="Invoeren">
        </form>

        <?php
        if (isset($_POST['verzenden'])) {
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
        ?>
    </body>
</html>
