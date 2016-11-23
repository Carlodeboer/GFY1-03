<!DOCTYPE html>
<?php
include "functions.php";
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link type="text/css" rel="stylesheet" href="style.css">
    </head>
    <body>
        <?php
        banner();
        if (isset($_GET["verzenden"])) {
            //$begindatum = $_GET["begindatum"];
            //$einddatum = $_GET["einddatum"];
            $vervoerHeen = $_GET["heen"];
            $vervoerTerug = $_GET["terug"];
            $locatie = $_GET["locatie"];

            if ($_GET["nieuweLocatie"] != "") {
                $locatie = $_GET["nieuweLocatie"];
            }

            $omschrijving = "";
            $opmerkingen = $_GET["opmerkingen"];
            $aantalPersonen = $_GET["aantalPersonen"];

            $pdo = newPDO();
            $stmt = $pdo->prepare("INSERT INTO boeking (aantalPersonen, vervoerHeen, vervoerTerug, locatie, opmerking) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute(array($aantalPersonen, $vervoerHeen, $vervoerTerug, $locatie, $opmerkingen));
            $pdo = NULL;
        }
        ?>
        <div id="container">
            <div id="content">
                <table>
                    <tr>
                        <td>Begindatum:</td>
                        <td><!--$begindatum--></td>
                    </tr><tr>
                        <td>Einddatum:</td>
                        <td><!--$einddatum--></td>
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
                            print ($locatie);
                            ?></td>
                    </tr><tr>
                        <td></td>
                        <td></td>
                    </tr><tr>
                        <td>Aantal personen:</td>
                        <td><?php print ($aantalPersonen) ?></td>
                    </tr>
                    <?php
                    if ($opmerkingen != "") {
                        print ("<tr><td>Opmerkingen</td><td>" . $opmerkingen . "</td></tr>");
                    }
                    ?>
                </table>
            </div>
        </div>
    </body>
</html>