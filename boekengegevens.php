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

                    toevoegenAanArray("begindatum", "klantGegevens", "");
                    toevoegenAanArray("einddatum", "klantGegevens", "");
                    toevoegenAanArray("aantalPersonen", "klantGegevens", "");
                    toevoegenAanArray("vervoerHeen", "klantGegevens", "");
                    toevoegenAanArray("vervoerTerug", "klantGegevens", "");
                    toevoegenAanArray("vakantienaam", "klantGegevens", "");


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
                              <div class="form-group label-static is-empty">
                                   <label for="i5i" class="control-label">Voornaam*</label>
                                   <input type="text" name="voornaam<?php print ($i); ?>" class="form-control" id="i5i" required>
                                   <span class="help-block">Voer uw voornaam in</span>
                              </div>
                              <div class="form-group label-static is-empty">
                                   <label for="i5i" class="control-label">Achternaam*</label>
                                   <input type="text" name="achternaam<?php print ($i); ?>" class="form-control" id="i5i" required>
                                   <span class="help-block">Voer uw achternaam in</span>
                              </div>
                              <div class="form-group label-static is-empty">
                                   <label for="i5i" class="control-label">Straatnaam*</label>
                                   <input type="text" name="straat<?php print ($i); ?>" class="form-control" id="i5i" required>
                                   <span class="help-block">Voer uw straatnaam in</span>
                              </div>
                              <div class="form-group label-static is-empty">
                                   <label for="i5i" class="control-label">Huisnummer*</label>
                                   <input type="text" name="huisnummer<?php print ($i); ?>" class="form-control" id="i5i" required>
                                   <span class="help-block">Voer uw huisnummer in</span>
                              </div>
                              <div class="form-group label-static is-empty">
                                   <label for="i5i" class="control-label">Postcode*</label>
                                   <input type="text" name="postcode<?php print ($i); ?>" class="form-control" id="i5i" required>
                                   <span class="help-block">Voer uw postcode in</span>
                              </div>
                              <div class="form-group label-static is-empty">
                                   <label for="i5i" class="control-label">Woonplaats*</label>
                                   <input type="text" name="woonplaats<?php print ($i); ?>" class="form-control" id="i5i" required>
                                   <span class="help-block">Voer uw woonplaats in</span>
                              </div>
                              <div class="form-group label-static is-empty">
                                   <label for="i5i" class="control-label">Land*</label>
                                   <input type="text" name="land<?php print ($i); ?>" class="form-control" id="i5i" required>
                                   <span class="help-block">Voer het land in</span>
                              </div>
                              <div class="form-group label-static is-empty">
                                   <label for="i5i" class="control-label">Geboortedatum*</label>
                                   <input type="date" name="geboortedatum<?php print ($i); ?>" class="form-control" id="i5i" required>
                                   <span class="help-block">Voer uw geboortedatum in</span>
                              </div>
                              <div class="form-group label-static is-empty">
                                   <label for="i5i" class="control-label">Telefoonnummer*</label>
                                   <input type="text" name="telefoonnummer<?php print ($i); ?>" class="form-control" id="i5i" required>
                                   <span class="help-block">Voer uw telefoonnummer in</span>
                              </div>
                              <div class="form-group label-static is-empty">
                                   <label for="i5i" class="control-label">E-mailadres*</label>
                                   <input type="text" name="email<?php print ($i); ?>" class="form-control" id="i5i" required>
                                   <span class="help-block">Voer uw e-mailadres in</span>
                              </div>
                              <div class="form-group label-static is-empty">
                                   <label for="i5i" class="control-label">Bijzonderheden</label>
                                   <input type="text" name="bijzonderheden<?php print ($i); ?>" class="form-control" id="i5i">
                                   <span class="help-block">Hiermee kunt u aangeven welke allergieën of ziektes u heeft, zodat daar rekening mee kan worden gehouden.</span>
                              </div>
                              <?php } ?>
                              <div class="form-group label-static is-empty">
                                   <input type="submit" name="volgende" value="Volgende" class="btn btn-raised btn-primary">
                              </div>
                         </form>
                    </div>
               </div>
          </div>
          <?php include "footer.php"; ?>
     </div>
</body>
</html>
