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
                    <form method="GET" action="boekengegevenscheck.php">
                        <tr>
                            <td>Voornaam:</td>
                            <td><input type="text" name="voornaam"></td>
                        </tr><tr>
                            <td>Achternaam:</td>
                            <td><input type="text" name="achternaam"></td>
                        </tr><tr>
                            <td>Straatnaam</td>
                            <td><input type="text" name="straat"></td>
                        </tr><tr>
                            <td>Huisnummer</td>
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
                    </form>
                </table>
            </div>

            <?php
            include "functions.php";

            if (isset($_GET["volgende"])) {
                //$begindatum = $_GET["begindatum"];
                //$einddatum = $_GET["einddatum"];
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

                $klantGegevensArray = array("aantalPersonen" => $aantalPersonen, "vervoerHeen" => $vervoerHeen, "vervoerTerug" => $vervoerTerug, "locatie" => $locatie, "opmerkingen" => $opmerkingen);
                session_start();
                $_SESSION["klantGegevens"] = $klantGegevensArray;
            }
            include 'footer.php';
            ?>
        </div>
    </body>
</html>