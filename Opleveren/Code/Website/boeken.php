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
     <title>Boeken</title>
     <?php include 'head.php'; ?>
</head>
<body>
     <div id="container">
          <?php include 'header.php';
          $labels = boekenTaal();
          ?>
          <div id="content">
               <div id="contentwrapper">
                    <h2><?php print $labels[0]; ?></h2>
                    <?php
                    // Variabelen van de agenda alvast laden, deze zijn namelijk nodig voor het selecteren van begin- en einddatum.
                    include("admin/agenda/agendaVariabelen.php");
                    $labels = boekenTaal();
                    $j = 1;
                    ?>
                    <div class="col-md-4">
                         <form method="POST" action="boekengegevens.php" class="form-horizontal">
                              <div class="form-group label-static is-empty">
                                   <label for="i5i" class="control-label"><?php print($labels[$j]); $j++; ?>*</label>
                                   <input type="date" name="begindatum" readonly required

                                   <?php
                                   $jaar2 = $_SESSION["jaarnummer"];
                                   $maand2 = $_SESSION["maandnummer"];
                                   // Als er een dag is geselecteerd in de kalender, wordt hij ingevuld in het formulier. Daarom ook een 'readonly'-veld, het kan niet worden aangepast.
                                   if (isset($_GET["dag"])) {
                                        $dag2 = $_GET["dag"];
                                        // Als de lengte van de dag of maand gelijk is aan 1 karakter, wordt er een 0 voor geplakt. Dit heeft te maken met de notitie van de datum.
                                        if (strlen($dag2) == 1) {
                                             $dag2 = 0 . $dag2;
                                        }
                                        if (strlen($maand2) == 1) {
                                             $maand2 = 0 . $maand2;
                                        }
                                        $begindatum = date("Y-m-d", mktime(0,0,0, $maand2, $dag2, $jaar2));
                                   }
                                   // Als er geen dag geselecteerd is, wordt aankomende zaterdag in het veld gezet.
                                   else {
                                        $aankomendeZaterdag = strtotime('next saturday', $date);
                                        $begindatum = date('Y-m-d', $aankomendeZaterdag);
                                        $dag2 = date('d', $aankomendeZaterdag);
                                   }

                                   print("value=\"" . $begindatum . "\"");
                                   // Variable 'begindatum' wordt teruggezet naar oude notatie, voor het selecteren van einddatum.
                                   $begindatum = mktime(0,0,0, $maand2, $dag2, $jaar2);
                                   ?>
                                   class="form-control" id="inputdatum1">
                                   <span class="help-block"><?php print($labels[$j]); $j++; ?></span>
                              </div>
                              <div class="form-group label-static is-empty">
                                   <label for="i5i" class="control-label"><?php print($labels[$j]); $j++; ?>*</label>
                                   <input type="date" name="einddatum" readonly required
                                   <?php
                                   // Variabele 'einddatum' is zes dagen groter dan de begindatum.
                                   $einddatum = strtotime('+ 6 days', $begindatum);
                                   $einddatum = date('Y-m-d', $einddatum);

                                   print("value=\"" . $einddatum . "\"");
                                   // Variable 'begindatum'  wordt teruggezet naar oude notatie, voor het ophalen uit database.
                                   $begindatum = date("Y-m-d", mktime(0,0,0, $maand2, $dag2, $jaar2));
                                   ?>
                                   class="form-control" id="i5i">
                                   <span class="help-block"><?php print($labels[$j]); $j++; ?></span>
                              </div>
                              <div class="form-group label-static is-empty">
                                   <label for="i5i" class="control-label"><?php print($labels[$j]); $j++; ?>*</label>
                                   <?php
                                   // Haalt aantal niet-beschikbare motoren op.
                                   $stmt7 = $pdo->prepare("SELECT aantal FROM reserveringen WHERE begindatum = ?");
                                   $stmt7->execute(array($begindatum));
                                   $aantalNietBeschikbaar = 0;
                                   while ($row7 = $stmt7->fetch()) {
                                        $aantal = $row7["aantal"];
                                        $aantalNietBeschikbaar = $aantalNietBeschikbaar + $aantal;
                                   }
                                   // Selecteert aantal wel beschikbare motoren.
                                   $aantalBeschikbaar = $aantalMotoren - $aantalNietBeschikbaar;
                                   // Als er geen motoren beschikbaar zijn, wordt het volgende veld op 'disabled' gezet, zo kan het niet aangepast worden.
                                   // De verzendknop gaat ook naar 'disabled', zodat men niet naar de volgende pagina kan.
                                   if($aantalBeschikbaar <= 0) {
                                        print("<input type='text' class='form-control' disabled='' value='" . $labels[$j] . "'>");
                                        $j++;
                                   } else {
                                        ?>
                                        <select id="s1" class="form-control" name="aantalPersonen">
                                             <?php
                                             // Print voor het aantal mogelijke personen een 'option'.
                                             for ($i = 1; $i <= $aantalBeschikbaar; $i++) {
                                                  print ("<option value='" . $i . "'>" . $i . "</option>");
                                             }
                                             ?>
                                        </select>
                                        <?php
                                        $j++;
                                   }
                                   ?>

                              </div>
                              <div class="form-group label-static is-empty">
                                   <label for="i5i" class="control-label"><?php print($labels[$j]); $j++; ?>*</label>
                                   <div class="radio">
                                        <label>
                                             <input type="radio" name="vervoerHeen" value="1" checked> <?php print($labels[$j]); $j++; ?>
                                        </label>
                                   </div>
                                   <div class="radio">
                                        <label>
                                             <input type="radio" name="vervoerHeen" value="0"> <?php print($labels[$j]); $j++; ?>
                                        </label>
                                   </div>
                              </div>
                              <div class="form-group label-static is-empty">
                                   <label for="i5i" class="control-label"><?php print($labels[$j]); $j++; ?>*</label>
                                   <div class="radio">
                                        <label>
                                             <input type="radio" name="vervoerTerug" value="1" checked> <?php print($labels[$j]); $j++; ?>
                                        </label>
                                   </div>
                                   <div class="radio">
                                        <label>
                                             <input type="radio" name="vervoerTerug" value="0"> <?php print($labels[$j]); $j++; ?>
                                        </label>
                                   </div>
                              </div>

                              <div class="form-group label-static is-empty">
                                   <label for="i5i" class="control-label"><?php print($labels[$j]); $j++; ?></label>
                                   <textarea name="opmerkingen" class="form-control"></textarea>
                              </div>
                              <div class="form-group label-static is-empty">
                                   <label for="i5i" class="control-label"><?php print($labels[$j]); $j++; ?>*</label>
                                   <input type="text" name="vakantienaam" class="form-control" id="i5i" required>
                                   <span class="help-block"><?php print($labels[$j]); $j++; ?></span>
                              </div>
                              <div class="form-group label-static is-empty">
                                   <input type="submit" name="volgende" <?php if($aantalBeschikbaar <= 0) {
                                        print("disabled=''");
                                   }?> value="<?php print($labels[$j]); $j++; ?>" class="btn btn-raised btn-primary">
                              </div>
                         </form>
                    </div>
                    <?php
                    // Agenda laten zien.
                    include("admin/agenda/agenda.php");
                    ?>
               </div>
          </div>

     </div>
     <?php include 'footer.php'; ?>
     <script> $.material.init(); </script>
</body>
</html>
