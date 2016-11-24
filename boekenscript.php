<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Boeken</title>
        <?php include 'head.php'; ?>
        <link type="text/css" rel="stylesheet" href="style.css">
    </head>
    <body>
        <?php
        include "functions.php";
        
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
            
            if ($_GET["opmerkingen"] == "") {
                $opmerkingen = $_GET["opmerkingen"];
            } else {
                $opmerking = "NULL";
            }

            $opmerkingen = $_GET["opmerkingen"];
            $aantalPersonen = $_GET["aantalPersonen"];

            $pdo = newPDO();
            $stmt = $pdo->prepare("INSERT INTO boeking (aantalPersonen, vervoerHeen, vervoerTerug, locatie, opmerking) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute(array($aantalPersonen, $vervoerHeen, $vervoerTerug, $locatie, $opmerkingen));
            $pdo = NULL;
        }
        ?>
        <div id="container">
            <?php include "header.php"; ?>
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
                            print (ucfirst($locatie));
                            ?></td>
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
            <?php include 'footer.php'; ?>
        </div>
    </body>
</html>