<?php

// gelieve hier alle functies te plaatsen ;)
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

function banner() {
    print("<div id=\"container\">
            <nav>
                <div id=\"banner\">
                </div>
                <ul>
                    <a href=\"index.php\"><li>Home</li></a>
                    <a href=\"informatie.php\"><li>Informatie</li></a>
                    <a href=\"boeken.php\"><li>Boeken</li></a>
                    <a href=\"contact.php\"><li>Contact</li></a>
                    <a href=\"login.php\"><li>Login</li></a>
                </ul>");
}

?>
