<!DOCTYPE html>
<!--[Naam: Ian Vredenburg Studentnummer: 1062460]-->
<html>
    <head>
        <meta charset="utf-8">
        <title>Opgave 8</title>
    </head>
    <body>
        <?php
        /* Gebruik onderstaande variabelen in de uitwerking */
        $prijs = 10;

        /* Begin uitwerking */
        $punten = 100;
        
        print("U betaalt ".$prijs." euro of:<br>");
        while ($prijs >= 5){
          print(($prijs - 5)." euro + ".$punten." punten<br>");
          $punten += 100;
          $prijs -= 5;
        }

        /* Einde uitwerking */
        ?>
    </body>
</html>
