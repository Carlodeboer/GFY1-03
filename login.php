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
                <h2> Login </h2>
                <div class="loginmenu">
                <form method="POST" action="reisinformatie.php">
                    Vakantieweek: <input type="text" name="vakantiejaar"><br><br>
                    Vakantienaam: <input type="text" name="vakantienaam"><br><br>
                    <input type="submit" name="verzenden" value="Reisinformatie ophalen" class="btn-main">
                </form>
              </div>
              </div>
            </div>
            <?php include 'footer.php';?>
        </div>
    </body>
