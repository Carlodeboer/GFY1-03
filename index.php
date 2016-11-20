<!DOCTYPE html>
<?php
  include "dbconnect.php";
  include "functions.php";
?>
<html>
    <head>
        <title>Offroad Motorcross Portugal</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <form method="POST" action="login.php">
            Vakantieweek: <input type="text" name="vakantieweek">
            Vakantienaam: <input type="text" name="vakantienaam">
            <input type="submit" name="verzenden" value="Reisinfo">
        </form>
        <h1>Offroad Motorcross Portugal</h1>

        <?php
            toon($pdo);
        ?>
    </body>
</html>
</html>
