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
      $stmt = $pdo->prepare("SELECT gebruikersnaam, begindatum, einddatum FROM boeking b JOIN gebruikers g ON idKlant=idGebruiker ORDER BY begindatum");
      $stmt->execute();
      $teller = 0;
      $i = 0;
      $resultaat = array();
      while($userRow = $stmt-> fetch()){
        $resultaat[$i] = array($userRow['gebruikersnaam'], $userRow['begindatum'], $userRow['einddatum']);
        $i++;
      }
      ?>
      <div class="row">
        <div class="col-md-6">

          <table class="table table-striped table-hover ">
            <tr><th>Vakantienaam</th><th>Begindatum</th><th>Einddatum</th></tr>

            <?php
            foreach($resultaat as $oefen){
              print ("<tr onclick=\"location='beheerpaneel.php?beheer=Reizen&berichtId={$userRow['gebruikersnaam']}'\">"); //hier moet een ID van de boeking in de link komen... maar hoe?
              print("<a href=\"http://localhost/GFY1-03/admin/boekopvraagscript.php\"> <td>" .
              $resultaat[$teller][0] . "</td><td>" .
              $resultaat[$teller][1] . "</td><td>" .
              $resultaat[$teller][2] . "</a></td>");
              print ("</tr>");
              print ("<br>");

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
