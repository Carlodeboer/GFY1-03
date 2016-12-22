<html>
<head>
  <title></title>
</head>
<body>
  <div id="container">
    <div id="contentwrapper">
      <?php
      print("this is nice <br><br>");

        $pdo = newPDO();
      if (isset($_GET['boekingID'])) {
          $boekingID = $_GET['boekingID'];

          $stmt = $pdo->prepare("SELECT idKlant, begindatum, einddatum, aantalPersonen, vervoerHeen, vervoerTerug, locatie, opmerking, status, betaling
                  FROM boeking
                  WHERE idKlant=?");
          $stmt->execute(array($boekingID));
          $boekingGegevens = $stmt->fetch();
      }

      print($boekingGegevens["idKlant"]);

      ?>
    </div>
  </div>
</body>
</html>
