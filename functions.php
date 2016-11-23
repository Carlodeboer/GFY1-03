<?php

// gelieve hier alle functies te plaatsen ;)
function newPDO() {
    $db = "mysql:host=carlodb.nl;dbname=carlodb_database;port=3306";
    $user = "carlodb_school";
    $pass = "GFY1-03";
    $pdo = new PDO($db, $user, $pass);
    return ($pdo);
}
// werkt nog niet, is alleen een begin
function toevoegen($pdo, $naam, $weeknr) {
    $stmt = $pdo->prepare("INSERT INTO klantenbestand VALUES (?,?)");
    $stmt->execute(array($naam, $weeknr));
}

function opvragen($pdo) {
    $stmt = $pdo->prepare("SELECT * FROM klantenbestand");
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
    $klopt = false;

    $stmt = $pdo->prepare("SELECT gebruikersnaam, wachtwoord, privilegeniveau
                            FROM gebruikers
                            WHERE gebruikersnaam = $naam");
    $stmt->execute();
    $userRow = $stmt->fetch(PDO::FETCH_ASSOC))
    if (password_verify($password, $userRow['wachtwoord'])) {
        $_SESSION['user_session'] = $userRow['naam'];
    }

    $pdo = null;

    return $klopt;
}

function checkPrivileges(){

}
?>
