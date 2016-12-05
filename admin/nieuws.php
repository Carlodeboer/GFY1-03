<!DOCTYPE html>
<html>
<head>
        <link type="text/css" rel="stylesheet" href="../style/style.css">
</head>
    <body>


<br><br>
    <form method="get" action="beheerpaneel.php?beheer=nieuws">
Titel: <input type="text" name="titel"> <br>

 Taal:       <select name="lang">
            <option value="NLD">Nederlands</option>
            <option value="ENG">Engels</option>
            <option value="DEU">Duits</option>
        </select> <br>
Bericht: <input type="text" name="bodytext" size="30"><br>
<input type="submit" name="plaatsnieuws" value="Plaatsen">
<input type="reset" value="Annuleren">
</form>



<?php
        include "../dbconnect.php";
        // include "../functions.php";

if (isset($_POST['plaatsnieuws'])) {
    $titel = $_POST['titel'];
    $lang = $_POST['lang'];
    $bodytext = $_POST['bodytext'];
 
    if ($titel == "") {
        print("Voer een titel in.");
    } elseif ($bodytext == "") {
        print("Voer een bericht in.");
    } else {

        $stmt = $pdo->prepare("INSERT INTO nieuwsbericht (lang,title,bodytext) VALUES (?,?,?)");
        $stmt->execute(array($lang, $titel, $bodytext));
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
