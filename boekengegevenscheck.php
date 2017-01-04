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
                    }
                    extract($_SESSION["klantGegevens"]);
                    ?>
                    <table>
                         <tr>
                              <td><h2>Reisgegevens van <?php print($vakantienaam); ?>:</h2></td>
                         </tr><tr>
                              <td>Begindatum:</td>
                              <td><?php print($begindatum)?></td>
                         </tr><tr>
                              <td>Einddatum:</td>
                              <td><?php print($einddatum)?></td>
                         </tr><tr>
                              <td>Aantal personen:</td>
                              <td><?php print ($aantalPersonen) ?></td>
                         </tr><tr>
                              <td>Vervoer van luchthaven Lissabon:</td>
                              <td><?php
                              if ($vervoerHeen) {
                                   print("Ja");
                              } else {
                                   print("Nee");
                              }
                              ?></td>
                         </tr><tr>
                              <td>Vervoer naar luchthaven Lissabon:</td>
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
                         if ($bijzonderheden != NULL) {
                              print ("<tr><td>Bijzonderheden:</td><td>" . $bijzonderheden . "</td></tr>");
                         }
                         ?>
                         <?php
                         if ($opmerkingen != NULL) {
                              print ("<tr><td>Opmerkingen:</td><td>" . $opmerkingen . "</td></tr>");
                         }
                         ?>
                         <tr>
                              <td>Vakantienaam:</td>
                              <td><?php print($vakantienaam); ?></td>
                         <tr>
                              <td><h2>Persoonlijke gegevens:</h2></td>
                         </tr>
                         <?php
                         for ($i = 1; $i <= $aantalPersonen; $i++) {
                              if ($aantalPersonen != 1) {
                                   ?>
                                   <tr>
                                        <td><h3>Persoon <?php print ($i) ?></h3></td>
                                   </tr>
                                   <?php
                              }
                              ?>
                              <tr>
                                   <td>Voornaam:</td>
                                   <td><?php print(${"voornaam" . $i}); ?></td>
                              </tr><tr>
                                   <td>Achternaam:</td>
                                   <td><?php print(${"achternaam" . $i}); ?></td>
                              </tr><tr>
                                   <td>Adres:</td>
                                   <td><?php print(${"straat" . $i} . " " . ${"huisnummer" . $i}); ?></td>
                              </tr><tr>
                                   <td>Postcode:</td>
                                   <td><?php print(${"postcode" . $i}); ?></td>
                              </tr><tr>
                                   <td>Woonplaats:</td>
                                   <td><?php print(${"woonplaats" . $i}); ?></td>
                              </tr><tr>
                                   <td>Land:</td>
                                   <td><?php print(${"land" . $i}); ?></td>
                              </tr><tr>
                                   <td>Geboortedatum:</td>
                                   <td><?php print(${"geboortedatum" . $i}); ?></td>
                              </tr><tr>
                                   <td>Telefoonnummer</td>
                                   <td><?php print(${"telefoonnummer" . $i}); ?></td>
                              </tr><tr>
                                   <td>E-mailadres:</td>
                                   <td><?php print(${"email" . $i}); ?></td>
                              </tr>
                              <?php
                         }
                         ?>
                         <tr>
                              <td>
                                   <form method="POST" action="boekengegevenscheckafronden.php">
                                        <div class="form-group label-static is-empty">
                                             <input type="submit" name="afronden" value="Afronden" class="btn btn-raised btn-primary">
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
