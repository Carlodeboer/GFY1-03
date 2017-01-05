<?php define("toegang", true); ?>
<!DOCTYPE html>
<html>
<head>
     <title>Boeken</title>
     <?php include 'head.php'; ?>
</head>
<body>
     <div id="container">
          <?php include 'header.php'; ?>
          <div id="content">
               <div id="contentwrapper">
                    <h2>Boeken</h2>
                    <?php
                    include("agendaVariabelen.php");
                    ?>
                    <div class="col-md-4">
                         <form method="POST" action="boekengegevens.php" class="form-horizontal">
                              <div class="form-group label-static is-empty">
                                   <label for="i5i" class="control-label">Begindatum*</label>
                                   <input type="date" name="begindatum" readonly required

                                   <?php
                                   if (isset($_GET["dag"])) {
                                        $dag2 = $_GET["dag"];
                                        $jaar2 = $_SESSION["jaarnummer"];
                                        $maand2 = $_SESSION["maandnummer"];

                                        if (strlen($dag2) == 1) {
                                             $dag2 = 0 . $dag2;
                                        }
                                        if (strlen($maand2) == 1) {
                                             $maand2 = 0 . $maand2;
                                        }
                                   } else {
                                        $aankomendeZaterdag = strtotime('next saturday', $date);

                                        $dag2 = date('d', $aankomendeZaterdag);
                                        $maand2 = date('m', $aankomendeZaterdag);
                                        $jaar2 = date('Y', $aankomendeZaterdag);
                                   }
                                   $begindatum = $jaar2 . "-" . $maand2 . "-" . $dag2;
                                   print("value=\"" . $begindatum . "\"");
                                   ?>
                                   class="form-control" id="inputdatum1">
                                   <span class="help-block">Voer een begindatum in</span>
                              </div>


                              <div class="form-group label-static is-empty">
                                   <label for="i5i" class="control-label">Einddatum*</label>
                                   <input type="date" name="einddatum" readonly required
                                   <?php
                                   $dag3 = $dag2 + 6;

                                   if ($dag3 > $daysInMonth) {
                                        $dag3 = $dag3 - $daysInMonth;
                                        $maand3 = $maand2 + 1;
                                   } else {
                                        $maand3 = $maand2;
                                   }

                                   if ($maand3 > 12) {
                                        $jaar3 = $jaar + 1;
                                        $maand3 = 1;
                                   } else {
                                        $jaar3 = $jaar2;
                                   }

                                   if (strlen($dag3) == 1) {
                                        $dag3 = 0 . $dag3;
                                   }
                                   if (strlen($maand3) == 1) {
                                        $maand3 = 0 . $maand3;
                                   }

                                   print("value=\"" . $jaar3 . "-" . $maand3 . "-" . $dag3 . "\"");
                                   ?>
                                   class="form-control" id="i5i">
                                   <span class="help-block">Voer een einddatum in</span>
                              </div>
                              <div class="form-group label-static is-empty">
                                   <label for="i5i" class="control-label">Aantal personen*</label>
                                   <select id="s1" class="form-control" name="aantalPersonen">
                                        <?php
                                        $stmt7 = $pdo->prepare("SELECT aantal FROM reserveringen WHERE begindatum = ?");
                                        $stmt7->execute(array($begindatum));

                                        while ($row7 = $stmt7->fetch()) {
                                             $aantal = $row7["aantal"];
                                             $aantalNietBeschikbaar = $aantalNietBeschikbaar + $aantal;
                                        }
                                        $aantalBeschikbaar = $aantalMotoren - $aantalNietBeschikbaar;

                                        for ($i = 1; $i <= $aantalBeschikbaar; $i++) {
                                             print ("<option value='" . $i . "'>" . $i . "</option>");
                                        }
                                        if($aantalBeschikbaar == 0) {
                                             print("<option value='0'>0</option>");
                                        }
                                        ?>
                                   </select>
                              </div>
                              <div class="form-group label-static is-empty">
                                   <label for="i5i" class="control-label">Vervoer van luchthaven Lissabon*</label>
                                   <div class="radio">
                                        <label>
                                             <input type="radio" name="vervoerHeen" value="1" checked> Ja
                                        </label>
                                   </div>
                                   <div class="radio">
                                        <label>
                                             <input type="radio" name="vervoerHeen" value="0"> Nee
                                        </label>
                                   </div>
                              </div>
                              <div class="form-group label-static is-empty">
                                   <label for="i5i" class="control-label">Vervoer naar luchthaven Lissabon*</label>
                                   <div class="radio">
                                        <label>
                                             <input type="radio" name="vervoerTerug" value="1" checked> Ja
                                        </label>
                                   </div>
                                   <div class="radio">
                                        <label>
                                             <input type="radio" name="vervoerTerug" value="0"> Nee
                                        </label>
                                   </div>
                              </div>

                              <div class="form-group label-static is-empty">
                                   <label for="i5i" class="control-label">Opmerkingen</label>
                                   <textarea name="opmerkingen" class="form-control"></textarea>
                              </div>
                              <div class="form-group label-static is-empty">
                                   <label for="i5i" class="control-label">Vakantienaam*</label>
                                   <input type="text" name="vakantienaam" class="form-control" id="i5i" required>
                                   <span class="help-block">Deze naam gebruikt u later om uw reisgegevens in te zien. Deze gegevens zou u ook eventueel kunnen delen met reisgenoten.</span>
                              </div>
                              <div class="form-group label-static is-empty">
                                   <input type="submit" name="volgende" value="Volgende" class="btn btn-raised btn-primary">
                              </div>
                         </form>
                    </div>
                    <?php
                    include("agenda.php");
                    ?>
               </div>
          </div>
          <?php include 'footer.php'; ?>
     </div>
     <script> $.material.init(); </script>
</body>
</html>
