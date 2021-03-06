<?php
/*******************************************************************************
 * Copyright (c) 2017 Carlo de Boer, Floris de Grip, Thijs Marschalk,
 * Ralphine de Roo, Sophie Roos and Ian Vredenburg
 *
 * This Source Code Form is subject to the terms of the MIT license.
 * If a copy of the MIT license was not distributed with this file. You can
 * obtain one at https://opensource.org/licenses/MIT
 *******************************************************************************/
?>
<!DOCTYPE html>
<html>
<head>
</head>
<!-- popup weergeven -->
<script>
function popup() {
  $("#123").snackbar("show");
}

</script>
<body>

  <br><br>
  <div id="contentwrapper">
    <div class="container">
    <!-- Gebruik van row om meerdere items naast elkaar te zetten, col-md-* geeft de breedte van een item weer. -->
      <div class="row">
        <form style="float:right;" method="post" action="beheerpaneel.php?beheer=Nieuwsbewerken">
          <input type="submit" name="nieuwsbewerken" value="Artikelen bewerken" class="btn btn-raised btn-primary">
        </form>

        <div class="col-md-8">
        <!-- Inputvelden voor nieuw nieuwsbericht -->
          <h3>Nieuw nieuwsbericht toevoegen</h3><br>
          <form method="post" action="beheerpaneel.php?beheer=Nieuws">
            <div class="form-group">
              <label for="inputtitel" class="col-md-2 control-label">Titel</label>

              <div class="col-md-10">
                <input type="text" name="titel" class="form-control" id="inputtitel" placeholder="Titel">
              </div>
            </div><br><br>

            <div class="form-group">
              <label for="select111" class="col-md-2 control-label">Taal</label>

              <div class="col-md-10">
              <!-- Taalselectie -->
                <select name="lang" id="select111" class="form-control">
                  <option value="NLD">Nederlands</option>
                  <option value="ENG">Engels</option>
                  <option value="DEU">Duits</option>
                </select>
              </div>
            </div> <br><br>

            ​    <div class="form-group is-empty">
              <label for="textArea" class="col-md-2 control-label">Bericht</label>

              <div class="col-md-10">
                <textarea class="form-control" rows="5" name="bodytext" id="textArea"></textarea>
                <span class="help-block">Vul hier een bericht in</span>
              </div>
            </div><br><br><br><br>
            <br><br><br><br>


            <input type="submit" name="plaatsnieuws" value="Plaatsen" class="btn btn-raised btn-primary">
            <input type="reset" value="Annuleren" class="btn btn-raised btn-primary">
          </form>

          <br><br>




          <?php
          $pdo = newPDO();

          date_default_timezone_set('Europe/Amsterdam');
          $date = date('d F Y H:i', time());

// De volgende code wordt uitgevoerd wanneer er op submit gedrukt wordt.
          if (isset($_POST['plaatsnieuws'])) {
            $titel = $_POST['titel'];
            $lang = $_POST['lang'];
            $bodytext = $_POST['bodytext'];
            ?>
            <!-- popup met feedback aan beheerder weergeven -->
            <span data-toggle=snackbar id="123" data-content="Het artikel <?php print($titel); ?> is toegevoegd."></span>
            <?php
            if ($titel == "") {
              print("Voer een titel in.");
            } elseif ($bodytext == "") {
              print("Voer een bericht in.");
            } else {
              // Gegevens toevoegen aan database
              $stmt = $pdo->prepare("INSERT INTO nieuwsbericht (lang,title,bodytext,posted) VALUES (?,?,?,?)");
              $stmt->execute(array($lang, $titel, $bodytext, $date));
              $userRow = $stmt->fetch(PDO::FETCH_ASSOC);
              $res = $stmt->rowCount();
              if ($res > 0) {
                //feedback aan gebruiker geven
                print("Het bericht " . $titel . " is toegevoegd.");
                print("<script>window.onload = popup;</script>");
                // $userRow=$stmt->fetch(PDO::FETCH_ASSOC);
              }
            }
          }
          ?>


        </div>
      </div>
    </div>
  </div>
</div>
</body>
</html>
