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
                <table>
                    <form method="POST" action="boekengegevenscheck.php">
                        <tr>
                            <td><h2>Gegevens</h2></td>
                        </tr>
                        <?php
                        session_start();
                        extract($_SESSION["klantGegevens"]);
                        for ($i = 1; $i <= $aantalPersonen; $i++) {
                            if ($aantalPersonen != 1) {
                                print("<tr><td><h3>Persoon " . $i . ":</h3></td></tr>");
                            }
                            ?>
                            <tr><td>Voornaam* :</td><td><input type='text' name='voornaam<?php print ($i); ?>'<?php
                                    if (isset($_POST["voornaam" . $i])) {
                                        print (" value=" . $_POST["voornaam" . $i]);
                                    }
                                    ?>></td></tr>
                            <tr><td>Achternaam* :</td><td><input type='text' name='achternaam<?php print ($i); ?>'<?php
                                    if (isset($_POST["achternaam" . $i])) {
                                        print (" value=" . $_POST["achternaam" . $i]);
                                    }
                                    ?>></td></tr>
                            <tr><td>Geboortedatum* :</td><td><input type='text' name='geboortedatum<?php print ($i); ?>'<?php
                                    if (isset($_POST["geboortedatum" . $i])) {
                                        print (" value=" . $_POST["geboortedatum" . $i]);
                                    }
                                    ?>></td></tr>
                            <tr><td>Straatnaam* :</td><td><input type='text' name='straat<?php print ($i); ?>'<?php
                                    if (isset($_POST["straat" . $i])) {
                                        print (" value=" . $_POST["straat" . $i]);
                                    }
                                    ?>></td></tr>
                            <tr><td>Huisnummer* :</td><td><input type='number' name='huisnummer<?php print ($i); ?>'<?php
                                    if (isset($_POST["huisnummer" . $i])) {
                                        print (" value=" . $_POST["huisnummer" . $i]);
                                    }
                                    ?>></td></tr>
                            <tr><td>Postcode* :</td><td><input type='text' name='postcode<?php print ($i); ?>'<?php
                                    if (isset($_POST["postcode" . $i])) {
                                        print (" value=" . $_POST["postcode" . $i]);
                                    }
                                    ?>></td></tr>
                            <tr><td>Woonplaats* :</td><td><input type='text' name='woonplaats<?php print ($i); ?>'<?php
                                    if (isset($_POST["woonplaats" . $i])) {
                                        print (" value=" . $_POST["woonplaats" . $i]);
                                    }
                                    ?>></td></tr>
                            <tr><td>Land* :</td><td><input type='text' name='land<?php print ($i); ?>'<?php
                                    if (isset($_POST["land" . $i])) {
                                        print (" value=" . $_POST["land" . $i]);
                                    }
                                    ?>></td></tr>
                            <tr><td>Telefoonnummer* :</td><td><input type='text' name='woonplaats<?php print ($i); ?>'<?php
                                    if (isset($_POST["telefoonnummer" . $i])) {
                                        print (" value=" . $_POST["telefoonnummer" . $i]);
                                    }
                                    ?>></td></tr>
                                <?php
                            }
                            ?>



                        <?php
                        include "functions.php";


                        for ($i = 1; $i <= $aantalPersonen; $i++) {
                            if ($_POST["voornaam" . $i] != "" && $_POST["achternaam" . $i] != "" && $_POST["straat" . $i] != "" && $_POST["huisnummer" . $i] != "" && $_POST["postcode" . $i] != "" && $_POST["woonplaats" . $i] != "" && $_POST["land" . $i] != "") {
                                toevoegenaanarray("voornaam", "klantGegevens", $i);
                                ${"achternaam" . $i} = $_POST["achternaam" . $i];
                                $_SESSION["klantGegevens"]["achternaam" . $i] = ${"achternaam" . $i};
                                ${"geboortedatum" . $i} = $_POST["geboortedatum" . $i];
                                $_SESSION["klantGegevens"]["geboortedatum" . $i] = ${"geboortedatum" . $i};
                                ${"straat" . $i} = $_POST["straat" . $i];
                                $_SESSION["klantGegevens"]["straat" . $i] = ${"straat" . $i};
                                ${"huisnummer" . $i} = $_POST["huisnummer" . $i];
                                $_SESSION["klantGegevens"]["huisnummer" . $i] = ${"huisnummer" . $i};
                                ${"postcode" . $i} = $_POST["postcode" . $i];
                                $_SESSION["klantGegevens"]["postcode" . $i] = ${"postcode" . $i};
                                ${"woonplaats" . $i} = $_POST["woonplaats" . $i];
                                $_SESSION["klantGegevens"]["woonplaats" . $i] = ${"woonplaats" . $i};
                                ${"land" . $i} = $_POST["land" . $i];
                                $_SESSION["klantGegevens"]["land" . $i] = ${"land" . $i};
                                toevoegenaanarray("telefoonnummer", "klantGegevens", $i);
                                if ($i == $aantalPersonen) {
                                    header("location:boekengegevenscheck.php");
                                }
                            } else {
                                if ($i == $aantalPersonen) {
                                    print ("U dient uw gegevens correct in te vullen.");
                                }
                            }
                        }
                        ?>
                        <tr><td><input type='submit' name='afronden' value='Afronden'></td></tr>
                    </form>
                </table>
            </div>
            <?php include 'footer.php'; ?>
        </div>
    </body>
</html>