<?php

// gelieve hier alle functies te plaatsen ;)
function newPDO() {
    $db = "mysql:host=carlodb.nl;dbname=carlodb_database;port=3306";
    $user = "carlodb_school";
    $pass = "GFY1-03";
    $pdo = new PDO($db, $user, $pass);
    return ($pdo);
}

function selecteerTaal(){
    if (isset($_GET['lang'])){
        $_SESSION['lang'] = $_GET['lang'];
        $taal = $_SESSION['lang'];
    } elseif (isset($_SESSION['lang'])){
        $taal = $_SESSION['lang'];
    } else {
        $taal = "NLD";
    }
    return $taal;
}

function laadContent($bestandsnaam, $taal){
    if ($bestandsnaam == ""){
        $bestandsnaam = $_SERVER['PHP_SELF'];
        $verwijder = ["GFY1-03", "/", ".php"];
        $pagina = str_replace($verwijder, "", $bestandsnaam);
    } else {
        $pagina = $bestandsnaam;
    }
    if ($taal == ""){
        $taal = selecteerTaal();
    }
    $pdo = newPDO();
    $stmt = $pdo->prepare("SELECT title,bodytext
                            FROM content
                            WHERE pagina=? AND lang=?");
    $stmt->execute(array($pagina, $taal));
    $content = $stmt->fetch();
    $pdo = null;
    return $content;
}

function knopjes(){
    $taal = selecteerTaal();
    if ($taal == "NLD"){
        $knopjes = ["Home", "Accommodaties", "Prijzen", "Contact", "Login", "Galerij"];
    } elseif ($taal == "ENG"){
        $knopjes = ["Home", "Accommodations", "Pricing", "Contact", "Login", "Gallery"];
    } elseif ($taal = "DEU"){
        $knopjes = ["Home", "Unterkunft", "Preis", "Kontakt", "Login", "Galerie"];
    }
    return $knopjes;
}

function laadNieuws($id){



    $pdo = newPDO();
    $stmt = $pdo->prepare("SELECT title,bodytext,posted
                            FROM nieuwsbericht
                            WHERE id=? AND lang=?");
    $stmt->execute(array($id, selecteerTaal()));
    $nieuws = $stmt->fetch();
    $pdo = null;

    // return $content;
                print("<div class='nieuwsitem'><div class='nieuwstijd'><p>geplaatst op {$nieuws['posted']}</p></div><h3 class='nieuwstitel'>{$nieuws['title']}</h3><p>{$nieuws['bodytext']}</p> </div>");

                        // print("{$nieuws['title']}     {$nieuws['posted']} <br><br> {$nieuws['bodytext']} <br><br><br>");

}

// werkt nog niet, is alleen een begin
function toevoegen($pdo, $naam, $weeknr) {
    $stmt = $pdo->prepare("INSERT INTO klantenbestand VALUES (?,?)");
    $stmt->execute(array($naam, $weeknr));
}

function toevoegenContent($titel, $pagina, $taal, $inhoud, $eigenaar) {
    $pdo = newPDO();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $succes = true;

    $stmt = $pdo->prepare("INSERT INTO content (title, bodytext, owner, lang, pagina)
                            VALUES (?,?,?,?,?)");
    // moet nog uitbebreid worden
    try {
        $stmt->execute(array($titel, $inhoud, $eigenaar, $taal, $pagina));
    }
    catch (PDOException $e){
    }

    $pdo = null;
    return $succes;
}

function editContent($pagina, $taal, $titel, $inhoud, $eigenaar){
    $pdo = newPDO();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $succes = true;

    $stmt = $pdo->prepare("UPDATE content
                            SET title=?, bodytext=?, updated_by=?
                            WHERE pagina=?
                            AND lang=?");
    try {
        $stmt->execute(array($titel, $inhoud, $eigenaar, $pagina, $taal));
    }
    catch (PDOException $e){
        print "Er is iets vreselijk fout gegaan.";
    }


    $pdo=NULL;
    return $succes;
}

function opvragen($pdo, $kolom, $tabel, $where, $arg) {
    $aantalArg = str_repeat("?,", (count($kolom)-1)) . "?";

    if ($where = ""){
        $stmt = $pdo->prepare("SELECT :kolom FROM :tabel");
    }
    else {
        $stmt = $pdo->prepare("SELECT :kolom FROM :tabel WHERE :whereKolom = :arg");
    }
    $sth->bindParam(':kolom', $aantalArg, PDO::PARAM_STR, 12);
    $sth->bindParam(':tabel', $tabel, PDO::PARAM_STR, 12);
    $stmt->execute();
    while ($row = $stmt->fetch()) {
        $voornaam = $row["voornaam"];
        print ("<p>" . $voornaam . "</p><br>");
    }
}

// werkt nog niet, is alleen een begin
function wijzigen($pdo, $veld, $waarde, $nieuweWaarde) {
    $stmt = $pdo->prepare("UPDATE klantenbestand WHERE ? = ? SET ? = ?");
    $stmt->execute(array($veld, $waarde, $veld, $nieuweWaarde));
}

// werkt nog niet, is alleen een begin
function verwijderen($pdo, $naam, $weeknr) {
    $stmt = $pdo->prepare("DELETE FROM klantenbestand VALUES naam = ? AND weeknr = ?");
    $stmt->execute(array($naam, $weeknr));
}

function checkLogin($naam, $wachtwoord){
    $pdo = newPDO();
    $controle = ["klopt" => false,
                "foutmelding" => ""];
    // $klopt = false;
    // $foutmelding = "";

    $stmt = $pdo->prepare("SELECT gebruikersnaam, wachtwoord, privilegeniveau
                            FROM gebruikers
                            WHERE gebruikersnaam = ?");
    $stmt->execute(array($naam));
    $userRow = $stmt->fetch(PDO::FETCH_ASSOC);
    // hashen komt later wel
    // if (password_verify($password, $userRow['wachtwoord'])) {
    //     $_SESSION['user_session'] = $userRow['naam'];
    // }
    if ($naam != "" && $wachtwoord != "" && $wachtwoord == $userRow['wachtwoord']) {
        $controle['klopt'] = true;
    }
    elseif ($naam == "") {
        $controle['foutmelding'] = "Vul een gebruikersnaam in";
    }
    elseif ($wachtwoord == "") {
        $controle['foutmelding'] = "Vul een wachtwoord in";
    }
    else {
        $controle['foutmelding'] = "Onjuist wachtwoord of gebruikersnaam";
    }
    // laatste login vastleggen
    $pdo = null;

    return $controle;
}

function checkPrivileges($naam){
    $pdo = newPDO();
    $stmt = $pdo->prepare("SELECT privilegeniveau
                            FROM gebruikers
                            WHERE gebruikersnaam = ?");
    $stmt->execute(array($naam));
    $userRow = $stmt->fetch(PDO::FETCH_ASSOC);
    $pdo = null;

    return $userRow['privilegeniveau'];
}

function toevoegenaanarray($naam, $array, $persoon) {
	${$naam . $persoon} = $_GET[$naam . $persoon];
        return ($_SESSION[$array][$naam . $persoon] = ${$naam . $persoon});
}
?>
