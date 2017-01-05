<?php
include "toegang.php";

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

// Controleert eerst op welke taal de website is ingesteld en returnt vervolgens
// de bijbehorende array met waardes voor de navigatiebalk.
function knopjes(){
    $taal = selecteerTaal();
    if ($taal == "NLD"){
        $knopjes = ["Home", "Accommodatie", "Prijzen", "Contact", "Login", "Galerij"];
    } elseif ($taal == "ENG"){
        $knopjes = ["Home", "Accommodation", "Pricing", "Contact", "Login", "Gallery"];
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

function galerijTaal(){
    $taal = selecteerTaal();
    if ($taal == "NLD"){
        $labels = ["Galerij"];
    } elseif ($taal == "ENG"){
        $labels = ["Galery"];
   } elseif ($taal == "DEU"){
        $labels = ["Galerie"];
    }
    return $labels;
}

function loginTaal(){
    $taal = selecteerTaal();
    if ($taal == "NLD"){
        $labels = ["Reisinformatie opvragen"];
    } elseif ($taal == "ENG"){
        $labels = ["Travel information request"];
   } elseif ($taal == "DEU"){
        $labels = ["Reiseinformationen aufrufen"];
    }
    return $labels;
}

function nieuwsTaal(){
    $taal = selecteerTaal();
    if ($taal == "NLD"){
        $labels = [" nieuwsberichten", "geplaatst op"];
    } elseif ($taal == "ENG"){
        $labels = [" messages", "posted on"];
   } elseif ($taal == "DEU"){
        $labels = [" Nachrichten", "platziert auf"];
    }
    return $labels;
}
?>
