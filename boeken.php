<?php define("toegang", true); ?>
<!DOCTYPE html>
<html>
<head>
     <title>Boeken</title>
     <?php include 'head.php'; ?>
</head>
<body>
     <div id="container">
          <?php include 'header.php'; ?>
          <div id="content">
               <div id="contentwrapper">
                    <h2> Boeken </h2>

                    <form method="POST" action="boekengegevens.php">
                         <div class="form-group label-floating is-empty">
                              <label for="i5i" class="control-label">Begindatum*</label>
                              <input type="date" name="begindatum" class="form-control" id="i5i" required>
                              <span class="help-block">Voer een begindatum in</span>
                         </div>
                         <div class="form-group label-floating is-empty">
                              <label for="i5i" class="control-label">Einddatum*</label>
                              <input type="date" name="einddatum" class="form-control" id="i5i" required>
                              <span class="help-block">Voer een einddatum in</span>
                         </div>
                         <div class="form-group label-floating is-empty">
                              <label for="i5i" class="control-label">Aantal personen*</label>
                              <select name="aantalPersonen" required class="form-control" id="i5i"><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option></select>
                              <span class="help-block">Voer een aantal in</span>
                         </div>
                         <div class="form-group label-floating is-empty">
                              <label for="i5i" class="control-label">Vervoer van Luchthaven Portela (Lissabon)*</label>
                              <input type="radio" name="vervoerHeen" value="1" checked class="form-control" id="i5i"> Ja
                              <input type="radio" name="vervoerHeen" value="0" class="form-control" id="i5i"> Nee
                              <span class="help-block">Voer een antwoord in</span>
                         </div>
                         <div class="form-group label-floating is-empty">
                              <label for="i5i" class="control-label">Vervoer naar Luchthaven Portela (Lissabon)*</label>
                              <input type="radio" name="vervoerTerug" value="1" checked class="form-control" id="i5i"> Ja
                              <input type="radio" name="vervoerTerug" value="0" class="form-control" id="i5i"> Nee
                              <span class="help-block">Voer een antwoord in</span>
                         </div>
                         <div class="form-group label-floating is-empty">
                              <label for="i5i" class="control-label">Locatie van overnachting*</label>
                              <input type="radio" name="locatie" value="standaard" checked class="form-control" id="i5i"> Standaard locatie
                              <input type="radio" name="locatie" value="anders" class="form-control" id="i5i"> Anders, namelijk: <input type="text" name="nieuweLocatie" class="form-control" id="i5i">
                              <span class="help-block">Voer een antwoord in</span>
                         </div>
                         <div class="form-group label-floating is-empty">
                              <label for="i5i" class="control-label">Opmerkingen</label>
                              <textarea name="opmerkingen" rows="4" cols="60" class="form-control" id="i5i"></textarea>
                              <span class="help-block">Eventuele opmerkingen</span>
                         </div>
                         <div class="form-group label-floating is-empty">
                              <label for="i5i" class="control-label">Vakantienaam*</label>
                              <input type="text" name="vakantienaam" class="form-control" id="i5i" required>
                              <span class="help-block">Deze naam gebruikt u later uw reisgegevens in te zien. Deze gegevens zou u ook eventueel kunnen delen met reisgenoten.</span>
                              <br><br>
                              <input type="submit" name="volgende" value="Volgende" class="btn btn-raised btn-primary">
                         </div>
                    </form>
               </div>
          </div>
          <?php include 'footer.php'; ?>
     </div>
</body>
</html>
