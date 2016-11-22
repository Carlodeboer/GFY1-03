<!DOCTYPE html>
<html>
    <head>
        <title>Motocross</title>
        <link type="text/css" rel="stylesheet" href="style.css">
    </head>
    <body>
        <?php
        banner();
        ?>
        <table>
            <form method="GET">
                <tr>
                    <td>Begindatum:</td>
                    <td><!--$begindatum--></td>
                </tr><tr>
                    <td>Einddatum:</td>
                    <td><!--$einddatum--></td>
                </tr><tr>
                    <td>Vervoer van Luchthaven Portela (Lissabon):</td>
                    <td><input type="radio" name="heen" value="ja" checked> Ja</td>
                </tr><tr>
                    <td></td>
                    <td><input type="radio" name="heen" value="nee"> Nee</td>
                </tr>
                <tr><td>Vervoer naar Luchthaven Portela (Lissabon):</td>
                    <td><input type="radio" name="terug" value="ja" checked> Ja</td>
                </tr><tr>
                    <td></td>
                    <td><input type="radio" name="terug" value="nee"> Nee</td>
                </tr><tr>
                    <td>Locatie van overnachting:</td>
                    <td><input type="radio" name="locatie" value="standaard"> Standaard locatie</td>
                </tr><tr>
                    <td></td>
                    <td><input type="radio" name="locatie" value="anders"> Anders, namelijk: <input type="text" name="nieuweLocatie"></td>
                </tr><tr>
                    <td>Aantal personen:</td>
                    <td><select name="aantalPersonen"><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option></select></td>
                </tr><tr>
                    <td><input type="submit" name="Verzenden"></td>
                </tr>
            </form>
        </table>
    </nav>
</div>
</body>
</html>
