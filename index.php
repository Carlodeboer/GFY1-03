
<?php
  include "dbconnect.php";
?>

<html>
    <head>
        <title>TODO supply a title</title>
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
          function toon($pdo){
            $stmt = $pdo->prepare("SELECT * FROM klantenbestand");
            $stmt->execute();
            while ($row = $stmt->fetch())
            {
              $voornaam = $row["voornaam"];

              print "<p>".$voornaam."</p><br>";
          }
        }


        toon($pdo);
        ?>

    </body>
</html>
</html>
