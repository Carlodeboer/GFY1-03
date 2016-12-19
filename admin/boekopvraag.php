<html>
<head>
  <title>Boekingopvraag</title>
</head>
<body>
  <div id="contentwrapper">
    Laat boekingen zien: <br>
    <?php

    $pdo = newPDO();
    $stmt = $pdo->prepare("SELECT vakantienaam, begindatum, einddatum FROM boeking b JOIN reis r ON b.idKlant=r.idklant");
    $stmt->execute();
    $teller = 0;
    $i = 0;
    $resultaat = array();
    while($userRow = $stmt-> fetch()){
      $resultaat[$i] = array($userRow['vakantienaam'], $userRow['begindatum'], $userRow['einddatum']);
      $i++;
    }

    foreach($resultaat as $oefen){
      print(" <a href=\"http://localhost/GFY1-03/admin/boekopvraagsript.php\">" . $resultaat[$teller][0] . ",  "
      . $resultaat[$teller][1] . ",  " . $resultaat[$teller][2] . "</a>");
      print("</br>");
      $teller++;
    }
    ?>

  </div>
</body>
</html>
