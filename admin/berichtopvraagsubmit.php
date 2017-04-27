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
<?php
include "../toegang.php";
?>
<div id="contentwrapper">
     <h2>Berichten contactformulier</h2>
     <p>Vul een e-mail adres in om de inhoud van de gestuurde e-mail te zien.</p>
     <form name="contactform" method="post" action="beheerpaneel.php?beheer=Berichten+opvragen">
          <div class="form-group label-static is-empty">
               <label for="i5i" class="control-label">E-mailadres *</label>
               <input  type="text" name="email" class="form-control">
          </div>
          <input type="submit" name="zoekBerichten" value="Submit" class="btn btn-raised btn-primary">
     </form>

     <div class="row">
          <div class="col-md-12">
               <table class="table table-striped table-hover nieuwsberichtenbewerken">

                    <tr>
                         <th>Naam</th>
                         <th>E-mailadres</th>
                         <th>Onderwerp</th>
                         <th>Datum</th>
                         <!-- <th>Markeren</th> -->
                    </tr>

                    <?php
                    $pdo = newPDO();
                    $pdo->beginTransaction();
                    $stmt2 = $pdo->prepare("SELECT * FROM contactformulier ORDER BY datum"); //haalt gegevens uit de tabel
                    $stmt2->execute(array());
                    $pdo->commit();

                    while($bericht = $stmt2 -> fetch()) {
                         $idbericht = $bericht["idbericht"];
                         $voornaam = $bericht["voornaam"];
                         $achternaam = $bericht["achternaam"];
                         $email = $bericht["email"];
                         $onderwerp = $bericht["onderwerp"];
                         $datum = $bericht["datum"];
                         $gelezen = $bericht["gelezen"];

                         if (!$gelezen) {
                              $voornaam = "<b>" . $voornaam . "</b>";
                              $achternaam = "<b>" . $achternaam . "</b>";
                              $email = "<b>" . $email . "</b>";
                              $onderwerp = "<b>" . $onderwerp . "</b>";
                              $datum = "<b>" . $datum . "</b>";
                         }

                         echo ("<tr>

                         <td onclick=\"location='beheerpaneel.php?beheer=Berichten&berichtID={$bericht['idbericht']}'\">" . $voornaam . " " . $achternaam . "</td>
                         <td onclick=\"location='beheerpaneel.php?beheer=Berichten&berichtID={$bericht['idbericht']}'\">" . $email . "</td>
                         <td onclick=\"location='beheerpaneel.php?beheer=Berichten&berichtID={$bericht['idbericht']}'\">" . $onderwerp . "</td>
                         <td onclick=\"location='beheerpaneel.php?beheer=Berichten&berichtID={$bericht['idbericht']}'\">" . $datum . "</td>");

                         // if(!$gelezen) {
                              ?>
                              <!-- <td>
                                   <form method='POST'>
                                        <input type="hidden" name="idbericht" value="<?php print($idbericht)?>">
                                        <input type='submit' name='is-gelezen' value='Gelezen' class='btn btn-raised btn-warning'>
                                   </form>
                              </td> -->
                              <?php
                         // }
                    }

                    ?>

               </table>
          </div>
     </div>
</div>
