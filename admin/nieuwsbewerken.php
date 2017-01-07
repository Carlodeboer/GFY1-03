<?php
/*******************************************************************************
 * Copyright (c) 2017 Carlo de Boer, Floris de Grip, Thijs Marschalk,
 * Ralphine de Roo, Sophie Roos and Ian Vredenburg
 *
 * This Source Code Form is subject to the terms of the MIT license.
 * If a copy of the MIT license was not distributed with this file. You can
 * obtain one at https://opensource.org/licenses/MIT
 *******************************************************************************/
?>
<!DOCTYPE html>
<html>
    <head>
    <!-- popups initialiseren voor feedback aan beheerder -->
        <script>
            function popupverwijder() {
                $("#verwijder").snackbar("show");
            }
        </script>

        <script>
            function popupupdate() {
                $("#update").snackbar("show");
            }
        </script>
    </head>
    <body>
        <br><br>
        <h3>Nieuwsberichten bewerken</h3><br>
        <?php
        // Wanneer er een nieuwbericht aangeklikt wordt, verschijnt deze aan de rechterkant van de pagina. Onderstaande regels halen de gewenste informatie uit de database
        $pdo = newPDO();
        $stmt = $pdo->prepare("SELECT id,lang,title,description,bodytext,posted
                            FROM nieuwsbericht");
        $stmt->execute();
        ?>
        <br><br><br>

    <!-- Gebruik van row om meerdere items naast elkaar te zetten, col-md-* geeft de breedte van een item weer. -->
        <div class="row">
            <div class="col-md-6">

                <table class="table table-striped table-hover nieuwsberichtenbewerken">
                    <th>ID</th><th>Taal</th><th>Titel</th><th>Omschrijving</th><th>Datum</th>

                    <?php
                    while ($content = $stmt->fetch()) {
                        echo "<tr onclick=\"location='beheerpaneel.php?beheer=Nieuwsbewerken&berichtId={$content['id']}'\">

                    <td>" . $content['id'] . "</td>
                    <td>" . $content['lang'] . "</td>
                    <td>" . $content['title'] . "</td>
                    <td>" . $content['description'] . "</td>
                    <td>" . $content['posted'] . "</td>

                    </tr>";
                    }
                    ?>

                </table>

                <br>
                <form method="post" action="beheerpaneel.php?beheer=Nieuws">
                    <input type="submit" value="Terug" name="terug" class="btn btn-raised btn-primary">
                </form>
            </div>



            <div class="col-md-6">

<!-- Onderstaande code kijkt of een nieuwsbericht is aangeklikt, en haalt vervolgens informatie op. -->
                <?php
                if (isset($_GET['berichtId'])) {
                    $berichtId = $_GET['berichtId'];

                    $stmt = $pdo->prepare("SELECT id,lang,title,description,bodytext,posted
                            FROM nieuwsbericht
                            WHERE id=?");
                    $stmt->execute(array($berichtId));
                    $content = $stmt->fetch();
                }

                $taal = 0;
// Switch wordt gebruikt voor taalselectie
                switch ($content['lang']) {
                    case "NLD":
                        $taal = "Nederlands";
                        break;
                    case "ENG":
                        $taal = "Engels";
                        break;
                    case "DEU":
                        $taal = "Duits";
                        break;
                }
                ?>

                <form method="post">

<!-- De volgende input velden worden automatisch ingevuld wanneer een artikel wordt aangeklikt -->
                    <div class="form-group">
                        <label for="inputtitel" class="col-md-6 control-label">Titel</label>

                        <div class="col-md-10">
                            <input type="text" class="form-control" id="inputtitel" name="titel" placeholder="Titel" value="<?php print($content['title']); ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputomschrijving" class="col-md-6 control-label">Omschrijving</label>

                        <div class="col-md-10">
                            <input type="text" class="form-control" id="inputomschrijving" name="omschrijving" placeholder="Omschrijving" value="<?php print($content['description']); ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputdatum" class="col-md-6 control-label">Datum</label>

                        <div class="col-md-10">
                            <input type="text" class="form-control" id="inputdatum" name="datum" placeholder="Datum" value="<?php print($content['posted']); ?>">
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="select111" class="col-md-6 control-label">Taal</label>

                        <div class="col-md-10">
                            <select name="lang" id="select111" class="form-control">
                                <option selected="<?php print($content['lang']) ?>" value="<?php print($content['lang']) ?>"><?php print($taal); ?></option>
                                <option value="NLD">Nederlands</option>
                                <option value="ENG">Engels</option>
                                <option value="DEU">Duits</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group is-empty">
                        <label for="textArea" class="col-md-6 control-label">Bericht</label>

                        <div class="col-md-10">
                            <textarea class="form-control" rows="5" name="bodytext" id="textArea"><?php print($content['bodytext']); ?></textarea>
                            <span class="help-block">Vul hier een bericht in</span>
                        </div>
                    </div>
                    <br>
                    <br><br>
                    <br><br>
                    <br><br>
                    <br><br>
                    <br><br>
                    <br><br>
                    <br><br>
                    <br>

                    <input type="submit" name="updaten" value="Updaten" class="btn btn-raised btn-primary">
                    <input class="btn btn-raised btn-warning" type="submit" name="delete" value="Verwijderen" onclick="return confirm('Weet je het zeker?')" />

                </form>

                <br><br>

            </div>
        </div>
    </div>

    <span data-toggle=snackbar id="verwijder" data-content="Het bericht is verwijderd."></span>
    <span data-toggle=snackbar id="update" data-content="Het bericht is bijgewerkt."></span>

<?php
// onderstaande code wordt uitgevoerd wanneer er op Updaten geklikt wordt.
if (isset($_POST['updaten'])) {
    $titel = $_POST['titel'];
    $lang = $_POST['lang'];
    $omschrijving = $_POST['omschrijving'];
    $posted = $_POST['datum'];
    $bodytext = $_POST['bodytext'];
    $berichtId = $_GET['berichtId'];
// controleren of titel en bericht zijn ingevuld
    if ($titel == "") {
        print("Voer een titel in.");
    } elseif ($bodytext == "") {
        print("Voer een bericht in.");
    } else {

// SQL query update het artikel in de database wanneer alle velden ingevuld zijn.
        $pdo = newPDO();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $pdo->prepare("UPDATE nieuwsbericht SET lang=?, title=?, description=?, bodytext=?, posted=? WHERE id=?");
        try {
            $stmt->execute(array($lang, $titel, $omschrijving, $bodytext, $posted, $berichtId));
        } catch (PDOException $e) {
            echo "Er is iets fout gegaan";
        }

        $res = $stmt->rowCount();
        if ($res > 0) {
            //feedback aan gebruiker geven
            print("Het bericht " . $titel . " is bijgewerkt.");
            // popup geeft een korte melding aan de beheerder.
            print("<script>window.onload = popupupdate;</script>");
        }
    }
}


// Onderstaande zorgt ervoor dat artikelen verwijderd kunnen worden.
if (isset($_POST['delete'])) {
    if (!isset($_GET['berichtId'])) {
        print("Er is geen bericht geselecteerd.");
    } else {

        $stmt = $pdo->prepare("DELETE FROM nieuwsbericht WHERE id=?");
        try {
            $stmt->execute(array($berichtId));
        } catch (PDOException $e) {
            echo "Er is iets fout gegaan";
        }

        $res = $stmt->rowCount();
        if ($res > 0) {
            //feedback aan gebruiker geven
            print("Het bericht is verwijderd.");
            print("<script>window.onload = popupverwijder;</script>");
        }
    }
}
?>


</body>
</html>
