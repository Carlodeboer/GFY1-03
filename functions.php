<?php
include "toegang.php";

// Maakt een nieuwe verbinding met de database.
function newPDO() {
    $db = "mysql:host=carlodb.nl;dbname=carlodb_database;port=3306";
    $user = "carlodb_school";
    $pass = "GFY1-03";
    $pdo = new PDO($db, $user, $pass);
    return ($pdo);
}

// Controleert of de gebruiker een taal heeft geselecteerd. Zo ja, dan wordt de
// geselecteerde taal in een session gezet en returnt hij dit. Zo nee, dan wordt
// gekeken of er al een taal in de session staat. Zo ja, dan returnt hij dit.
// Als dit ook niet het geval is,dan wordt de taal standaard op Nederlands gezet.
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

// Haalt de bijbehorende gegevens op uit de database die aan deze functie worden
// meegegeven. Dit is echter niet nodig. De programmeur kan zelf kiezen wat hij/zij
// wil ophalen uit de database, maar dit kan ook automatisch geselecteerd als hij/zij
// lege strings meegeeft.
function laadContent($bestandsnaam, $taal, $admin = false){
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
    if (!$admin) {
        $content['title'] = htmlspecialchars($content['title'], ENT_QUOTES);
        $content['bodytext'] = htmlentities($content['bodytext'], ENT_QUOTES);
        $content['bodytext'] = str_replace(array("\r\n", "\n\r", "\r", "\n"), "<br>", $content['bodytext']);
    }
    return $content;
}

// Controleert eerst op welke taal de website is ingesteld en returnt vervolgens
// de bijbehorende array met waardes voor de navigatiebalk.
function knopjes(){
    $taal = selecteerTaal();
    if ($taal == "NLD"){
        $knopjes = ["Home", "Accommodaties", "Prijzen", "Contact", "Login", "Galerij"];
    } elseif ($taal == "ENG"){
        $knopjes = ["Home", "Accommodations", "Pricing", "Contact", "Login", "Gallery"];
   } elseif ($taal == "DEU"){
        $knopjes = ["Home", "Unterkunft", "Preis", "Kontakt", "Login", "Galerie"];
    }
    return $knopjes;
}

// Controleert eerst op welke taal de website is ingesteld en returnt vervolgens
// de bijbehorende array met waardes voor het contactformulier.
function contactformulierTaal(){
    $taal = selecteerTaal();
    if ($taal == "NLD"){
        $labels = ["Contact", "Voornaam *", "Achternaam *", "Onderwerp *", "E-mailadres *", "Telefoonnummer", "Bericht *", "Verzenden", "Fijn dat u contact met ons opneemt."];
    } elseif ($taal == "ENG"){
        $labels = ["Contact", "First name *", "Last name *", "Subject *", "Email address *", "Phone number", "Message *", "Send", "Thank you for contacting us."];
   } elseif ($taal == "DEU"){
        $labels = ["Kontakt", "Vorname *", "Nachname *", "Thema *", "E-Mail-Adresse *", "Telefonnummer", "Nachricht *", "Schiff", "Danke für Ihre Kontaktaufnahme."];
    }
    return $labels;
}

// Laadt alle nieuwsbericht die bij de geselecteerde taal horen.
function laadNieuws($id){

    $pdo = newPDO();
    $stmt = $pdo->prepare("SELECT title,bodytext,posted
                            FROM nieuwsbericht
                            WHERE id=? AND lang=?");
    $stmt->execute(array($id, selecteerTaal()));
    $nieuws = $stmt->fetch();
    $pdo = null;

    // return $content;
                print("<div class='nieuwsitem'><div class='nieuwstijd'>geplaatst op {$nieuws['posted']}</div><h3 class='nieuwstitel'>{$nieuws['title']}</h3><p class='nieuwsbody'>{$nieuws['bodytext']}</p> </div>");

                        // print("{$nieuws['title']}     {$nieuws['posted']} <br><br> {$nieuws['bodytext']} <br><br><br>");

}

// werkt nog niet, is alleen een begin
function toevoegen($pdo, $naam, $weeknr) {
    $stmt = $pdo->prepare("INSERT INTO klantenbestand VALUES (?,?)");
    $stmt->execute(array($naam, $weeknr));
}

// Wordt niet meer gebruikt?
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

// Vraagt de bijbehorende gegevens op van de gebruikersnaam die de gebruiker heeft
// ingevuld. Controleert vervolgens of beide velden niet leeg zijn gelaten en of
// het wachtwoord correct is. Als dit het geval is, dan wordt $controle gereturnt
// met de waardes klopt = true en een lege foutmelding. Als dit niet het geval is,
// dan welk veld leeg is en returnt vervolgens klopt = false en een bijbehorende
// foutmelding. Als beide velden wel zijn ingevuld maar het wachtwoord incorrect
// is, dan wordt klopt = false en een bijbehorende foutmelding gereturnt.
function checkLogin($naam, $wachtwoord){
    $pdo = newPDO();
    $controle = ["klopt" => false,
                "foutmelding" => ""];
    $stmt = $pdo->prepare("SELECT gebruikersnaam, wachtwoord, privilegeniveau
                            FROM gebruikers
                            WHERE gebruikersnaam = ?");
    $stmt->execute(array($naam));
    $userRow = $stmt->fetch(PDO::FETCH_ASSOC);
    // hashen komt later wel
    // if (password_verify($password, $userRow['wachtwoord'])) {
    //     $_SESSION['user_session'] = $userRow['naam'];
    // }
    if ($naam != "" && $wachtwoord != "" && password_verify($wachtwoord, $userRow['wachtwoord'])) {
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

// Vraagt het privilegeniveau van de meegegeven gebruikersnaam op en returnt dit.
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

function toevoegenAanArray($naam, $array, $persoon) {
     if ($persoon != "") {
	${$naam . $persoon} = $_POST[$naam . $persoon];
        return ($_SESSION[$array][$naam . $persoon] = ${$naam . $persoon});
   } else {
        $var = $_POST[$naam];
        return ($_SESSION[$array][$naam] = $var);
   }
}
?>
