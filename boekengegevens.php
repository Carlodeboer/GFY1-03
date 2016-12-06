<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Gegevens</title>
        <?php include 'head.php'; ?>
    </head>
    <body>
        <div id="container">
            <?php include 'header.php'; ?>
            <div id="content">
                <?php
                session_start();
                $aantalPersonen = $_GET["aantalPersonen"];
                $vervoerHeen = $_GET["heen"];
                $vervoerTerug = $_GET["terug"];
                $locatie = $_GET["locatie"];
                if ($_GET["nieuweLocatie"] != "") {
                    $locatie = $_GET["nieuweLocatie"];
                }

                if ($_GET["opmerkingen"] != "") {
                    $opmerkingen = $_GET["opmerkingen"];
                } else {
                    $opmerkingen = NULL;
                }

                $vakantienaam = $_GET["vakantienaam"];
                $klantGegevensArray = array("aantalPersonen" => $aantalPersonen, "vervoerHeen" => $vervoerHeen, "vervoerTerug" => $vervoerTerug, "locatie" => $locatie, "opmerkingen" => $opmerkingen, "vakantienaam" => $vakantienaam);

                if (isset($_SESSION["klantGegevens"])) {
                    session_unset($_SESSION["klantGegevens"]);
                }
                $_SESSION["klantGegevens"] = $klantGegevensArray;
                ?>
                <table>
                    <form method = "GET" action = "boekengegevenscheck.php">
                        <tr>
                            <td><h2>Gegevens</h2></td>
                        </tr>
                        <?php
                        for ($i = 1; $i <= $aantalPersonen; $i++) {
                            if ($aantalPersonen != 1) {
                                print("<tr><td><h3>Persoon " . $i . ":</h3></td></tr>");
                            }
                            ?>
                            <tr><td>Voornaam* :</td><td><input type='text' name='voornaam<?php print ($i); ?>'<?php
                                    if (isset($_GET["voornaam" . $i])) {
                                        print (" value=" . $_GET["voornaam" . $i]);
                                    }
                                    ?> required></td></tr>
                            <tr><td>Achternaam* :</td><td><input type='text' name='achternaam<?php print ($i); ?>'<?php
                                    if (isset($_GET["achternaam" . $i])) {
                                        print (" value=" . $_GET["achternaam" . $i]);
                                    }
                                    ?> required></td></tr>
                            <tr><td>Geboortedatum* :</td><td><input type='text' name='geboortedatum<?php print ($i); ?>'<?php
                                    if (isset($_GET["geboortedatum" . $i])) {
                                        print (" value=" . $_GET["geboortedatum" . $i]);
                                    }
                                    ?> required></td></tr>
                            <tr><td>Straatnaam* :</td><td><input type='text' name='straat<?php print ($i); ?>'<?php
                                    if (isset($_GET["straat" . $i])) {
                                        print (" value=" . $_GET["straat" . $i]);
                                    }
                                    ?> required></td></tr>
                            <tr><td>Huisnummer* :</td><td><input type='number' name='huisnummer<?php print ($i); ?>'<?php
                                    if (isset($_GET["huisnummer" . $i])) {
                                        print (" value=" . $_GET["huisnummer" . $i]);
                                    }
                                    ?> required></td></tr>
                            <tr><td>Postcode* :</td><td><input type='text' name='postcode<?php print ($i); ?>'<?php
                                    if (isset($_GET["postcode" . $i])) {
                                        print (" value=" . $_GET["postcode" . $i]);
                                    }
                                    ?> required></td></tr>
                            <tr><td>Woonplaats* :</td><td><input type='text' name='woonplaats<?php print ($i); ?>'<?php
                                    if (isset($_GET["woonplaats" . $i])) {
                                        print (" value=" . $_GET["woonplaats" . $i]);
                                    }
                                    ?> required></td></tr>
                            <tr><td>Land* :</td><td><input type='text' name='land<?php print ($i); ?>'<?php
                                    if (isset($_GET["land" . $i])) {
                                        print (" value=" . $_GET["land" . $i]);
                                    }
                                    ?> required></td></tr>
                            <tr><td>Telefoonnummer* :</td><td><input type='text' name='telefoonnummer<?php print ($i); ?>'<?php
                                    if (isset($_GET["telefoonnummer" . $i])) {
                                        print (" value=" . $_GET["telefoonnummer" . $i]);
                                    }
                                    ?> required></td></tr>
                                <?php
                            }
                            ?>
                        <tr><td><input type='submit' name='afronden' value='Afronden' class="btn-main"></td></tr>
                    </form>
                </table>
            </div>
            <?php include 'footer.php'; ?>
        </div>
    </body>
</html>