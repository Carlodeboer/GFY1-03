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
                    <form method="GET" action="boekengegevens.php">
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
            </div>
            <?php include 'footer.php';
            ?>
        </div>
    </body>
</html>
