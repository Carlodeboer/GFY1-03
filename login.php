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
                    $labels = loginTaal();
                    ?>
                    <h2> <?php print $labels[0]; ?> </h2>
                    <form id="klantlogin" method="POST" action="loginreisinformatie.php">
                         <div class="form-group label-static is-empty">
                              <label for="i5i" class="control-label">Vakantienaam*</label>
                              <input type="text" name="vakantienaam" class="form-control" id="i5i" required>
                              <span class="help-block">Voer een vakantienaam in</span>
                         </div>

                         <div class="form-group label-static is-empty">
                              <label for="i5i" class="control-label">Vakantieweek*</label>
                              <input type="text" name="vakantieweek" class="form-control" id="i5i" required>
                              <span class="help-block">Voer een vakantieweek in</span>
                              <br><br>
                              <input type="submit" name="verzenden" value="Verzenden" class="btn btn-raised btn-primary">
                         </div>
                    </form>
               </div>
          </div>
     </div>
     <?php include 'footer.php';?>
</body>
</html>
