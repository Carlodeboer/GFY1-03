<html>
<head>
  <title>Boekingopvraag</title>

</head>
<body>
  <div id="container">

    <div id="contentwrapper">
      Laat boekingen zien: <br>
      <?php

      $pdo = newPDO();
      $stmt = $pdo->prepare("SELECT vakantienaam, begindatum, einddatum FROM boeking b JOIN reis r ON b.idKlant=r.idklant ORDER BY begindatum ");
      $stmt->execute();
      $teller = 0;
      $i = 0;
      $resultaat = array();
      while($userRow = $stmt-> fetch()){
        $resultaat[$i] = array($userRow['vakantienaam'], $userRow['begindatum'], $userRow['einddatum']);
        $i++;
      }
      ?>
      <div class="row">
        <div class="col-md-6">

          <table class="table table-striped table-hover nieuwsberichtenbewerken">
            <th>Vakantienaam</th><th>Begindatum</th><th>Einddatum</th>

            <?php
            foreach($resultaat as $oefen){
              print ("<a href='http://localhost/GFY1-03/admin/boekopvraagsript.php'><tr>");
              print(" <td> " .
              $resultaat[$teller][0] . "</td><td>"
              . $resultaat[$teller][1] . "</td><td>" .
              $resultaat[$teller][2] . "</a></td>");
              print ("</tr></a>");

              $teller++;
            }
            ?>

          </table>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
