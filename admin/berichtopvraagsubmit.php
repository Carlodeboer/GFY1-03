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
<br><br>
<div id="contentwrapper">
     <form name="contactform" method="post" action="beheerpaneel.php?beheer=Berichten+opvragen">
          <table width="450px">
<p>Vul een e-mail adres in om de inhoud van de gestuurde e-mail te zien.</p>
<br>


               <tr>
                    <td valign="top">
                         <label for="email">E-mailadres *</label>
                    </td>
                    <td valign="top">
                         <input  type="text" name="email" maxlength="80" size="30">
                    </td>
               </tr>

               <tr>
                    <td colspan="2" style="text-align:center">
                         <br><input type="submit" name="zoekBerichten" value="Submit" class="btn btn-raised btn-primary">
                    </td>
               </tr>
          </table>
     </form>
</div>
