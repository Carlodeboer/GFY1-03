<div class="col-md-8">
     <table id="calendar">
          <tr>
               <th colspan="7">
                    <form method="POST">
                         <div class="col-md-2">
                              <input type="submit" name="vorige" value="Vorige" class="btn btn-raised btn-primary">
                         </div>
                         <div class="col-md-6">
                              <?php print("{$title} {$jaar}"); ?>
                         </div>
                         <div class="col-md-2">
                              <input type="submit" name="volgende" value="Volgende" class="btn btn-raised btn-primary">
                         </div>
                    </form>
               </th>
          </tr>
          <tr>
               <?php
               foreach ($weekDays as $key => $weekDay) {
                    print("<td class='text-center'>" . $weekDay . "</td>");
               }
               ?>
          </tr>
          <tr>
               <?php
               for ($i = 0; $i < $blank; $i++) {
                    print("<td></td>");
               }

               for ($i = 1; $i <= $daysInMonth; $i++) {
                    if (($i + $blank) % 7 != 0) {
                         if(isset($objArray[$i . "uitval"]) && $objArray[$i . "uitval"] == $aantalMotoren) {
                              unset($objArray[$i . "uitval"]);
                              unset($objArray[$i . "omschrijving"]);
                         }

                         print ("<td>");
                         if (isset($objArray[$i . "uitval"])) {
                              print($i . ":");
                              if (isset($_SESSION['admin_session'])) {
                                   print ($objArray[$i . "omschrijving"] . "<br>" . $objArray[$i . "uitval"] . " motor(en) beschikbaar");
                              } else {
                                   print ("<br>" . $objArray[$i . "uitval"] . " motor(en) beschikbaar");
                              }
                         } else {
                              print ($i);
                         }
                         print ("</td>");
                    }
                    if (($i + $blank) % 7 == 0) {
                         if (isset($_SESSION['admin_session'])) {
                              print ("<td><a href='http://" . $_SERVER['HTTP_HOST'] . "/GFY1-03/admin/beheerpaneel.php?beheer=Agenda&dag={$i}'>");
                         } else {
                              print ("<td><a href='http://" . $_SERVER['HTTP_HOST'] . "/GFY1-03/boeken.php?&dag={$i}'>");
                         }
                         if (isset($objArray[$i . "uitval"])) {
                              print ($i . ":<br>" . $objArray[$i . "uitval"] . " motor(en) beschikbaar");
                         } else {
                              print ($i);
                         }
                         print ("</a></td></tr><tr>");
                    }
               }
               for ($i = 0; ($i + $blank + $daysInMonth) % 7 != 0; $i++) {
                    print("<td></td>");
               }
               ?>
          </tr>
     </table>
</div>
