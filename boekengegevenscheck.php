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
     <title>Gegevens controleren</title>
     <?php include 'head.php'; ?>
</head>
<body>
     <div id="container">
          <?php
          include 'header.php';
          ?>
          <div id="content">
               <div id="contentwrapper">
                    <?php
                    $j = 0;
                    $labels = boekenTaal3();

                    for ($i = 1; $i <= $_SESSION["klantGegevens"]["aantalPersonen"]; $i++) {
                         toevoegenAanArray("voornaam", "klantGegevens", $i);
                         toevoegenAanArray("achternaam", "klantGegevens", $i);
                         toevoegenAanArray("straat", "klantGegevens", $i);
                         toevoegenAanArray("huisnummer", "klantGegevens", $i);
                         toevoegenAanArray("postcode", "klantGegevens", $i);
                         toevoegenAanArray("woonplaats", "klantGegevens", $i);
                         toevoegenAanArray("land", "klantGegevens", $i);
                         toevoegenAanArray("geboortedatum", "klantGegevens", $i);
                         toevoegenAanArray("telefoonnummer", "klantGegevens", $i);
                         toevoegenAanArray("email", "klantGegevens", $i);
                         toevoegenAanArray("kledingmaat", "klantGegevens", $i);
                         toevoegenAanArray("schoenmaat", "klantGegevens", $i);


                         if (isset($_POST["bijzonderheden" . $i])) {
                              toevoegenAanArray("bijzonderheden", "klantGegevens", $i);
                         } else {
                              $_SESSION["klantGegevens"]["bijzonderheden" . $i] = NULL;
                         }
                    }
                    extract($_SESSION["klantGegevens"]);
                    ?>
                    <table>
                         <tr>
                              <td><h2><?php print($labels[$j]); $j++; print($vakantienaam); ?>:</h2></td>
                         </tr><tr>
                              <td><?php print($labels[$j]); $j++; ?></td>
                              <td><?php print($begindatum)?></td>
                         </tr><tr>
                              <td><?php print($labels[$j]); $j++; ?></td>
                              <td><?php print($einddatum)?></td>
                         </tr><tr>
                              <td><?php print($labels[$j]); $j++; ?></td>
                              <td><?php print ($aantalPersonen) ?></td>
                         </tr><tr>
                              <td><?php print($labels[$j]); $j++; ?></td>
                              <td><?php
                              if ($vervoerHeen) {
                                   print($labels[$j]); $j++; $j++;
                              } else {
                                   $j++; print($labels[$j]); $j++;
                              }
                              ?></td>
                         </tr><tr>
                              <td><?php print($labels[$j]); $j++; ?></td>
                              <td><?php
                              if ($vervoerTerug) {
                                   print($labels[$j]); $j++; $j++;
                              } else {
                                   $j++; print($labels[$j]); $j++;
                              }
                              ?></td>
                         </tr>
                         <?php
                         if ($opmerkingen != NULL) {
                              print ("<tr><td>". $labels[$i]. ":</td><td>" . $opmerkingen . "</td></tr>");
                              $j++;
                         } else {
                              $j++;
                         }
                         ?>
                         <tr>
                              <td><?php print($labels[$j]); $j++; ?></td>
                              <td><?php print($vakantienaam); ?></td>
                              <tr>
                                   <td><h2><?php print($labels[$j]); $j++; ?>:</h2></td>
                              </tr>
                              <?php
                              for ($i = 1; $i <= $aantalPersonen; $i++) {
                                   if ($aantalPersonen != 1) {
                                        ?>
                                        <tr>
                                             <td><h3><?php print($labels[$j]); $j++; print ($i) ?></h3></td>
                                        </tr>
                                        <?php
                                   } else {
                                        $j++;
                                   }
                                   ?>
                                   <tr>
                                        <td><?php print($labels[$j]); $j++; ?>:</td>
                                        <td><?php print(${"voornaam" . $i}); ?></td>
                                   </tr><tr>
                                        <td><?php print($labels[$j]); $j++; ?>:</td>
                                        <td><?php print(${"achternaam" . $i}); ?></td>
                                   </tr><tr>
                                        <td><?php print($labels[$j]); $j++; ?>:</td>
                                        <td><?php print(${"straat" . $i} . " " . ${"huisnummer" . $i}); ?></td>
                                   </tr><tr>
                                        <td><?php print($labels[$j]); $j++; ?>:</td>
                                        <td><?php print(${"postcode" . $i}); ?></td>
                                   </tr><tr>
                                        <td><?php print($labels[$j]); $j++; ?>:</td>
                                        <td><?php print(${"woonplaats" . $i}); ?></td>
                                   </tr><tr>
                                        <td><?php print($labels[$j]); $j++; ?>:</td>
                                        <td><?php print(${"land" . $i}); ?></td>
                                   </tr><tr>
                                        <td><?php print($labels[$j]); $j++; ?>:</td>
                                        <td><?php print(${"geboortedatum" . $i}); ?></td>
                                   </tr><tr>
                                        <td><?php print($labels[$j]); $j++; ?>:</td>
                                        <td><?php print(${"telefoonnummer" . $i}); ?></td>
                                   </tr><tr>
                                        <td><?php print($labels[$j]); $j++; ?>:</td>
                                        <td><?php print(${"email" . $i}); ?></td>
                                   </tr>
                                   <tr>
                                        <td><?php print($labels[$j]); $j++; ?>:</td>
                                        <td><?php print(${"kledingmaat" . $i}); ?></td>
                                   </tr>
                                   <tr>
                                        <td><?php print($labels[$j]); $j++; ?>:</td>
                                        <td><?php print(${"schoenmaat" . $i}); ?></td>
                                   </tr>
                                   <?php if (${"bijzonderheden" . $i} != NULL) {
                                        print ("<tr><td>". $labels[$j] . "</td><td>" . ${"bijzonderheden" . $i} . "</td></tr>");
                                        $j++;
                                   } else {
                                        $j++;
                                   }
                              }
                              ?>
                              <tr>
                                   <td>
                                        <form method="POST" action="boekengegevenscheckafronden.php">
                                             <div class="form-group label-static is-empty">
                                                  <input type="submit" name="afronden" value="<?php print($labels[$j]); $j++; ?>" class="btn btn-raised btn-primary">
                                             </div>
                                        </form>
                                   </td>
                              </tr>
                         </table>
                    </div>
               </div>
               <?php include 'footer.php'; ?>
          </div>
     </body>
     </html>
