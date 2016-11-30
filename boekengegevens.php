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
                    <form method="POST" action="boekengegevens.php">
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
                            <tr><td>Voornaam:</td><td><input type='text' name='voornaam<?php print ($i); ?>'></td></tr>
                            <tr><td>Achternaam:</td><td><input type='text' name='achternaam<?php print ($i); ?>'></td></tr>
                            <tr><td>Geboortedatum:</td><td><input type='text' name='geboortedatum<?php print ($i); ?>'></td></tr>
                            <tr><td>Straatnaam:</td><td><input type='text' name='straat<?php print ($i); ?>'></td></tr>
                            <tr><td>Huisnummer:</td><td><input type='number' name='huisnummer<?php print ($i); ?>'></td></tr>
                            <tr><td>Postcode:</td><td><input type='text' name='postcode<?php print ($i); ?>'></td></tr>
                            <tr><td>Woonplaats:</td><td><input type='text' name='woonplaats<?php print ($i); ?>'></td></tr>
                            <tr><td>Land:</td><td><input type='text' name='land<?php print ($i); ?>'></td></tr>
                            <?php
                        }
                        ?>
                        <tr><td><input type='submit' name='afronden' value='Afronden'></td></tr>
                    </form>
                </table>


                <?php
                include "functions.php";

                if (isset($_POST["afronden"])) {
                    for ($i = 1; $i <= $aantalPersonen; $i++) {
                        if ($_POST["voornaam" . $i] != "" || $_POST["achternaam" . $i] != "" || $_POST["straat" . $i] != "" || $_POST["huisnummer" . $i] != "" || $_POST["postcode" . $i] != "" || $_POST["woonplaats" . $i] != "" || $_POST["land" . $i] != "") {
                            ${"voornaam" . $i} = $_POST["voornaam" . $i];
                            $_SESSION["klantGegevens"]["voornaam" . $i] = ${"voornaam" . $i};
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
                            header("location:boekengegevenscheck.php");
                        } else {
                            print ("U dient uw gegevens correct in te vullen.");
                        }
                    }
                }
                ?>
            </div>
            <?php include 'footer.php'; ?>
        </div>
    </body>
</html>