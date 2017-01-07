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
