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
<?php define("toegang", true); ?>
<!DOCTYPE html>
<html>

<head>
     <title>Login</title>
     <?php include 'head.php';?>
</head>
<body>
     <div id="container">
          <?php include 'header.php';?>
          <div id="content">
               <div id="contentwrapper">
                    <?php
                    $j = 0;
                    $labels = loginTaal();
                    ?>
                    <h2><?php print($labels[$j]); $j++; ?></h2>
                    <form id="klantlogin" method="POST" action="loginreisinformatie.php">
                         <div class="form-group label-static is-empty">
                              <label for="i5i" class="control-label"><?php print($labels[$j]); $j++; ?>*</label>
                              <input type="text" name="vakantienaam" class="form-control" id="i5i" required>
                              <span class="help-block"><?php print($labels[$j]); $j++; ?></span>
                         </div>

                         <div class="form-group label-static is-empty">
                              <label for="i5i" class="control-label"><?php print($labels[$j]); $j++; ?>*</label>
                              <input type="text" name="vakantieweek" class="form-control" id="i5i" required>
                              <span class="help-block"><?php print($labels[$j]); $j++; ?></span>
                              <br><br>
                              <input type="submit" name="verzenden" value="<?php print($labels[$j]); $j++; ?>" class="btn btn-raised btn-primary">
                         </div>
                    </form>
               </div>
          </div>
     </div>
     <?php include 'footer.php';?>
</body>
</html>
