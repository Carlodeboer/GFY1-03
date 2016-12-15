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
              while($row = $stmt->fetch()){

                $datum[$i]=$row;
                $i++;
              }
              print_r($datum);

              // foreach($datum as $data){
              // echo " $datum[$teller]   -  $datum[$teller2]";
              // $teller = $teller + 2;
              // $teller2 = $teller2 + 2;
              // }

              ?>
              </div>
          </div>
          <?php include 'footer.php';?>
        </div>
    </body>
</html>
