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
    $stmt = $pdo->prepare("SELECT id,lang,title,bodytext,posted
                            FROM nieuwsbericht");
    $stmt->execute();
?>
<br><br><br>
<div id="nieuwslinks">
<div id="nieuwsbewerken">
<table>
<th>ID</th><th>Taal</th><th>Titel</th><th>Bericht</th><th>Datum</th>

<?php
    while($content = $stmt->fetch()) {
echo "<tr onclick=\"location='beheerpaneel.php?beheer=nieuwsbewerken&berichtId={$content['id']}'\"><td>" . $content['id'] . "</td><td>" . $content['lang'] . "</td><td>" . $content['title'] . "</td><td>" . $content['bodytext']. "</td><td>" . $content['posted'] . "</td></tr> ";
}
?>

</table>
</div>
<br>
<form method="post" action="beheerpaneel.php?beheer=nieuws">
<input type="submit" value="Terug" name="terug" class="btn-main">
</form>
</div>


<div id="nieuwsrechts">

<?php

if(isset($_GET['berichtId'])) {
    $berichtId = $_GET['berichtId'];

        $stmt = $pdo->prepare("SELECT id,lang,title,bodytext,posted
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



    <form method="post">
Titel: <input type="text" name="titel" value="<?php print($content['title']);?>"> <br><br>
Datum: <input type="text" name="datum" value="<?php print($content['posted']);?>"> <br><br>

 Taal:       <select name="lang">
            <!-- <option selected="<?php print($content['lang'])?>" disabled hidden><?php print($taal);?></option> -->
            <option value="NLD">Nederlands</option>
            <option value="ENG">Engels</option>
            <option value="DEU">Duits</option>
        </select> <br><br>
<!-- Bericht: <input type="text" name="bodytext" placeholder="Artikel"><br> -->
​Bericht:<br> <textarea name="bodytext" rows="10" cols="70" ><?php print($content['bodytext']);?></textarea><br><br>
<input type="submit" name="updaten" value="Updaten" class="btn-main">
</form>

<br><br>

</div>

<?php




if (isset($_POST['updaten'])) {
    $titel = $_POST['titel'];
    $lang = $_POST['lang'];
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
        $stmt = $pdo->prepare("UPDATE nieuwsbericht SET lang=?, title=?, bodytext=?, posted=? WHERE id=?");
                    try
    { 
        $stmt->execute(array($lang, $titel, $bodytext, $posted, $berichtId));
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
