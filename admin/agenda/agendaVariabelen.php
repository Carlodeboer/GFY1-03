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
     unset($_GET["dag"]);
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
$dayOfWeek = date('D', $firstDay);
$daysInMonth = cal_days_in_month(0, $maand, $jaar);

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
     $stmt5 = $pdo->prepare("SELECT * FROM reserveringen WHERE Year(begindatum) = ? AND (Month(begindatum) = ? OR (Month(begindatum) = ? AND day(begindatum) >= 22)) AND actief = 1 ORDER BY idReservering DESC;");
     $stmt5->execute(array($_SESSION['jaarnummer'], $_SESSION['maandnummer'], $_SESSION['maandnummer'] - 1));
} else {
     $stmt5 = $pdo->prepare("SELECT * FROM reserveringen WHERE (Year(begindatum) = ? AND Month(begindatum) = ?) OR (Year(begindatum) = ? AND Month(begindatum) = ? AND day(begindatum) >= 22) AND actief = 1 ORDER BY idReservering DESC;");
     $stmt5->execute(array($_SESSION['jaarnummer'], $_SESSION['maandnummer'], $_SESSION['jaarnummer'] -1, 12));
}

$objArray = array();
while ($row5 = $stmt5->fetch()) {
     $uitval = $row5["aantal"];
     $begindatum = strtotime($row5['begindatum']);
     $einddatum = strtotime("+6 day", $begindatum);

     $begindag = date('j', $begindatum);
     $einddag = date('j', $einddatum);

     $maand1 = date('n', $einddatum);
     $maand2 = date('n', $begindatum);

     if ($maand1 != $_SESSION["maandnummer"]) {
          $einddag = $daysInMonth;
     }

     if ($maand2 != $_SESSION["maandnummer"]) {
          $begindag = 1;
     }
     $stmt6 = $pdo->prepare("SELECT omschrijving FROM blokkade WHERE begindatum = ? AND uitval > 0 ORDER BY idReservering DESC");
     $stmt6->execute(array($row5["begindatum"]));
     $row6 = $stmt6->fetch();

     if (!($maand2 != $_SESSION["maandnummer"] && $einddag > 6)) {
          for ($i = $begindag; $i <= $einddag; $i++) {
               if (isset($objArray[$i . "uitval"])) {
                    $objArray[$i . "uitval"] = $objArray[$i . "uitval"] - $uitval;
               } else {
                    $objArray[$i . "uitval"] = $aantalMotoren - $uitval;
               }
               if (!isset($objArray[$i . "omschrijving"])) {
                    $objArray[$i . "omschrijving"] = $row6['omschrijving'];
               }
               if (!isset($objArray[$i . "omschrijving"])) {
                    $objArray[$i . "omschrijving"] = "Boeking";
               }
          }
     }
}
?>
