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

                if ($_POST["opmerkingen"] != "") {
                    $opmerkingen = $_POST["opmerkingen"];
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