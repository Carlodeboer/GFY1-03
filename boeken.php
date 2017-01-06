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
                    include("admin/agenda/agendaVariabelen.php");
                    ?>
                    <div class="col-md-4">
                         <form method="POST" action="boekengegevens.php" class="form-horizontal">
                              <div class="form-group label-static is-empty">
                                   <label for="i5i" class="control-label"><?php print $labels[1]; ?>*</label>
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
                                   <span class="help-block"><?php print $labels[8]; ?></span>
                              </div>


                              <div class="form-group label-static is-empty">
                                   <label for="i5i" class="control-label"><?php print $labels[2]; ?>*</label>
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
                                   <span class="help-block"><?php print $labels[8]; ?></span>
                              </div>
                              <div class="form-group label-static is-empty">
                                   <label for="i5i" class="control-label"><?php print $labels[3]; ?>*</label>
                                   <?php

                                   $stmt7 = $pdo->prepare("SELECT aantal FROM reserveringen WHERE begindatum = ?");
                                   $stmt7->execute(array($begindatum));
                                   $aantalNietBeschikbaar = 0;
                                   while ($row7 = $stmt7->fetch()) {
                                        $aantal = $row7["aantal"];
                                        $aantalNietBeschikbaar = $aantalNietBeschikbaar + $aantal;
                                   }
                                   $aantalBeschikbaar = $aantalMotoren - $aantalNietBeschikbaar;
                                   if($aantalBeschikbaar <= 0) {
                                        print("<input type='text' class='form-control' disabled='' value='Geen motoren beschikbaar'>");
                                   } else {
                                        ?>
                                        <select id="s1" class="form-control" name="aantalPersonen">
                                             <?php
                                             for ($i = 1; $i <= $aantalBeschikbaar; $i++) {
                                                  print ("<option value='" . $i . "'>" . $i . "</option>");
                                             }
                                             ?>
                                        </select>
                                        <?php
                                   }
                                   ?>

                              </div>
                              <div class="form-group label-static is-empty">
                                   <label for="i5i" class="control-label"><?php print $labels[4]; ?>*</label>
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
                                   <label for="i5i" class="control-label"><?php print $labels[5]; ?>*</label>
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
                                   <label for="i5i" class="control-label"><?php print $labels[6]; ?></label>
                                   <textarea name="opmerkingen" class="form-control"></textarea>
                              </div>
                              <div class="form-group label-static is-empty">
                                   <label for="i5i" class="control-label"><?php print $labels[7]; ?>*</label>
                                   <input type="text" name="vakantienaam" class="form-control" id="i5i" required>
                                   <span class="help-block"><?php print $labels[10]; ?></span>
                              </div>
                              <div class="form-group label-static is-empty">
                                   <input type="submit" name="volgende" <?php if($aantalBeschikbaar <= 0) {
                                        print("disabled=''");
                                   }?> value="<?php print $labels[11]; ?>" class="btn btn-raised btn-primary">
                              </div>
                         </form>
                    </div>
                    <?php
                    include("admin/agenda/agenda.php");
                    ?>
               </div>
          </div>

     </div>
     <?php include 'footer.php'; ?>
     <script> $.material.init(); </script>
</body>
</html>
