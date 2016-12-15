<?php define("toegang", true); ?>

<!DOCTYPE html>
<html>
<head>
    <title>Motorcross</title>
    <?php include '../head.php';?>
</head>
    <body>
        <div id="container">
          <?php include '../header.php';?>
          <div id="content">
            <div id="contentwrapper">
              Laat boekingen zien: <br>
              <?php

              $pdo = newPDO();
              $stmt = $pdo->prepare("SELECT begindatum, einddatum FROM boeking");
              $stmt->execute();
              $teller = 0;
              $i = 0;
              $resultaat = array();
              while($userRow = $stmt-> fetch()){
                $resultaat[$i] = array($userRow['begindatum'], $userRow['einddatum']);
                $i++;
              }
              foreach($resultaat as $oefen){


              print(" <a href=\"http://localhost/GFY1-03/admin/boekingopvraagsript.php\">" . $resultaat[$teller][0] . ",  " . $resultaat[$teller][1] . "</a>");
              print("</br>");
              $teller++;

}
                ?>

              </div>
          </div>
          <?php include '../footer.php';?>
        </div>
    </body>
</html>

