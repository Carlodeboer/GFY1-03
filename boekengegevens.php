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
                        </tr><tr>
                            <td>Voornaam:</td>
                            <td><input type="text" name="voornaam"></td>
                        </tr><tr>
                            <td>Achternaam:</td>
                            <td><input type="text" name="achternaam"></td>
                        </tr><tr>
                            <td>Straatnaam:</td>
                            <td><input type="text" name="straat"></td>
                        </tr><tr>
                            <td>Huisnummer:</td>
                            <td><input type="number" name="huisnummer"></td>
                        </tr><tr>
                            <td>Postcode:</td>
                            <td><input type="text" name="postcode"></td>
                        <tr><td>Woonplaats:</td>
                            <td><input type="text" name="woonplaats"></td>
                        </tr><tr>
                            <td>Land:</td>
                            <td><input type="text" name="land"></td>
                        </tr><tr>
                            <td><input type="submit" name="afronden" value="Afronden"></td>
                        </tr>
<<<<<<< HEAD
=======
                        <?php
                        session_start();
                        extract($_SESSION["klantGegevens"]);
                        for ($i = 1; $i <= $aantalPersonen; $i++) {
                            if ($aantalPersonen != 1) {
                                print("<tr><td><h3>Persoon " . $i . ":</h3></td></tr>");
                            }
                            ?>
                            <tr><td>Voornaam:</td><td><input type='text' name='voornaam<?php
                                    print ($i);
                                    if (isset($_POST["voornaam"])) {
                                        print (" value=" . $_POST["voornaam"]);
                                    }
                                    ?>'></td></tr>
                            <tr><td>Achternaam:</td><td><input type='text' name='achternaam<?php
                                    print ($i);
                                    if (isset($_POST["achternaam"])) {
                                        print (" value=" . $_POST["achternaam"]);
                                    }
                                    ?>'></td></tr>
                            <tr><td>Geboortedatum:</td><td><input type='text' name='geboortedatum<?php
                                    print ($i);
                                    if (isset($_POST["geboortedatum"])) {
                                        print (" value=" . $_POST["geboortedatum"]);
                                    }
                                    ?>'></td></tr>
                            <tr><td>Straatnaam:</td><td><input type='text' name='straat<?php
                                    print ($i);
                                    if (isset($_POST["straat"])) {
                                        print (" value=" . $_POST["straat"]);
                                    }
                                    ?>'></td></tr>
                            <tr><td>Huisnummer:</td><td><input type='number' name='huisnummer<?php
                                    print ($i);
                                    if (isset($_POST["huisnummer"])) {
                                        print (" value=" . $_POST["huisnummer"]);
                                    }
                                    ?>'></td></tr>
                            <tr><td>Postcode:</td><td><input type='text' name='postcode<?php
                                    print ($i);
                                    if (isset($_POST["postcode"])) {
                                        print (" value=" . $_POST["postcode"]);
                                    }
                                    ?>'></td></tr>
                            <tr><td>Woonplaats:</td><td><input type='text' name='woonplaats<?php
                                    print ($i);
                                    if (isset($_POST["woonplaats"])) {
                                        print (" value=" . $_POST["woonplaats"]);
                                    }
                                    ?>'></td></tr>
                            <tr><td>Land:</td><td><input type='text' name='land<?php
                                    print ($i);
                                    if (isset($_POST["land"])) {
                                        print (" value=" . $_POST["land"]);
                                    }
                                    ?>'></td></tr>
                                <?php
                            }
                            ?>
                        <tr><td><input type='submit' name='afronden' value='Afronden'></td></tr>
>>>>>>> origin/master
                    </form>
                </table>
            </div>

            <?php
            include "functions.php";

            if (isset($_POST["volgende"])) {
                //$begindatum = $_POST["begindatum"];
                //$einddatum = $_POST["einddatum"];
                $aantalPersonen = $_POST["aantalPersonen"];
                $vervoerHeen = $_POST["heen"];
                $vervoerTerug = $_POST["terug"];
                $locatie = $_POST["locatie"];
                if ($_POST["nieuweLocatie"] != "") {
                    $locatie = $_POST["nieuweLocatie"];
                }

<<<<<<< HEAD
                if ($_POST["opmerkingen"] != "") {
                    $opmerkingen = $_POST["opmerkingen"];
                } else {
                    $opmerkingen = NULL;
=======
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
                            header("http://localhost:8080/GFY1-03/boekengegevenscheck.php");
                        } else {
                            print ("U dient uw gegevens correct in te vullen.");
                        }
                    }
>>>>>>> origin/master
                }

                $klantGegevensArray = array("aantalPersonen" => $aantalPersonen, "vervoerHeen" => $vervoerHeen, "vervoerTerug" => $vervoerTerug, "locatie" => $locatie, "opmerkingen" => $opmerkingen);
                session_start();
                $_SESSION["klantGegevens"] = $klantGegevensArray;
            }
            include 'footer.php';
            ?>
        </div>
    </body>
</html>