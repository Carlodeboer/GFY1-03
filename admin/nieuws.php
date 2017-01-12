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
     <div id="contentwrapper">
          <h2>Nieuw nieuwsbericht toevoegen</h2>
          <div class="container">
               <!-- Gebruik van row om meerdere items naast elkaar te zetten, col-md-* geeft de breedte van een item weer. -->
               <div class="row">
                    <form style="float:right;" method="post" action="beheerpaneel.php?beheer=Nieuwsbewerken">
                         <input type="submit" name="nieuwsbewerken" value="Artikelen bewerken" class="btn btn-raised btn-primary">
                    </form>
                    <div class="col-md-8">
                         <!-- Inputvelden voor nieuw nieuwsbericht -->
                         <form method="POST" action="beheerpaneel.php?beheer=Nieuws" class="form-horizontal">
                              <div class="form-group label-static is-empty">

                                   <label for="i5i" class="control-label">Titel</label>
                                   <input for="i5i" type="text" name="titel" class="form-control" id="i5i">
                                   <span class="help-block">Voer hier de titel in</span>
                              </div>
                              <div class="form-group label-static is-empty">
                                   <label for="i5i" class="control-label">Taal</label>
                                   <!-- Taalselectie -->
                                   <select name="lang" id="select111" class="form-control">
                                        <option value="NLD">Nederlands</option>
                                        <option value="ENG">Engels</option>
                                        <option value="DEU">Duits</option>
                                   </select>
                              </div>
                              <div class="form-group label-static is-empty">
                                   <label for="i5i" class="control-label">Bericht</label>
                                   <textarea class="form-control" rows="5" name="bodytext" id="textArea"></textarea>
                                   <span class="help-block">Voer hier een bericht in</span>
                              </div>
                              <br>
                              <input type="submit" name="plaatsnieuws" value="Plaatsen" class="btn btn-raised btn-primary">
                              <input type="reset" value="Annuleren" class="btn btn-raised btn-primary">
                         </form>

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

                              <?php
                              if ($titel == "") {
                                   ?><span data-toggle=snackbar id="123" data-content="Voer een titel in."></span><?php
                                   print("<script>window.onload = popup;</script>");
                              } elseif ($bodytext == "") {
                                   ?><span data-toggle=snackbar id="123" data-content="Voer een bericht in."></span><?php
                                   print("<script>window.onload = popup;</script>");
                              } else {
                                   // Gegevens toevoegen aan database
                                   $stmt = $pdo->prepare("INSERT INTO nieuwsbericht (lang,title,bodytext,posted) VALUES (?,?,?,?)");
                                   $stmt->execute(array($lang, $titel, $bodytext, $date));
                                   $userRow = $stmt->fetch(PDO::FETCH_ASSOC);
                                   $res = $stmt->rowCount();
                                   if ($res > 0) {
                                        //feedback aan gebruiker geven
                                        ?><span data-toggle=snackbar id="123" data-content="Het artikel <?php print($titel); ?> is toegevoegd."></span><?php
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
</body>
</html>
