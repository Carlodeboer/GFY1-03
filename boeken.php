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
                    <h2>Boeken</h2>
                    <form method="POST" action="boekengegevens.php" class="form-horizontal">
                         <div class="form-group label-static is-empty">
                              <label for="i5i" class="control-label">Begindatum*</label>
                              <input type="date" name="begindatum" class="form-control" id="i5i" required>
                              <span class="help-block">Voer een begindatum in</span>
                         </div>
                         <div class="form-group label-static is-empty">
                              <label for="i5i" class="control-label">Einddatum*</label>
                              <input type="date" name="einddatum" class="form-control" id="i5i" required>
                              <span class="help-block">Voer een einddatum in</span>
                         </div>
                         <div class="form-group label-static is-empty">
                              <label for="i5i" class="control-label">Aantal personen*</label>
                              <select id="s1" class="form-control">
                                   <option value="1">1</option>
                                   <option value="2">2</option>
                                   <option value="3">3</option>
                                   <option value="4">4</option>
                              </select>
                         </div>
                         <div class="form-group label-static is-empty">
                              <label for="i5i" class="control-label">Vervoer van Luchthaven Portela (Lissabon)*</label>
                              <div class="radio">
                                   <label>
                                        <input type="radio" name="vervoerHeen" value="1" checked> Ja
                                   </label>
                              </div>
                              <div class="radio">
                                   <label>
                                        <input type="radio" name="vervoerHeen" value="0" checked> Nee
                                   </label>
                              </div>
                         </div>
                         <div class="form-group label-static is-empty">
                              <label for="i5i" class="control-label">Vervoer naar Luchthaven Portela (Lissabon)*</label>
                              <div class="radio">
                                   <label>
                                        <input type="radio" name="vervoerTerug" value="1" checked> Ja
                                   </label>
                              </div>
                              <div class="radio">
                                   <label>
                                        <input type="radio" name="vervoerTerug" value="0"> Nee
                                   </label>
                              </div>
                         </div>
                         <div class="form-group label-static is-empty">
                              <label for="i5i" class="control-label">Locatie van overnachting*</label>
                              <div class="radio">
                                   <label>
                                        <input type="radio" name="locatie" value="standaard" checked=""> Standaard locatie
                                   </label>
                              </div>
                              <div class="radio">
                                   <label>
                                        <input type="radio" name="vervoerTerug" value="0"> Anders, namelijk:
                                        <input type="text" name="nieuweLocatie" class="form-control">
                                   </label>
                              </div>
                         </div>
                         <div class="form-group label-static is-empty">
                              <label for="i5i" class="control-label">Opmerkingen</label>
                              <textarea name="opmerkingen" class="form-control"></textarea>
                         </div>
                         <div class="form-group label-static is-empty">
                              <label for="i5i" class="control-label">Vakantienaam*</label>
                              <input type="text" name="vakantienaam" class="form-control" id="i5i" required>
                              <span class="help-block">Deze naam gebruikt u later uw reisgegevens in te zien. Deze gegevens zou u ook eventueel kunnen delen met reisgenoten.</span>
                         </div>
                         <div class="form-group label-static is-empty">
                              <input type="submit" name="volgende" value="Volgende" class="btn btn-raised btn-primary">
                         </div>
                    </form>
               </div>
          </div>
          <?php include 'footer.php'; ?>
     </div>

     <script>
  $.material.init();
</script>
</body>
</html>
