@@ -1,3 +1,4 @@
@@ -1,12 +1,4 @@
<?php
  include "dbconnect.php";
?>
@@ -10,24 +11,25 @@ and open the template in the editor.
<html>
    <head>
        <title>TODO supply a title</title>
        <meta charset="UTF-8">
@@ -14,7 +6,13 @@ and open the template in the editor.
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <form method="POST" action="login.php"> 
            Vakantieweek: <input type="text" name="vakantieweek">
            Vakantienaam: <input type="text" name="vakantienaam">
            <input type="submit" name="verzenden" value="Reisinfo">
        </form>
        <h1>Offroad Motorcross Portugal</h1>
<<<<<<< HEAD
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
@@ -29,5 +27,7 @@ and open the template in the editor.

        toon($pdo);
        ?>
=======
>>>>>>> origin/master
    </body>
</html>
</html>
\ No newline at end of file