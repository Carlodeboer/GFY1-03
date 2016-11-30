<!DOCTYPE html>
<html>
    <head>
        <title>Motorcross</title>
        <link type="text/css" rel="stylesheet" href="style/style.css">

        <script type="text/javascript">
            <!--
  status = 1;

            function changeStyle() {
                //Note the lowercase first letter.
                x = document.getElementById("text");

                if (status == 1) {
                    x.style.backgroundColor = 'grey';
                    status = 2;
                } else if (status == 2) {
                    x.style.backgroundColor = 'red';
                    status = 3;
                } else if (status == 3) {
                    x.style.backgroundColor = 'green';
                    status = 1;
                }

            }
            //-->
        </script>



    </head>
    <body>

        <select name="jaar">
            <option value="2016">2016</option>
            <option value="2017">2017</option>
            <option value="2018">2018</option>
            <option value="2019">2019</option>
        </select>

        <select name="maand">
            <option value="januari">januari</option>
            <option value="februari">februari</option>
            <option value="maart">maart</option>
            <option value="april">april</option>
            <option value="mei">mei</option>
            <option value="juni">juni</option>
            <option value="juli">juli</option>
            <option value="augustus">augustus</option>
            <option value="september">september</option>
            <option value="oktober">oktober</option>
            <option value="november">november</option>
            <option value="december">december</option>
        </select>


        <?php
        include "dbconnect.php";


        /* Set the default timezone */
        date_default_timezone_set("America/Montreal");

        /* Set the date */
        $date = strtotime(date("Y-m-d"));

        $day = date('d', $date);
        $month = date('m', $date);
        $year = date('Y', $date);
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
                    <?php print("{$title} {$year}"); ?> </th>
            </tr>
            <tr>
                <?php foreach ($weekDays as $key => $weekDay) { ?>
                    <td class="text-center">
                        <?php echo $weekDay ?>
                    </td>
                <?php } ?>
            </tr>
            <tr>

                <?php
                for ($i = 0; $i < $blank; $i++) {
                    print("<td></td>");
                }
                for ($i = 1; $i <= $daysInMonth; $i++) {
                    if ($day == $i) {
                        print("<td id='text' onclick='javascript:changeStyle();'><strong>huidig {$i} </strong></td>");
                    } else {




                        $stmt = $pdo->prepare("SELECT * FROM beschikbaarheid");
                        $stmt->execute();
                       $userRow = $stmt->fetch(PDO::FETCH_ASSOC); 
                        $date2 = strtotime($userRow['begindatum']);
                        $date3 = strtotime($userRow['einddatum']);
                        $vergelijkdatum = date('j', $date2);
                        $vergelijkdatumeind = date('j', $date3);

                        if ($i >= $vergelijkdatum && $i <= $vergelijkdatumeind) {
                            print("<td> {$i} {$userRow['omschrijving']} </td> ");
                        }
                        // var_dump($i);
                        else {
                            print("<td >{$i} </td>");
                        }



                       //  $stmt = $pdo->prepare("SELECT * FROM beschikbaarheid");
                       //  $stmt->execute();
                       // $userRow = $stmt->fetch(PDO::FETCH_ASSOC); 
                       //  $date2 = strtotime($userRow['begindatum']);
                       //  $date3 = strtotime($userRow['einddatum']);
                       //  $vergelijkdatum = date('j', $date2);
                       //  $vergelijkdatumeind = date('j', $date3);
                      //   if ($i >= $vergelijkdatum && $i <= $vergelijkdatumeind) {
                      //       print("<td> {$i} {$userRow['omschrijving']} </td> ");
                      //   }
                      //   // var_dump($i);
                      //   else {
                      //       print("<td >{$i}</td>");
                        
                      // }




                    }
                    if (($i + $blank) % 7 == 0) {
                        print("</tr><tr>");
                    }
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
            // $userRow=$stmt->fetch(PDO::FETCH_ASSOC);
        }
    }
}
?>








    </body>
</html>
