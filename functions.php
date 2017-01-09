<?php
/*******************************************************************************
 * Copyright (c) 2017 Carlo de Boer, Floris de Grip, Thijs Marschalk,
 * Ralphine de Roo, Sophie Roos and Ian Vredenburg
 *
 * This Source Code Form is subject to the terms of the MIT license.
 * If a copy of the MIT license was not distributed with this file. You can
 * obtain one at https://opensource.org/licenses/MIT
 *******************************************************************************/
?>
<?php
include "toegang.php";
include "taal.php";

// Maakt een nieuwe verbinding met de database.
function newPDO() {
    $db = "mysql:host=carlodb.nl;dbname=carlodb_database;port=3306";
    $user = "carlodb_school";
    $pass = "GFY1-03";
    $pdo = new PDO($db, $user, $pass);
    return ($pdo);
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
    return $content;
}

// Laadt alle nieuwsbericht die bij de geselecteerde taal horen.
function laadNieuws($id){
    $labels = nieuwsTaal();
    $pdo = newPDO();
    $stmt = $pdo->prepare("SELECT title,bodytext,posted
                            FROM nieuwsbericht
                            WHERE id=? AND lang=?");
    $stmt->execute(array($id, selecteerTaal()));
    $nieuws = $stmt->fetch();
    $pdo = null;

    print("<div class='nieuwsitem'><div class='nieuwstijd'>{$labels[1]} {$nieuws['posted']}</div><h3 class='nieuwstitel'>{$nieuws['title']}</h3><p class='nieuwsbody'>{$nieuws['bodytext']}</p> </div>");
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

// Voegt een nieuwe element toe aan de array. $array is de naam van de array waar het aan toegevoegd moet worden. $naam is de index van het element.
// Als $persoon is ingevuld, wordt $naam en $persoon samengevoegd. $naam is ook de naam van het POST-veld.
function toevoegenAanArray($naam, $array, $persoon) {
     if ($persoon != "") {
	${$naam . $persoon} = $_POST[$naam . $persoon];
        return ($_SESSION[$array][$naam . $persoon] = ${$naam . $persoon});
   } else {
        $var = $_POST[$naam];
        return ($_SESSION[$array][$naam] = $var);
   }
}

function nieuwAccount($naam, $wachtwoord, $wachtwoord2){
    $succes = [false, ""];
    if ($naam == "" && ($wachtwoord == "" || $wachtwoord2 = "")){
        $succes[1] = "Vul de velden in.";
    } elseif($naam == ""){
        $succes[1] = "Vul een gebruikersnaam in.";
    } elseif($wachtwoord == ""){
        $succes[1] = "Vul een wachtwoord in.";
    } elseif($wachtwoord2 == ""){
        $succes[1] = "Herhaal het wachtwoord.";
    } elseif($wachtwoord != $wachtwoord2){
        $succes[1] = "De ingevoerde wachtwoorden komen niet overeen.";
    } else {
        $pdo = newPDO();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt1 = $pdo->prepare("SELECT gebruikersnaam FROM gebruikers WHERE gebruikersnaam = ?");
        $stmt1->execute(array($naam));
        if ($stmt1->rowCount() > 0){
            $succes[1] = "Gebruikersnaam bestaat al.";
        } else {
            $wachtwoordhash = password_hash($wachtwoord, PASSWORD_DEFAULT);
            $privilege = 2;
            try {
                $stmt2 = $pdo->prepare("SELECT max(idGebruiker) FROM gebruikers");
                $stmt2->execute(array());
                $row = $stmt2->fetch();
                $id = $row["max(idGebruiker)"] + 1;
                $stmt3 = $pdo->prepare("INSERT INTO gebruikers(idGebruiker, gebruikersnaam, wachtwoord, privilegeniveau) VALUES (?,?,?,?)");
                $stmt3->execute(array($id, $naam, $wachtwoordhash, $privilege));
            } catch (PDOException $e){
                $succes[1] = $e;
            }
            if (!isset($e)){
                $succes = [true, "Nieuw account aangemaakt!"];
            }
        }
    }
    $pdo = null;
    return $succes;
}
?>
