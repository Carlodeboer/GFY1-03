<!DOCTYPE html>
<?php
include "functions.php";
?>
<html>
    <head>
        <title>Motocross</title>
        <link type="text/css" rel="stylesheet" href="style.css">
    </head>
    <body>
      <div id="container">
          <nav>
              <div id="banner">
              </div>
              <ul>
                  <a href="index.php"><li>Home</li></a>
                  <a href="informatie.php"><li>Informatie</li></a>
                  <a href="boeken.php"><li>Boeken</li></a>
                  <a href="contact.php"><li>Contact</li></a>
                  <a href="login.php"><li>Login</li></a>
                </nav>
            </div>
        <table>
            <form method="GET" action="boekenscript.php">
                <tr>
                    <td>Begindatum:</td>
                    <td><!--$begindatum--></td>
                </tr><tr>
                    <td>Einddatum:</td>
                    <td><!--$einddatum--></td>
                </tr><tr>
                    <td>Vervoer van Luchthaven Portela (Lissabon):</td>
                    <td><input type="radio" name="heen" value="true" checked> Ja</td>
                </tr><tr>
                    <td></td>
                    <td><input type="radio" name="heen" value="false"> Nee</td>
                </tr>
                <tr><td>Vervoer naar Luchthaven Portela (Lissabon):</td>
                    <td><input type="radio" name="terug" value="true" checked> Ja</td>
                </tr><tr>
                    <td></td>
                    <td><input type="radio" name="terug" value="false"> Nee</td>
                </tr><tr>
                    <td>Locatie van overnachting:</td>
                    <td><input type="radio" name="locatie" value="standaard" checked> Standaard locatie</td>
                </tr><tr>
                    <td></td>
                    <td><input type="radio" name="locatie" value="anders"> Anders, namelijk: <input type="text" name="nieuweLocatie"></td>
                </tr><tr>
                    <td>Aantal personen:</td>
                    <td><select name="aantalPersonen"><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option></select></td>
                </tr><tr>
                    <td>Opmerkingen:</td>
                    <td><textarea name="opmerkingen" rows="4" cols="60"></textarea>
                </tr><tr>
                    <td><input type="submit" name="verzenden" value="Verzenden"></td>
                </tr>
            </form>
        </table>

</body>
</html>
