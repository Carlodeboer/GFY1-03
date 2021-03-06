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
<div id="contentwrapper">
     <?php
     $pdo = newPDO();
     if(isset($_POST["wijzigen"])) {
          $stmt1 = $pdo->prepare("UPDATE instellingen SET waarde = ? WHERE instelling = 'aantalMotoren';");
          $stmt1->execute(array($_POST["aantalMotoren"]));
     }
     $stmt2 = $pdo->prepare("SELECT waarde FROM instellingen WHERE instelling = 'aantalMotoren';");
     $stmt2->execute(array());
     $row2 = $stmt2->fetch();
     $aantalMotoren = $row2["waarde"];
     ?>
     <form method="POST" action="beheerpaneel.php?beheer=Instellingen">
          <div class="form-group">
               <label class="control-label label-static is-empty">Aantal motoren</label>
               <input type="number" name="aantalMotoren" value="<?php print($aantalMotoren);?>" required="" class="form-control">
          </div>
          <input class="btn btn-raised btn-primary" type="submit" value="Wijzigen" name="wijzigen">
     </form>
</div>
