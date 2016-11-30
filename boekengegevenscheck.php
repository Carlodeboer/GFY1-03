<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Gegevens controleren</title>
        <?php include 'head.php'; ?>
    </head>
    <body>
        <div id="container">
            <?php
            include 'header.php';
            include "functions.php";
            ?>
            <div id="content">
                <?php
                if (isset($_POST["afronden"])) {
                    if ($_POST["voornaam"] != "" || $_POST["achternaam"] != "" || $_POST["straat"] != "" || $_POST["huisnummer"] != "" || $_POST["postcode"] != "" || $_POST["woonplaats"] != "" || $_POST["land"] != "") {
                        session_start();
                        $klantGegevensArray = $_SESSION["klantGegevens"];
                        extract($klantGegevensArray);

//                    $aantalPersonen = $klantGegevensArray["aantalPersonen"];
//                    $vervoerHeen = $klantGegevensArray["vervoerHeen"];
//                    $vervoerTerug = $klantGegevensArray["vervoerTerug"];
//                    $locatie = $klantGegevensArray["locatie"];
//                    $opmerkingen = $klantGegevensArray["opmerkingen"];

                        $voornaam = $_POST["voornaam"];
                        $_SESSION["klantGegevens"]["voornaam"] = $voornaam;
                        $achternaam = $_POST["achternaam"];
                        $_SESSION["klantGegevens"]["achternaam"] = $achternaam;
                        $straat = $_POST["straat"];
                        $_SESSION["klantGegevens"]["straat"] = $straat;
                        $huisnummer = $_POST["huisnummer"];
                        $_SESSION["klantGegevens"]["huisnummer"] = $huisnummer;
                        $postcode = $_POST["postcode"];
                        $_SESSION["klantGegevens"]["postcode"] = $postcode;
                        $woonplaats = $_POST["woonplaats"];
                        $_SESSION["klantGegevens"]["woonplaats"] = $woonplaats;
                        $land = $_POST["land"];
                        $_SESSION["klantGegevens"]["land"] = $land;
                        ?>
                        <table>
                            <tr>
                                <td><h2>Reisgegevens:</h2></td>
                            </tr><tr>
                                <td>Begindatum:</td>
                                <td>$begindatum</td>
                            </tr><tr>
                                <td>Einddatum:</td>
                                <td>$einddatum</td>
                            </tr><tr>
                                <td>Vervoer van Luchthaven Portela (Lissabon):</td>
                                <td><?php
                                    if ($vervoerHeen) {
                                        print("Ja");
                                    } else {
                                        print("Nee");
                                    }
                                    ?></td>
                            </tr><tr>
                                <td>Vervoer naar Luchthaven Portela (Lissabon):</td>
                                <td><?php
                                    if ($vervoerTerug) {
                                        print("Ja");
                                    } else {
                                        print("Nee");
                                    }
                                    ?></td>
                            </tr><tr>
                                <td>Locatie van overnachting:</td>
                                <td><?php
                                    print (ucfirst($locatie));
                                    ?></td>
                            </tr><tr>
                                <td>Aantal personen:</td>
                                <td><?php print ($aantalPersonen) ?></td>
                            </tr>
                            <?php
                            if ($opmerkingen != NULL) {
                                print ("<tr><td>Opmerkingen</td><td>" . $opmerkingen . "</td></tr>");
                            }
                            ?>
                            <tr>
                                <td><h2>Persoonlijke gegevens:</h2></td>
                            </tr><tr>
                                <td>Voornaam:</td>
                                <td><?php print($_SESSION["klantGegevens"]["voornaam"]); ?></td>
                            </tr><tr>
                                <td>Achternaam:</td>
                                <td><?php print($achternaam) ?></td>
                            </tr><tr>
                                <td>Adres:</td>
                                <td><?php print($straat . " " . $huisnummer) ?></td>
                            </tr><tr>
                                <td>Postcode:</td>
                                <td><?php print($postcode) ?></td>
                            </tr><tr>
                                <td>Woonplaats:</td>
                                <td><?php print($woonplaats) ?></td>
                            </tr><tr>
                                <td>Land:</td>
                                <td><?php print($land) ?></td>
                            </tr><tr>
                                <td><form method="POST" action="boekengegevenscheckafronden.php"><input type="submit" name="boeken" value="Boeken"></form></td>
                            </tr>
                        </table>
                    <?php }
                    else {
                        print("U dient uw gegevens correct in te vullen.<br><a href=\"boekengegevens.php\">Terug</a>");
                    }
                } ?>
            </div>
        </div>
    </body>
</html>