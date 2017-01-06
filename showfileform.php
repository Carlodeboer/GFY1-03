<?php
define("toegang", true);

 ?>

<form name="imageopvraagform" method="get" action="DBshowfoto.php">
  <tr>
   <td valign="top">
    <label for="imageid">Image ID</label>
   </td>
   <td valign="top">
    <input  type="int" name="imageid" maxlength="30" size="30">
   </td>
  </tr>
  <tr>
   <td colspan="2" style="text-align:center">
    <input type="submit" value="Verzenden" class="btn-main">
   </td>
  </tr>
  </table>
</form>
