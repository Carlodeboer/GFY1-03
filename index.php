<?php
  include "dbconnect.php";
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>TODO supply a title</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <h1>Offroad Motorcross Portugal</h1>
        <?php
          function toon($pdo){
            $stmt = $pdo->prepare("SELECT * FROM klantenbestand");
            $stmt->execute();
            while ($row = $stmt->fetch())
            {
              $weeknummer = $row["weeknummer"];

              print "<p>".$weeknummer."</p><br>";
          }
        }

        toon($pdo);
        ?>
    </body>
</html>
