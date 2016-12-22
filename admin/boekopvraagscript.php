<html>
    <head>
        <title></title>
    </head>
    <body>
        <div id="container">
            <div id="contentwrapper">
                <?php
                if (isset($_GET['boekingID'])) {
                    $boekingID = $_GET['boekingID'];

                    $pdo = newPDO();

                        $stmt1 = $pdo->prepare("SELECT begindatum, einddatum, aantalPersonen, vervoerHeen, vervoerTerug, locatie, opmerking, status, betaling FROM boeking WHERE idklant = ?");
                        $stmt1->execute(array($boekingID));
                        $row1 = $stmt1->fetch();

                        $begindatum = $row1["begindatum"];
                        $einddatum = $row1["einddatum"];
                        $aantalPersonen = $row1["aantalPersonen"];
                        $vervoerHeen = $row1["vervoerHeen"];
                        $vervoerTerug = $row1["vervoerTerug"];
                        $locatie = $row1["locatie"];
                        $opmerking = $row1["opmerking"];
                        $status = $row1["status"];
                        $betaling = $row1["betaling"];

                        ?>


                        <h2>Reisgegevens:</h2>
                        <table>
                            <tr>
                                <td>Begindatum:</td>
                                <td><?php print($begindatum); ?></td>
                            </tr><tr>
                                <td>Einddatum:</td>
                                <td><?php print($einddatum); ?></td>
                            </tr><tr>
                                <td>Aantal personen:</td>
                                <td><?php print ($aantalPersonen) ?></td>
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
                            </tr>
                            <?php
                            if ($opmerking != NULL) {
                                print ("<tr><td>Opmerkingen</td><td>" . $opmerking . "</td></tr>");
                            }
                            ?>
                            <tr>
                                <td>Status:</td>
                                <td><?php print($status); ?></td>
                            </tr><tr>
                                <td>Betaald:</td>
                                 <td><?php print($betaling); ?></td>
                            </tr>
                        </table>
                        <h2>Persoonlijke gegevens:</h2>
                        <table>
                            <?php
                            for ($i = 1; $i <= $aantalPersonen; $i++) {
                                $stmt2 = $pdo->prepare("SELECT voornaam, achternaam, gebdatum, adres, postcode, woonplaats, land, telefoonnummer, email FROM klantgegevens WHERE idklant = ? AND persoon = ?");
                                $stmt2->execute(array($boekingID, $i));

                                $row4 = $stmt2->fetch();
                                $voornaam = $row4["voornaam"];
                                $achternaam = $row4["achternaam"];
                                $geboortedatum = $row4["gebdatum"];
                                $adres = $row4["adres"];
                                $postcode = $row4["postcode"];
                                $woonplaats = $row4["woonplaats"];
                                $land = $row4["land"];
                                $telefoonnummer = $row4["telefoonnummer"];
                                $email = $row4["email"];
                                if ($aantalPersonen != 1) {
                                    ?>
                                    <tr>
                                        <td><h3>Persoon <?php print ($i) ?></h3></td>
                                    </tr><?php
                                }
                                ?>
                                <tr>
                                    <td>Voornaam:</td>
                                    <td><?php print($voornaam); ?></td>
                                </tr><tr>
                                    <td>Achternaam:</td>
                                    <td><?php print($achternaam); ?></td>
                                </tr><tr>
                                    <td>Adres:</td>
                                    <td><?php print($adres); ?></td>
                                </tr><tr>
                                    <td>Postcode:</td>
                                    <td><?php print($postcode); ?></td>
                                </tr><tr>
                                    <td>Woonplaats:</td>
                                    <td><?php print($woonplaats); ?></td>
                                </tr><tr>
                                    <td>Land:</td>
                                    <td><?php print($land); ?></td>
                                </tr><tr>
                                    <td>Geboortedatum:</td>
                                    <td><?php print($geboortedatum); ?></td>
                                </tr><tr>
                                    <td>Telefoonnummer:</td>
                                    <td><?php print($telefoonnummer); ?></td>
                                </tr><tr>
                                    <td>Emailadres:</td>
                                    <td><?php print($email); ?></td>
                                </tr>
                                <?php
                            }
                            ?>
                        </table>
                        <?php
                        $pdo = NULL;
                    }

                    ?>
            </div>
        </div>

    </body>
</html>
