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
<div class="col-md-8">
     <table id="calendar">
          <tr>
               <th colspan="7">
                    <form method="POST">
                         <div class="col-md-2">
                              <!-- agenda in verschillende talen weergeven -->
                              <?php $labels = agendaTaal(); ?>
                              <input type="submit" name="vorige" value="<?php print($labels[0]); ?>" class="btn btn-raised btn-primary">
                         </div>
                         <div class="col-md-6">
                              <?php
                              // Als het cijfer van de maand begin met een '0', dan wordt deze eraf gehaald. Zo kan hij makkelijk uit $labels worden gehaald.
                              $maand = ltrim($maand, "0");
                              print($labels[$maand] . " " . $jaar);?>
                         </div>
                         <div class="col-md-2">
                              <input type="submit" name="volgende" value="<?php print($labels[13]); ?>" class="btn btn-raised btn-primary">
                         </div>
                    </form>
               </th>
          </tr>
          <tr>
               <?php
               $k = 14;
               // Weekdagen printen in dikgedrukte, groene letters.
               for($i = 1; $i <= 7; $i++) {
                    print("<td class='text-center text-primary'><strong>" . $labels[$k] . "</strong></td>");
                    $k++;
               }
               ?>
          </tr>
          <tr>
               <?php
               // Aantal lege cellen printen.
               for ($i = 0; $i < $blank; $i++) {
                    print("<td></td>");
               }
               // Dagen van de maand printen in een cel, eventueel met omschrijving.
               for ($i = 1; $i <= $daysInMonth; $i++) {
                    // Als er voor de dag al 'uitval' aan de array is toegevoegd en de 'uitval' is ook gelijk aan het totale aantal motoren, dan worden die uit de array gegooid.
                    if(isset($objArray[$i . "uitval"]) && $objArray[$i . "uitval"] == $aantalMotoren) {
                         unset($objArray[$i . "uitval"]);
                         unset($objArray[$i . "omschrijving"]);
                    }
                    // Op alle dagen van behalve zaterdag worden de uitval geprint.
                    // ALs de beheerder de agenda bekijkt is er een 'admin_session' actief, dan wordt ook de omschrijving geprint.
                    if (($i + $blank) % 7 != 0) {

                         print ("<td>" . $i);
                         if (isset($objArray[$i . "uitval"])) {
                              print(": ");
                              if (isset($_SESSION['admin_session'])) {
                                   print ($objArray[$i . "omschrijving"]);
                              }
                              print ("<br>" . $objArray[$i . "uitval"] . $labels[$k]);
                         }
                         print ("</td>");
                    }
                    // Op zaterdagen wordt ook een link geprint, als je hierop klikt wordt de geklikte datum weergegeven in het formulier naast de agenda.
                    // Als de beheerder is ingelogd, wordt de agenda in het beheerpaneel geopend wanneer er op een zaterdag geklikt wordt.
                    if (($i + $blank) % 7 == 0) {
                         if (isset($_SESSION['admin_session'])) {
                              print ("<td><a href='http://" . $_SERVER['HTTP_HOST'] . "/GFY1-03/admin/beheerpaneel.php?beheer=Agenda&dag={$i}'>");
                         } else {
                              print ("<td><a href='http://" . $_SERVER['HTTP_HOST'] . "/GFY1-03/boeken.php?&dag={$i}'>");
                         }
                         print($i);
                         if (isset($objArray[$i . "uitval"])) {
                              if (isset($_SESSION['admin_session'])) {
                                   print (": " . $objArray[$i . "omschrijving"]);
                              }
                              print (":<br>" . $objArray[$i . "uitval"] . " $labels[$k]");
                         }
                         print ("</a></td></tr><tr>");
                    }
               }

               // Na de dagen van de maand worden vaak ook nog een aantal lege cellen getoond om de kalender compleet te maken.
               for ($i = 0; ($i + $blank + $daysInMonth) % 7 != 0; $i++) {
                    print("<td></td>");
               }
               ?>
          </tr>
     </table>
</div>
