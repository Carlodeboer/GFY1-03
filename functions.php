<?php

// gelieve hier alle functies te plaatsen ;)
function newPDO() {
    $db = "mysql:host=carlodb.nl;dbname=carlodb_database;port=3306";
    $user = "carlodb_school";
    $pass = "GFY1-03";
    $pdo = new PDO($db, $user, $pass);
    return ($pdo);
}
function laadContent($taal,$pagina){
    $pdo = newPDO();
    $stmt = $pdo->prepare("SELECT title,bodytext
                            FROM content
                            WHERE lang=? AND pagina=?");
    $stmt->execute(array($taal, $pagina));
    $content = $stmt->fetch();
    $pdo = null;
    return $content;
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
?>
