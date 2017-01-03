<?php
include "../toegang.php";
?>
<br><br>
<div id="contentwrapper">
     <form name="contactform" method="post" action="beheerpaneel.php?beheer=berichtopvraag">
          <table width="450px">

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
