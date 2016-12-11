<!DOCTYPE html>
<html>
<head>
        <!-- <link type="text/css" rel="stylesheet" href="../style/style.css"> -->
</head>
    <body>


<br><br>
<h3>Nieuwsberichten bewerken</h3><br>
<?php

    include"../dbconnect.php";
    $stmt = $pdo->prepare("SELECT id,lang,title,description,bodytext,posted
                            FROM nieuwsbericht");
    $stmt->execute();
?>
<br><br><br>


<div class="container">
<div class="row">
<div class="col-md-8">

<table class="table table-striped table-hover">
<th>ID</th><th>Taal</th><th>Titel</th><th>Omschrijving</th><th>Datum</th>

<?php
    while($content = $stmt->fetch()) {
echo "<tr onclick=\"location='beheerpaneel.php?beheer=Nieuwsbewerken&berichtId={$content['id']}'\">

<td>" . $content['id'] . "</td>
<td>" . $content['lang'] . "</td>
<td>" . $content['title'] . "</td>
<td>" . $content['description'] ."</td>
<td>"  . $content['posted'] . "</td>

</tr>";
}
?>

</table>

<br>
<form method="post" action="beheerpaneel.php?beheer=Nieuws">
<input type="submit" value="Terug" name="terug" class="btn btn-raised btn-primary">
</form>
</div>



<div class="col-md-4">


<?php

if(isset($_GET['berichtId'])) {
    $berichtId = $_GET['berichtId'];

        $stmt = $pdo->prepare("SELECT id,lang,title,description,bodytext,posted
                            FROM nieuwsbericht
                            WHERE id=?");
            $stmt->execute(array($berichtId));
            $content=$stmt->fetch();

}

$taal = 0;

switch($content['lang']) {
    case "NLD":
    $taal = "Nederlands";
    break;
    case "ENG":
    $taal = "Engels";
    break;
    case "DEU":
    $taal = "Duits";
    break;
} 

?>

<!--     <div class="form-group">
      <label for="inputtitel" class="col-md-2 control-label">Titel</label>
      <div class="col-md-10">
        <input type="text" class="form-control" id="inputtitel" value="<?php print($content['title']);?>">
      </div>   

      <div class="form-group">
      <label for="inputomschrijving" class="col-md-2 control-label">Omschrijving</label>
      <div class="col-md-10">
        <input type="text" class="form-control" id="inputomschrijving" value="<?php print($content['description']);?>">
      </div>

          <div class="form-group">
      <label for="inputdatum" class="col-md-2 control-label">Datum</label>
      <div class="col-md-10">
        <input type="text" class="form-control" id="inputdatum" value="<?php print($content['posted']);?>">
      </div>



              </div> -->
              <!-- </form> -->

    <form method="post">
Titel: <input type="text" name="titel" value="<?php print($content['title']);?>"> <br><br>
Omschrijving: <input type="text" name="omschrijving" value="<?php print($content['description']);?>"> <br><br>

Datum: <input type="text" name="datum" value="<?php print($content['posted']);?>"> <br><br>

 Taal:       <select name="lang">
            <option selected="<?php print($content['lang'])?>" value="<?php print($content['lang'])?>"><?php print($taal);?></option>
            <option value="NLD">Nederlands</option>
            <option value="ENG">Engels</option>
            <option value="DEU">Duits</option>
        </select> <br><br>
<!-- Bericht: <input type="text" name="bodytext" placeholder="Artikel"><br> -->
​Bericht:<br> <textarea name="bodytext" rows="10" cols="70" ><?php print($content['bodytext']);?></textarea><br><br>
<input type="submit" name="updaten" value="Updaten" class="btn btn-raised btn-primary">
<input type="submit" name="verwijderen" value="###VERWIJDEREN NOG MAKEN###" class="btn-main">
</form>

<br><br>




</div>
</div>
</div>

<?php




if (isset($_POST['updaten'])) {
    $titel = $_POST['titel'];
    $lang = $_POST['lang'];
    $omschrijving = $_POST['omschrijving'];
    $posted = $_POST['datum'];
    $bodytext = $_POST['bodytext'];
        $berichtId = $_GET['berichtId'];
 
    if ($titel == "") {
        print("Voer een titel in.");
    } elseif ($bodytext == "") {
        print("Voer een bericht in.");
    } else {


    $pdo = newPDO();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $pdo->prepare("UPDATE nieuwsbericht SET lang=?, title=?, description=?, bodytext=?, posted=? WHERE id=?");
                    try
    { 
        $stmt->execute(array($lang, $titel, $omschrijving, $bodytext, $posted, $berichtId));
    }
        catch (PDOException $e)
    {
        echo "Er is iets fout gegaan";
        throw $e;
    }

$res = $stmt->rowCount();
        if ($res > 0) {
            //feedback aan gebruiker geven
            print("Het bericht " . $titel . " is bijgewerkt.");
        }
        // echo "<meta http-equiv='refresh' content='0'>";

        // $userRow = $stmt->fetch(PDO::FETCH_ASSOC);
        // $res = $stmt->rowCount();
        // if ($res > 0) {
        //     //feedback aan gebruiker geven
        //     print("Het bericht " . $titel . " is bijgewerkt.");
            // $userRow=$stmt->fetch(PDO::FETCH_ASSOC);
        }
    
}




?>
    </body>
</html>
