<!DOCTYPE html>
<html>
<head>
        <!-- <link type="text/css" rel="stylesheet" href="../style/style.css"> -->
</head>
    <body>


<br><br>
<h3>Nieuw nieuwsbericht toevoegen</h3><br>
    <form method="post" action="beheerpaneel.php?beheer=nieuws">
Titel: <input type="text" name="titel"> <br><br>

 Taal:       <select name="lang">
            <option value="NLD">Nederlands</option>
            <option value="ENG">Engels</option>
            <option value="DEU">Duits</option>
        </select> <br><br>
<!-- Bericht: <input type="text" name="bodytext" placeholder="Artikel"><br> -->
​Bericht:<br> <textarea name="bodytext" rows="10" cols="70"></textarea><br><br>
<input type="submit" name="plaatsnieuws" value="Plaatsen" class="btn-main">
<input type="reset" value="Annuleren" class="btn-main">
</form>

<br><br>

<form method="post" action="beheerpaneel.php?beheer=nieuwsbewerken">
<input type="submit" name="nieuwsbewerken" value="Artikelen bewerken" class="btn-main">
</form>



<?php
        include "../dbconnect.php";
        // include "../functions.php";

        date_default_timezone_set('Europe/Amsterdam');
$date = date('m/d/Y h:i:s a', time());


if (isset($_POST['plaatsnieuws'])) {
    $titel = $_POST['titel'];
    $lang = $_POST['lang'];
    $bodytext = $_POST['bodytext'];
 
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
            // $userRow=$stmt->fetch(PDO::FETCH_ASSOC);
        }
    }
}
?>
    </body>
</html>
