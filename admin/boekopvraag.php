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
               ?>

               <div class="row">
                    <div class="col-md-6">
                         <table class="table table-striped table-hover nieuwsberichtenbewerken">
                              <tr><th>BoekingID</th><th>Vakantienaam</th><th>Begindatum</th><th>Einddatum</th></tr>

                              <?php
                              while ($boeking = $stmt->fetch()) {
                                   echo "<tr onclick=\"location='beheerpaneel.php?beheer=Boekingenopvragen&boekingID={$boeking['idKlant']}'\">

                                   <td>" . $boeking['idKlant'] . "</td>
                                   <td>" . $boeking['gebruikersnaam'] . "</td>
                                   <td>" . $boeking['begindatum'] . "</td>
                                   <td>" . $boeking['einddatum'] . "</td>

                                   </tr>";
                              }

                              if (isset($_GET['boekingID'])) {
                                   $boekingID = $_GET['boekingID'];

                                   $stmt = $pdo->prepare("SELECT idKlant, begindatum, einddatum, aantalPersonen, vervoerHeen, vervoerTerug, locatie, opmerking, status, betaling
                                   FROM boeking
                                   WHERE idKlant=?");
                                   $stmt->execute(array($boekingID));
                                   $boekingGegevens = $stmt->fetch();
                              }
                              ?>

                         </table>
                    </div>
               </div>
          </div>
     </div>
</body>
</html>
