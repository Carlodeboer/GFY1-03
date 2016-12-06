<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <?php include 'head.php'; ?>
        <title>Reisinformatie</title>
    </head>
    <body>
        <div id="container">
            <?php
            include 'header.php';
            ?>
            <div id="content">
              <div id="contentwrapper">
                <?php
                if (isset($_POST["verzenden"])) {
                    $week = $_POST["vakantiejaar"];
                    $naam = $_POST["vakantienaam"];

                    include "functions.php";

                    $pdo = newPDO();
                    $stmt = $pdo->prepare("SELECT idklant FROM reis WHERE weekjaar = ? AND vakantienaam = ?");
                    $stmt->execute(array($week, $naam));
                    $row = $stmt->fetch();

                    $idklant = $row["idklant"];

                    print("<h1>Reisinfo voor " . $naam . " in week " . substr($week, 0, 2) . "</h1>");
                    $stmt = $pdo->prepare("SELECT begindatum, einddatum, aantalPersonen, vervoerHeen, vervoerTerug, locatie, opmerking, status, betaling FROM boeking WHERE idklant = ?");
                    $stmt->execute(array($idklant));
                    $row = $stmt->fetch();

                    $begindatum = $row["begindatum"];
                    $einddatum = $row["einddatum"];
                    $aantalPersonen = $row["aantalPersonen"];
                    $vervoerHeen = $row["vervoerHeen"];
                    $vervoerTerug = $row["vervoerTerug"];
                    $locatie = $row["locatie"];
                    $opmerking = $row["opmerking"];
                    $status = $row["status"];
                    $betaling = $row["betaling"];
                    ?>

                    <table>
                        <tr>
                            <td>Begindatum:</td>
                            <td><?php print($begindatum); ?></td>
                        </tr><tr>
                            <td>Einddatum:</td>
                            <td><?php print($einddatum); ?></td>
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
                        if ($opmerking != NULL) {
                            print ("<tr><td>Opmerkingen</td><td>" . $opmerking . "</td></tr>");
                        }
                        ?>
                    </table>
                    <h2>Persoonlijke gegevens:</h2>
                    <table>
                        <?php
                        for ($i = 1; $i <= $aantalPersonen; $i++) {
                            if ($aantalPersonen != 1) {
                                ?>
                                <tr>
                                    <td><h3>Persoon <?php print ($i) ?></h3></td>
                                </tr>
                            <?php }
                            ?>
                            <tr>
                                <td>Voornaam:</td>
                                <td><?php print(${"voornaam" . $i}); ?></td>
                            </tr><tr>
                                <td>Achternaam:</td>
                                <td><?php print(${"achternaam" . $i}); ?></td>
                            </tr><tr>
                                <td>Geboortedatum:</td>
                                <td><?php print(${"geboortedatum" . $i}); ?></td>
                            </tr><tr>
                                <td>Adres:</td>
                                <td><?php print(${"straat" . $i} . " " . ${"huisnummer" . $i}); ?></td>
                            </tr><tr>
                                <td>Postcode:</td>
                                <td><?php print(${"postcode" . $i}); ?></td>
                            </tr><tr>
                                <td>Woonplaats:</td>
                                <td><?php print(${"woonplaats" . $i}); ?></td>
                            </tr><tr>
                                <td>Land:</td>
                                <td><?php print(${"land" . $i}); ?></td>
                            </tr>
                            <?php
                        }
                        ?>
                        <tr>
                            <td>
                                <form method="POST" action="boekengegevenscheckafronden.php">
                                    <input type="submit" name="afronden" value="Afronden" class="btn-main">
                                </form>
                            </td>
                        </tr>
                    </table>


                    <?php
                    // Verbinding opruimen
                    $pdo = NULL;
                }
                ?>
              </div>
            </div>
        </div>
    </body>
</html>
