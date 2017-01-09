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
<div id="content">
     <div id="contentwrapper">
          <form method="post" action="adminlogin.php">
               <div class="form-group label-static is-empty">
                    <label for="i5i" class="control-label">Gebruikersnaam</label>
                    <input type="text" name="naam" class="form-control" id="i5i">
                    <span class="help-block">Voer een gebruikersnaam in</span>
               </div>
               <div class="form-group label-static is-empty">
                    <label for="i5i" class="control-label">Wachtwoord</label>
                    <input type="password" name="wachtwoord" class="form-control" id="i5i">
                    <span class="help-block">Voer een wachtwoord in</span>
               </div>
               <div class="form-group label-static is-empty">
                    <input type="submit" name="submit" value="Login" class="btn btn-raised btn-primary">
               </div>
          </form>
     </div>
</div>
