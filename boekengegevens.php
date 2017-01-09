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
                    $labels = boekenTaal2();
                    $j = 0;
                    // Als er toevallig al een SESSION gestart is, worden de gegevens uit die array verwijderd.
                    if (isset($_SESSION["klantGegevens"])) {
                         session_unset($_SESSION["klantGegevens"]);
                    }

                    // Voegt een nieuwe element toe aan de array. $array is de naam van de array waar het aan toegevoegd moet worden. $naam is de index van het element.
                    // Als $persoon is ingevuld, wordt $naam en $persoon samengevoegd. $naam is ook de naam van het POST-veld.
                    toevoegenAanArray("begindatum", "klantGegevens", "");
                    toevoegenAanArray("einddatum", "klantGegevens", "");
                    toevoegenAanArray("aantalPersonen", "klantGegevens", "");
                    toevoegenAanArray("vervoerHeen", "klantGegevens", "");
                    toevoegenAanArray("vervoerTerug", "klantGegevens", "");
                    toevoegenAanArray("vakantienaam", "klantGegevens", "");

                    // Voegt alleen 'opmerkingen' als 'opmerkingen' is ingevuld.
                    if ($_POST["opmerkingen"] != "") {
                         toevoegenAanArray("opmerkingen", "klantGegevens", "");
                    } else {
                         $_SESSION["klantGegevens"]["opmerkingen"] = NULL;
                    }
                    // Haalt alle elementen uit array en maakt variablen met als naam de index en als waarde het element.
                    extract($_SESSION["klantGegevens"]);
                    ?>

                    <h2><?php print($labels[$j]); $j++; ?></h2>

                    <form method="POST" action="boekengegevenscheck.php">
                         <?php
                         // Print voor elk persoon een lijst voor het invullen van gegevens.
                         for ($i = 1; $i <= $aantalPersonen; $i++) {
                              $j = 1;
                              // Alleen als er meerdere personen meegaan, komt er een kopje, bijvoorbeeld "Persoon 1".
                              if ($aantalPersonen != 1) {

                                   print("<h3>" . $labels[$j] . $i . ":</h3>");
                              }
                              $j++;
                              ?>
                              <div class="form-group label-static is-empty">
                                   <label for="i5i" class="control-label"><?php print($labels[$j]); $j++; ?>*</label>
                                   <input type="text" name="voornaam<?php print ($i); ?>" class="form-control" id="i5i" required>
                                   <span class="help-block"><?php print($labels[$j]); $j++; ?><?php ?></span>
                              </div>
                              <div class="form-group label-static is-empty">
                                   <label for="i5i" class="control-label"><?php print($labels[$j]); $j++; ?>*</label>
                                   <input type="text" name="achternaam<?php print ($i); ?>" class="form-control" id="i5i" required>
                                   <span class="help-block"><?php print($labels[$j]); $j++; ?></span>
                              </div>
                              <div class="form-group label-static is-empty">
                                   <label for="i5i" class="control-label"><?php print($labels[$j]); $j++; ?>*</label>
                                   <input type="text" name="straat<?php print ($i); ?>" class="form-control" id="i5i" required>
                                   <span class="help-block"><?php print($labels[$j]); $j++; ?></span>
                              </div>
                              <div class="form-group label-static is-empty">
                                   <label for="i5i" class="control-label"><?php print($labels[$j]); $j++; ?>*</label>
                                   <input type="text" name="huisnummer<?php print ($i); ?>" class="form-control" id="i5i" required>
                                   <span class="help-block"><?php print($labels[$j]); $j++; ?></span>
                              </div>
                              <div class="form-group label-static is-empty">
                                   <label for="i5i" class="control-label"><?php print($labels[$j]); $j++; ?>*</label>
                                   <input type="text" name="postcode<?php print ($i); ?>" class="form-control" id="i5i" required>
                                   <span class="help-block"><?php print($labels[$j]); $j++; ?></span>
                              </div>
                              <div class="form-group label-static is-empty">
                                   <label for="i5i" class="control-label"><?php print($labels[$j]); $j++; ?>*</label>
                                   <input type="text" name="woonplaats<?php print ($i); ?>" class="form-control" id="i5i" required>
                                   <span class="help-block"><?php print($labels[$j]); $j++; ?></span>
                              </div>
                              <div class="form-group label-static is-empty">
                                   <label for="i5i" class="control-label"><?php print($labels[$j]); $j++; ?>*</label>
                                   <input type="text" name="land<?php print ($i); ?>" class="form-control" id="i5i" required>
                                   <span class="help-block"><?php print($labels[$j]); $j++; ?></span>
                              </div>
                              <div class="form-group label-static is-empty">
                                   <label for="i5i" class="control-label"><?php print($labels[$j]); $j++; ?>*</label>
                                   <input type="date" name="geboortedatum<?php print ($i); ?>" class="form-control" id="i5i" required>
                                   <span class="help-block"><?php print($labels[$j]); $j++; ?></span>
                              </div>
                              <div class="form-group label-static is-empty">
                                   <label for="i5i" class="control-label"><?php print($labels[$j]); $j++; ?>*</label>
                                   <input type="text" name="telefoonnummer<?php print ($i); ?>" class="form-control" id="i5i" required>
                                   <span class="help-block"><?php print($labels[$j]); $j++; ?></span>
                              </div>
                              <div class="form-group label-static is-empty">
                                   <label for="i5i" class="control-label"><?php print($labels[$j]); $j++; ?>*</label>
                                   <input type="text" name="email<?php print ($i); ?>" class="form-control" id="i5i" required>
                                   <span class="help-block"><?php print($labels[$j]); $j++; ?></span>
                              </div>
                              <div class="form-group label-static is-empty">
                                   <label for="i5i" class="control-label"><?php print($labels[$j]); $j++; ?>*</label>
                                   <select id="s1" class="form-control" name="kledingmaat<?php print ($i); ?>">
                                        <option value="M">M</option>
                                        <option value="L">L</option>
                                        <option value="XL">XL</option>
                                        <option value="XXL">XXL</option>
                                        <option value="Anders"><?php print($labels[$j]); $j++; ?></option>
                                   </select>
                              </div>
                              <div class="form-group label-static is-empty">
                                   <label for="i5i" class="control-label"><?php print($labels[$j]); $j++; ?>*</label>
                                   <select id="s1" class="form-control" name="schoenmaat<?php print ($i); ?>">
                                        <option value="42">42</option>
                                        <option value="43">43</option>
                                        <option value="44">44</option>
                                        <option value="45">45</option>
                                        <option value="Anders"><?php print($labels[$j]); $j++; ?></option>
                                   </select>
                              </div>
                              <div class="form-group label-static is-empty">
                                   <label for="i5i" class="control-label"><?php print($labels[$j]); $j++; ?></label>
                                   <input type="text" name="bijzonderheden<?php print ($i); ?>" class="form-control" id="i5i">
                                   <span class="help-block"><?php print($labels[$j]); $j++; ?></span>
                              </div>
                              <?php
                         }
                         // Verknopknop
                         ?>
                         <div class="form-group label-static is-empty">
                              <input type="submit" name="volgende" value="<?php print($labels[$j]);?>" class="btn btn-raised btn-primary">
                         </div>
                    </form>
               </div>
          </div>
          <?php include "footer.php"; ?>
     </div>
</body>
</html>
