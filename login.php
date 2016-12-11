<!DOCTYPE html>
<html>
<?php
include "dbconnect.php"
?>
<head>
     <title>Motorcross</title>
     <?php include 'head.php';?>
</head>
<body>
     <div id="container">
          <?php include 'header.php';?>
          <div id="content">
               <div id="contentwrapper">
                    <h2>Reisinformatie opvragen</h2>
                             <form method="POST" action="loginreisinformatie.php">
               <div class="form-group label-floating is-empty">
                <label for="i5i" class="control-label">Vakantienaam*</label>
                <input type="text" name="vakantienaam" class="form-control" id="i5i" required>
                <span class="help-block">Voer een vakantienaam in</span>
              </div>

              <div class="form-group label-floating is-empty">
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

