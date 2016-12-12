<?php
    if(!defined('toegang')) {
        function abspath()
        {
            return $_SERVER['HTTP_HOST'];
        }
       header("Location:" .abspath()."/GFY1-03/404.php");
       exit();
    }
?>
<div id="content">
    <div id="contentwrapper">
        <form method="post" action="adminlogin.php">
            <div class="form-group label-floating is-empty">
                <label for="i5i" class="control-label">Gebruikersnaam</label>
                <input type="text" name="naam" class="form-control" id="i5i">
                <span class="help-block">Voer een gebruikersnaam in</span>
             </div>

              <div class="form-group label-floating is-empty">
                  <label for="i5i" class="control-label">Wachtwoord</label>
                  <input type="password" name="wachtwoord" class="form-control" id="i5i">
                  <span class="help-block">Voer een wachtwoord in</span>
                  <br><br>
                  <input type="submit" name="submit" value="Login" class="btn btn-raised btn-primary">
              </div>
          </form>
      </div>
</div>
