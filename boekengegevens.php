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

                    <h2><?php print($labels[$j]); $j++; ?></h2>
                    <form method="POST" action="boekengegevenscheck.php">
                         <?php
                         for ($i = 1; $i <= $aantalPersonen; $i++) {
                              if ($aantalPersonen != 1) {
                                   print("<h3>Persoon " . $i . ":</h3>");
                              }
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
                              <?php } ?>
                              <div class="form-group label-static is-empty">
                                   <input type="submit" name="volgende" value="<?php print($labels[$j]); $j++; ?>" class="btn btn-raised btn-primary">
                              </div>
                         </form>
                    </div>
               </div>
          </div>
          <?php include "footer.php"; ?>
     </div>
</body>
</html>
