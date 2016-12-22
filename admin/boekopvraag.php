<html>
<head>
  <title>Boekingopvraag</title>

</head>
<body>
  <div id="container">

    <div id="contentwrapper">
      <br><h2>Laat boekingen zien: </h2> <br>
      <?php

      $pdo = newPDO();
      $stmt = $pdo->prepare("SELECT idKlant, gebruikersnaam, begindatum, einddatum FROM boeking JOIN gebruikers ON idKlant=idGebruiker ORDER BY begindatum");
      $stmt->execute();
      $teller = 0;
      $i = 0;
      $resultaat = array();
      while($userRow = $stmt-> fetch()){
        $resultaat[$i] = array($userRow['idKlant'], $userRow['gebruikersnaam'], $userRow['begindatum'], $userRow['einddatum']);
        $i++;
      }
      ?>
      <div class="row">
        <div class="col-md-6">

          <table class="table table-striped table-hover nieuwsberichtenbewerken">
            <tr><th>BoekingID</th><th>Vakantienaam</th><th>Begindatum</th><th>Einddatum</th></tr>

            <?php
            foreach($resultaat as $oefen){
              print ("<tr onclick=\"location='beheerpaneel.php?beheer=Boekingenopvragen&boekingID={$userRow['idKlant']}'\">"); //hier moet een ID van de boeking in de link komen... maar hoe?
              print("<td>" .
              $resultaat[$teller][0] . "</td><td>" .
              $resultaat[$teller][1] . "</td><td>" .
              $resultaat[$teller][2] . "</td><td>" .
              $resultaat[$teller][3] . "</td>");
              print ("</tr>");


              $teller++;
            }

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

          </table>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
