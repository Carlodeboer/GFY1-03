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
<div id="contentwrapper">
<?php
    include "../toegang.php";
    $pdo = newPDO();
    //idbericht, voornaam, achternaam, email, telefoonnummer, onderwerp, bericht, datum
     //$berichten = $pdo->prepare("SELECT * FROM contactformulier WHERE email = $_POST['email']");
     //$result = mysql_query($berichten);
     if (isset($_SESSION["email"])&&$_SESSION["email"]!="") {
         $email = $_SESSION['email'];
         if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
             print($emailErr = "Geen valide emailadres ingevoerd, <a href=\"beheerpaneel.php?beheer=Berichtopvraag\">probeer opnieuw.</a>");
         }
         $stmt = $pdo->prepare("SELECT * FROM contactformulier WHERE email=?");
         $stmt->execute(array($email));
         while ($row = $stmt->fetch()){
             $voornaam = $row["voornaam"];
             $achternaam = $row["achternaam"];
             $email = $row["email"];
             $telefoonnummer = $row["telefoonnummer"];
             $onderwerp = $row["onderwerp"];
             $bericht = $row["bericht"];
             $datum = $row["datum"];

        if($telefoonnummer != ""){
            echo("<strong>Bericht:</strong> <br> $voornaam  $achternaam <br> $email <br> $telefoonnummer <br> $datum <br> <strong>$onderwerp</strong> <br> $bericht<br> <br>");
        } else {
            echo("<strong>Bericht:</strong> <br> $voornaam  $achternaam <br> $email <br> $datum <br> <strong>$onderwerp</strong> <br> $bericht<br> <br>");            }
        }
    }
?>
</div>
