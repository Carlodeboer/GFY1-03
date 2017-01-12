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
date_default_timezone_set("Europe/Amsterdam");
$date = strtotime(date("Y-m-d"));
$day = date('d', $date);
//Jaarnummer definiëren
if (!isset($_SESSION['jaarnummer'])) {
     $_SESSION['jaarnummer'] = date('Y', $date);
}
//Maandnummer definiëren
if (!isset($_SESSION['maandnummer'])) {
     $_SESSION['maandnummer'] = date('m', $date);
}
//Volgende maand weergeven
if (isset($_POST['volgende'])) {
     unset($_GET["dag"]);
     ++$_SESSION['maandnummer'];
     if ($_SESSION['maandnummer'] > 12) {
          $_SESSION['maandnummer'] = 1;
          $_SESSION['jaarnummer']++;
     }
}
//Vorige maand weergeven
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

//Kijken welke dag bij welke datum hoort, varibele voor aantal dagen in een maand definiëren
$firstDay = mktime(0, 0, 0, $maand, 1, $jaar);
$dayOfWeek = date('D', $firstDay);
$daysInMonth = cal_days_in_month(0, $maand, $jaar);

$timestamp = strtotime('next Sunday');
// $weekDays = array();
// for ($i = 0; $i < 7; $i++) {
//      $weekDays[] = strftime('%a', $timestamp);
//      $timestamp = strtotime('+1 day', $timestamp);
// }
$blank = date('w', strtotime("{$jaar}-{$maand}-01"));
// Totale aantal motoren uit database halen.
$stmt1 = $pdo->prepare("SELECT waarde FROM instellingen WHERE instelling = 'aantalMotoren';");
$stmt1->execute(array());
$row1 = $stmt1->fetch();
$aantalMotoren = $row1["waarde"];
// Als het geen januari is worden alle reserveringen uit de database gehaald van de geselecteerde maand en van de vorige maand waar de dag van de begindatum groter is dan 22.
// Alleen actieve reserveringen worden opgehaald, als een boeking geannuleerd is gaat deze op '0'.
if ($_SESSION["maandnummer"] != 1) {
     $stmt5 = $pdo->prepare("SELECT * FROM reserveringen WHERE Year(begindatum) = ? AND (Month(begindatum) = ? OR (Month(begindatum) = ? AND day(begindatum) >= 22)) AND actief = 1 ORDER BY idReservering DESC;");
     $stmt5->execute(array($_SESSION['jaarnummer'], $_SESSION['maandnummer'], $_SESSION['maandnummer'] - 1));
}
// Als het januari is wordt het jaar aangepast voor het goed ophalen van de gegevens van de eerste dagen van de maand.
else {
     $stmt5 = $pdo->prepare("SELECT * FROM reserveringen WHERE (Year(begindatum) = ? AND Month(begindatum) = ?) OR (Year(begindatum) = ? AND Month(begindatum) = ? AND day(begindatum) >= 22) AND actief = 1 ORDER BY idReservering DESC;");
     $stmt5->execute(array($_SESSION['jaarnummer'], $_SESSION['maandnummer'], $_SESSION['jaarnummer'] -1, 12));
}
// Lege array, wordt langzaamaan gevuld.
$objArray = array();
while ($row5 = $stmt5->fetch()) {
     $uitval = $row5["aantal"];
     $begindatum = strtotime($row5['begindatum']);
     // Einddatum is 6 dagen na de begindatum.
     $einddatum = strtotime("+6 day", $begindatum);

     $begindag = date('j', $begindatum);
     $einddag = date('j', $einddatum);

     $maand1 = date('n', $einddatum);
     $maand2 = date('n', $begindatum);
     // Als het maandnummer van de einddatum ongelijk is aan het maandnummer van die maand wordt de einddag gelijk gesteld aan het aantal dagen in de maand.
     if ($maand1 != $_SESSION["maandnummer"]) {
          $einddag = $daysInMonth;
     }
     // Als het maandnummer van de begindatum ongelijk is aan het maandnummer van die maand wordt de begindag gelijk gesteld aan de eerste van de maand.
     if ($maand2 != $_SESSION["maandnummer"]) {
          $begindag = 1;
     }
     // Als er op de dag ook nog een blokkade is toegevoegd door de beheerder, wordt deze later ook toegevoegd.
     $stmt6 = $pdo->prepare("SELECT omschrijving FROM blokkade WHERE begindatum = ? AND uitval > 0 ORDER BY idReservering DESC");
     $stmt6->execute(array($row5["begindatum"]));
     $row6 = $stmt6->fetch();

     // Als het maandnummer van de einddatum ongelijk is aan het maandnummer van de maand en de einddag groter is dan zes, dan valt de vakantie buiten de
     // kalender en wordt hij niet toegevoegd aan de array
     if (!($maand2 != $_SESSION["maandnummer"] && $einddag > 6)) {
          // voor elke losse begindag wordt er een element aan de array toegevoegd.
          for ($i = $begindag; $i <= $einddag; $i++) {
               // Als er al uitval is toegevoegd op de dag dan wordt het nieuwe 'uitval' daarvan af gehaald.
               if (isset($objArray[$i . "uitval"])) {
                    $objArray[$i . "uitval"] = $objArray[$i . "uitval"] - $uitval;
               }
               // Anders is het het totalte aantal motoren - 'uitval'.
               else {
                    $objArray[$i . "uitval"] = $aantalMotoren - $uitval;
               }
               // Als er al nog geen osmchrijving is toegevoegd wordt die toegevoegd, anders blijft de allereerste omschrijving staan.
               if (!isset($objArray[$i . "omschrijving"])) {
                    $objArray[$i . "omschrijving"] = $row6['omschrijving'];
               }
               // Als er geen omschijving is gevonden, wordt "Boeking" meegegeven.
               if (!isset($objArray[$i . "omschrijving"])) {
                    $objArray[$i . "omschrijving"] = "Boeking";
               }
          }
     }
}
?>
