<!DOCTYPE html>
<html>
    <head>
        <title>Boeken</title>
        <?php include 'head.php'; ?>
    </head>
    <body>
        <div id="container">
            <?php include 'header.php'; ?>
            <div id="content">
                <div id="contentwrapper">
                    <h2> Boeken </h2>
                    <table>
                        <form method="POST" action="boekengegevens.php">
                            <tr>
                                <td>Begindatum* :</td>
                                <td><!--$begindatum--></td>
                            </tr><tr>
                                <td>Einddatum* :</td>
                                <td><!--$einddatum--></td>
                            </tr><tr>
                                <td>Aantal personen* :</td>
                                <td><select name="aantalPersonen" required><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option></select></td>
                            </tr><tr>
                                <td>Vervoer van Luchthaven Portela (Lissabon)* :</td>
                                <td><input type="radio" name="vervoerHeen" value="1" checked> Ja</td>
                            </tr><tr>
                                <td></td>
                                <td><input type="radio" name="vervoerHeen" value="0" <?php
                                    if (isset($_POST["vervoerHeen"]) && $_POST["vervoerHeen"] == 0) {
                                        print ("checked");
                                    }
                                    ?>> Nee</td>
                            </tr><tr>
                                <td>Vervoer naar Luchthaven Portela (Lissabon)* :</td>
                                <td><input type="radio" name="vervoerTerug" value="1" checked> Ja</td>
                            </tr><tr>
                                <td></td>
                                <td><input type="radio" name="vervoerTerug" value="0" <?php
                                    if (isset($_POST["vervoerTerug"]) && $_POST["vervoerTerug"] == 0) {
                                        print ("checked");
                                    }
                                    ?>> Nee</td>
                            </tr><tr>
                                <td>Locatie van overnachting* :</td>
                                <td><input type="radio" name="locatie" value="standaard" checked> Standaard locatie</td>
                            </tr><tr>
                                <td></td>
                                <td><input type="radio" name="locatie" value="anders"> Anders, namelijk: <input type="text" name="nieuweLocatie"></td>
                            </tr><tr>
                                <td>Opmerkingen:</td>
                                <td><textarea name="opmerkingen" rows="4" cols="60"></textarea></td>
                            </tr><tr>
                                <td>Vakantienaam* :<br>Deze naam gebruikt u later uw reisgegevens in te zien. Deze gegevens zou u ook eventueel kunnen delen met reisgenoten.</td>
                                <td><input type="text" name="vakantienaam" required<?php
                                    if (isset($_POST["vakantienaam"])) {
                                        print ("value=" . $_POST["vakantienaam"]);
                                    }
                                    ?>></td>
                            </tr><tr>
                                <td><input type="submit" name="volgende" value="Volgende" class="btn-main"></td>
                            </tr>
                        </form>
                    </table>
                </div>
            </div>
            <?php include 'footer.php'; ?>
        </div>
    </body>
</html>
