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
                <h2> Login </h2>
                <form method="POST" action="reisinformatie.php">
                    Vakantieweek: <input type="text" name="vakantiejaar"><br><br>
                    Vakantienaam: <input type="text" name="vakantienaam"><br>
                    <input type="submit" name="verzenden" value="Reisinfo">
                </form>
                
            </div>
            <?php include 'footer.php';?>
        </div>
    </body>
