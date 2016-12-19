  <div id="contentwrapper">
              Laat boekingen zien: <br>
              <?php

              $pdo = newPDO();
              $stmt = $pdo->prepare("SELECT idKlant, begindatum FROM boeking");
              $stmt->execute();
              $teller = 0;
              $i = 0;
              $resultaat = array();
              while($userRow = $stmt-> fetch()){
                $resultaat[$i] = array($userRow['idKlant'], $userRow['begindatum']);
                $i++;
              }
              foreach($resultaat as $oefen){


              print(" <a href=\"http://localhost/GFY1-03/admin/boekingopvraagsript.php\">" . $resultaat[$teller][0] . ",  " . $resultaat[$teller][1] . "</a>");
              print("</br>");
              $teller++;

}
                ?>

              </div>
