<?php define("toegang", true); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Motorcross</title>
    <?php include 'head.php';?>
</head>
    <body>
        <div id="container">
          <?php include 'header.php';?>
          <div id="content">
            <div id="contentwrapper">
              Laat boekingen zien: <br>
              <?php

              $pdo = newPDO();
              $stmt = $pdo->prepare("SELECT begindatum, einddatum FROM boeking");
              $stmt->execute();
              $teller = 0;
              $teller2 = 1;
              $i = 0;
              $resultaat = array();
              while($userRow = $stmt-> fetch()){
                $resultaat[$i] = array($userRow['begindatum'], $userRow['einddatum']);
                $i++;
              }
              print($resultaat[0][0] . "<br>");

              print($resultaat[0][1]);

                ?>
              </div>
          </div>
          <?php include 'footer.php';?>
        </div>
    </body>
</html>
