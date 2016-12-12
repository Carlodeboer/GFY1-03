<!DOCTYPE html>
<html>
<head>
           <!-- core CSS of SnackbarJS, find it in /dist -->
    <!-- <link href=dist/snackbar.min.css rel=stylesheet> -->
    <!-- the default theme of SnackbarJS, find it in /themes-css -->
<!--     <link href=dist/material.css rel=stylesheet> -->
</head>
    <body>
    <!-- <script src=dist/snackbar.min.js></script> -->

<br><br>
<div id="contentwrapper">
<div class="container">
<div class="row">
<div class="col-md-8">
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

<form method="post" action="beheerpaneel.php?beheer=Nieuwsbewerken">
<input type="submit" name="nieuwsbewerken" value="Artikelen bewerken" class="btn btn-raised btn-primary">
</form>


<script>
function popup() { 
 $("#123").snackbar("show");
 }

</script>



<?php
        include "../dbconnect.php";
        // include "../functions.php";

        date_default_timezone_set('Europe/Amsterdam');
$date = date('m/d/Y h:i:s a', time());


if (isset($_POST['plaatsnieuws'])) {
    $titel = $_POST['titel'];
    $lang = $_POST['lang'];
    $bodytext = $_POST['bodytext'];

?>
<span data-toggle=snackbar id="123" data-content="Het artikel <?php print($titel); ?> is toegevoegd."></span>
<?php
 
    if ($titel == "") {
        print("Voer een titel in.");
    } elseif ($bodytext == "") {
        print("Voer een bericht in.");
    } else {

        $stmt = $pdo->prepare("INSERT INTO nieuwsbericht (lang,title,bodytext,posted) VALUES (?,?,?,?)");
        $stmt->execute(array($lang, $titel, $bodytext,$date));
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
