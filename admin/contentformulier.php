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
     <h2>Pagina bewerken</h2>
     <form method="POST" action="beheerpaneel.php?beheer=Content">
          <div class="form-group label-static is-empty">
               <label for="inputtitel" class="control-label">Titel</label>
               <input type="text" name="titel" value =<?php print "\"".$content[0]."\""; ?> class="form-control" id="inputtitel">
          </div>
          <div class="form-group label-static is-empty">
               <label for="textArea" class="control-label">Inhoud</label>
               <textarea class="form-control" rows="10" name="inhoud" id="textArea"><?php print $content[1]; ?></textarea>
          </div>
          <input type="submit" name="verzenden" value="Bewerken" class="btn btn-raised btn-primary">
     </form>
     <form method="POST" action=<?php print("\"http://".$_SERVER['HTTP_HOST']."/GFY1-03/admin/beheerpaneel.php?beheer=Content\"");?>>
          <input type="submit" name="terug" value="Terug" class="btn btn-raised btn-primary">
     </form>
</div>
