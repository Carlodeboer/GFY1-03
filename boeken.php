<!DOCTYPE html>
<?php
include "functions.php";
?>
<html>
    <head>
        <title>Boeken</title>
        <?php include 'head.php'; ?>
    </head>
    <body>
        <div id="container">
            <?php include 'header.php'; ?>
            <div id="content">
              <h2> Boeken </h2>
                <table>
                    <form method="POST" action="boekengegevens.php">
                        <tr>
                            <td>Begindatum:</td>
                            <td><!--$begindatum--></td>
                        </tr><tr>
                            <td>Einddatum:</td>
                            <td><!--$einddatum--></td>
                        </tr><tr>
                            <td>Aantal personen:</td>
                            <td><select name="aantalPersonen"><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option></select></td>
                        </tr><tr>
                            <td>Vervoer van Luchthaven Portela (Lissabon):</td>
                            <td><input type="radio" name="heen" value="1" checked> Ja</td>
                        </tr><tr>
                            <td></td>
                            <td><input type="radio" name="heen" value="0"> Nee</td>
                        <tr><td>Vervoer naar Luchthaven Portela (Lissabon):</td>
                            <td><input type="radio" name="terug" value="1" checked> Ja</td>
                        </tr><tr>
                            <td></td>
                            <td><input type="radio" name="terug" value="0"> Nee</td>
                        </tr><tr>
                            <td>Locatie van overnachting:</td>
                            <td><input type="radio" name="locatie" value="standaard" checked> Standaard locatie</td>
                        </tr><tr>
                            <td></td>
                            <td><input type="radio" name="locatie" value="anders"> Anders, namelijk: <input type="text" name="nieuweLocatie"></td>
                        </tr><tr>
                            <td>Opmerkingen:</td>
                            <td><textarea name="opmerkingen" rows="4" cols="60"></textarea>
                        </tr><tr>
                            <td><input type="submit" name="volgende" value="Volgende"></td>
                        </tr>
                    </form>
                </table>
                <?php
                if (isset($_POST["volgende"])) {
                    if ($_POST["vakantienaam"] != "") {
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

                        $vakantienaam = $_POST["vakantienaam"];
                        $klantGegevensArray = array("aantalPersonen" => $aantalPersonen, "vervoerHeen" => $vervoerHeen, "vervoerTerug" => $vervoerTerug, "locatie" => $locatie, "opmerkingen" => $opmerkingen, "vakantienaam" => $vakantienaam);
                        session_start();
                        $_SESSION["klantGegevens"] = $klantGegevensArray;
                        header("location: boekengegevens.php");
                    } else {
                        print("Voer een vakantienaam in.");
                    }
                }
                ?>
            </div>
            <?php include 'footer.php';
            ?>
        </div>
    </body>
</html>