<?php define("toegang", true); ?>
<!DOCTYPE html>
<html>
<head>
     <meta charset="UTF-8">
     <title>Gegevens</title>
     <?php include "head.php"; ?>
</head>
<body>
     <div id="container">
          <?php include "header.php"; ?>
          <div id="content">
               <div id="contentwrapper">
                    <?php
                    if (isset($_SESSION["klantGegevens"])) {
                         session_unset($_SESSION["klantGegevens"]);
                    }

                    // $begindatum = ;
                    // $einddatum = ;
                    toevoegenAanArray("aantalPersonen", "klantGegevens", "");
                    toevoegenAanArray("vervoerHeen", "klantGegevens", "");
                    toevoegenAanArray("vervoerTerug", "klantGegevens", "");
                    toevoegenAanArray("vakantienaam", "klantGegevens", "");
                    toevoegenAanArray("locatie", "klantGegevens", "");

                    if ($_POST["nieuweLocatie"] != "") {
                         $_SESSION["klantGegevens"]["locatie"] = $_POST["nieuweLocatie"];
                    }

                    if ($_POST["opmerkingen"] != "") {
                         toevoegenAanArray("opmerkingen", "klantGegevens", "");
                    } else {
                         $_SESSION["klantGegevens"]["opmerkingen"] = NULL;
                    }
                    extract($_SESSION["klantGegevens"]);
                    ?>

                    <h2>Gegevens</h2>
                    <form method="POST" action="boekengegevenscheck.php">
                         <?php
                         for ($i = 1; $i <= $aantalPersonen; $i++) {
                              if ($aantalPersonen != 1) {
                                   print("<h3>Persoon " . $i . ":</h3>");
                              }
                              ?>
                              <div class="form-group label-floating is-empty">
                                   <label for="i5i" class="control-label">Voornaam*</label>
                                   <input type="text" name="voornaam<?php print ($i); ?>" class="form-control" id="i5i" required>
                                   <span class="help-block">Voer een voornaam in</span>
                              </div>
                              <div class="form-group label-floating is-empty">
                                   <label for="i5i" class="control-label">Achternaam*</label>
                                   <input type="text" name="achternaam<?php print ($i); ?>" class="form-control" id="i5i" required>
                                   <span class="help-block">Voer een achternaam in</span>
                              </div>
                              <div class="form-group label-floating is-empty">
                                   <label for="i5i" class="control-label">Straatnaam*</label>
                                   <input type="text" name="straatnaam<?php print ($i); ?>" class="form-control" id="i5i" required>
                                   <span class="help-block">Voer de straatnaam in</span>
                              </div>
                              <div class="form-group label-floating is-empty">
                                   <label for="i5i" class="control-label">Huisnummer*</label>
                                   <input type="text" name="huisnummer<?php print ($i); ?>" class="form-control" id="i5i" required>
                                   <span class="help-block">Voer het huisnummer in</span>
                              </div>
                              <div class="form-group label-floating is-empty">
                                   <label for="i5i" class="control-label">*</label>
                                   <input type="text" name="<?php print ($i); ?>" class="form-control" id="i5i" required>
                                   <span class="help-block">Voer  in</span>
                              </div>
                              <div class="form-group label-floating is-empty">
                                   <label for="i5i" class="control-label">*</label>
                                   <input type="text" name="<?php print ($i); ?>" class="form-control" id="i5i" required>
                                   <span class="help-block">Voer  in</span>
                              </div>
                              <div class="form-group label-floating is-empty">
                                   <label for="i5i" class="control-label">*</label>
                                   <input type="text" name="<?php print ($i); ?>" class="form-control" id="i5i" required>
                                   <span class="help-block">Voer  in</span>
                              </div>
                              <div class="form-group label-floating is-empty">
                                   <label for="i5i" class="control-label">*</label>
                                   <input type="text" name="<?php print ($i); ?>" class="form-control" id="i5i" required>
                                   <span class="help-block">Voer  in</span>
                              </div>
                              <table>

                                   <tr><td>Voornaam* :</td><td><input type="text" name="voornaam<?php print ($i); ?>"<?php
                                   if (isset($_POST["voornaam" . $i])) {
                                        print (" value=" . $_POST["voornaam" . $i]);
                                   }
                                   ?> required></td></tr>
                                   <tr><td>Achternaam* :</td><td><input type="text" name="achternaam<?php print ($i); ?>"<?php
                                   if (isset($_POST["achternaam" . $i])) {
                                        print (" value=" . $_POST["achternaam" . $i]);
                                   }
                                   ?> required></td></tr>
                                   <tr><td>Straatnaam* :</td><td><input type="text" name="straat<?php print ($i); ?>"<?php
                                   if (isset($_POST["straat" . $i])) {
                                        print (" value=" . $_POST["straat" . $i]);
                                   }
                                   ?> required></td></tr>
                                   <tr><td>Huisnummer* :</td><td><input type="number" name="huisnummer<?php print ($i); ?>"<?php
                                   if (isset($_POST["huisnummer" . $i])) {
                                        print (" value=" . $_POST["huisnummer" . $i]);
                                   }
                                   ?> required></td></tr>
                                   <tr><td>Postcode* :</td><td><input type="text" name="postcode<?php print ($i); ?>"<?php
                                   if (isset($_POST["postcode" . $i])) {
                                        print (" value=" . $_POST["postcode" . $i]);
                                   }
                                   ?> required></td></tr>
                                   <tr><td>Woonplaats* :</td><td><input type="text" name="woonplaats<?php print ($i); ?>"<?php
                                   if (isset($_POST["woonplaats" . $i])) {
                                        print (" value=" . $_POST["woonplaats" . $i]);
                                   }
                                   ?> required></td></tr>
                                   <tr><td>Land* :</td><td><input type="text" name="land<?php print ($i); ?>"<?php
                                   if (isset($_POST["land" . $i])) {
                                        print (" value=" . $_POST["land" . $i]);
                                   }
                                   ?> required></td></tr>
                                   <tr><td>Geboortedatum* :</td><td><input type="date" name="geboortedatum<?php print ($i); ?>"<?php
                                   if (isset($_POST["geboortedatum" . $i])) {
                                        print (" value=" . $_POST["geboortedatum" . $i]);
                                   }
                                   ?> required></td></tr>
                                   <tr><td>Telefoonnummer* :</td><td><input type="text" name="telefoonnummer<?php print ($i); ?>"<?php
                                   if (isset($_POST["telefoonnummer" . $i])) {
                                        print (" value=" . $_POST["telefoonnummer" . $i]);
                                   }
                                   ?> required></td></tr>
                                   <tr><td>Emailadres* :</td><td><input type="text" name="email<?php print ($i); ?>"<?php
                                   if (isset($_POST["email" . $i])) {
                                        print (" value=" . $_POST["email" . $i]);
                                   }
                                   ?> required></td></tr>
                                   <?php
                              }
                              ?>
                              <tr><td><input type="submit" name="afronden" value="Afronden" class="btn-main"></td></tr>
                         </form>
                    </table>
               </div>
          </div>
          <?php include "footer.php"; ?>
     </div>
</body>
</html>
