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

function boekenTaal() {
     $taal = selecteerTaal();
     if ($taal == "NLD"){
          $labels = ["Boeken", "Begindatum", "Einddatum", "Aantal personen", "Vervoer van luchthaven Lissabon", "Vervoer naar luchthaven Lissabon", "Opmerkingen", "Vakantienaam",
          "Klik in de kalender uw gewenste begindatum aan.", "Klik in de kalender uw gewenste einddatum aan.", "Deze naam gebruikt u later om uw reisgegevens in te zien. Deze gegevens zou u ook eventueel kunnen delen met reisgenoten.",
          "Volgende"];
     } elseif ($taal == "ENG"){
          $labels = ["Boeken", "Begindatum", "Einddatum", "Aantal personen", "Vervoer van luchthaven Lissabon", "Vervoer naar luchthaven Lissabon", "Opmerkingen", "Vakantienaam",
          "Klik in de kalender uw gewenste begindatum aan.", "Klik in de kalender uw gewenste einddatum aan.", "Deze naam gebruikt u later om uw reisgegevens in te zien. Deze gegevens zou u ook eventueel kunnen delen met reisgenoten.",
          "Volgende"];
     } elseif ($taal == "DEU"){
          $labels = ["Boeken", "Begindatum", "Einddatum", "Aantal personen", "Vervoer van luchthaven Lissabon", "Vervoer naar luchthaven Lissabon", "Opmerkingen", "Vakantienaam",
          "Klik in de kalender uw gewenste begindatum aan.", "Klik in de kalender uw gewenste einddatum aan.", "Deze naam gebruikt u later om uw reisgegevens in te zien. Deze gegevens zou u ook eventueel kunnen delen met reisgenoten.",
          "Volgende"];
     }
     return $labels;
}
function boekenTaal2() {
     $taal = selecteerTaal();
     if ($taal == "NLD"){
          $labels = ["Gegevens", "Voornaam", "Voer hier uw voornaam in", "Achternaam", "Voer hier uw achternaam in", "Straatnaam", "Voer hier uw straatnaam in", "Huisnummer", "Voer hier uw huisnummer in", "Postcode", "Voer hier uw postcode in", "Woonplaats","Voer hier uw woonplaats in",  "Land","Voer hier uw land in",
          "Geboortedatum", "Voer hier uw geboortedatum in", "Telefoonnummer", "Voer hier uw telefoonnummer in", "E-mailadres", "Voer hier uw e-mailadres in", "Kledingmaat", "Anders", "Schoenmaat", "Anders", "Bijzonderheden", "Hiermee kunt u aangeven welke allergieën of ziektes u heeft, zodat daar rekening mee kan worden gehouden.",
          "Volgende"];
     } elseif ($taal == "ENG"){
          $labels = ["Gegevens", "Voornaam", "Voer hier uw voornaam in", "Achternaam", "Voer hier uw achternaam in", "Straatnaam", "Voer hier uw straatnaam in", "Huisnummer", "Voer hier uw huisnummer in", "Postcode", "Voer hier uw postcode in", "Woonplaats","Voer hier uw woonplaats in",  "Land","Voer hier uw land in",
          "Geboortedatum", "Voer hier uw geboortedatum in", "Telefoonnummer", "Voer hier uw telefoonnummer in", "E-mailadres", "Voer hier uw e-mailadres in", "Kledingmaat", "Anders", "Schoenmaat", "Anders", "Bijzonderheden", "Hiermee kunt u aangeven welke allergieën of ziektes u heeft, zodat daar rekening mee kan worden gehouden.",
          "Volgende"];
     } elseif ($taal == "DEU"){
          $labels = ["Gegevens", "Voornaam", "Voer hier uw voornaam in", "Achternaam", "Voer hier uw achternaam in", "Straatnaam", "Voer hier uw straatnaam in", "Huisnummer", "Voer hier uw huisnummer in", "Postcode", "Voer hier uw postcode in", "Woonplaats","Voer hier uw woonplaats in",  "Land","Voer hier uw land in",
          "Geboortedatum", "Voer hier uw geboortedatum in", "Telefoonnummer", "Voer hier uw telefoonnummer in", "E-mailadres", "Voer hier uw e-mailadres in", "Kledingmaat", "Anders", "Schoenmaat", "Anders", "Bijzonderheden", "Hiermee kunt u aangeven welke allergieën of ziektes u heeft, zodat daar rekening mee kan worden gehouden.",
          "Volgende"];
     }
     return $labels;
}
function boekenTaal3() {
     $taal = selecteerTaal();
     if ($taal == "NLD"){
          $labels = ["Reisgegevens van ", "Begindatum", "Einddatum", "Aantal personen", "Vervoer van luchthaven Lissabon", "Ja", "Nee", "Vervoer naar luchthaven Lissabon", "Ja", "Nee", "Opmerkingen", "Vakantienaam",
          "Persoonlijke gegevens", "Persoon ", "Voornaam", "Achternaam", "Adres", "Postcode", "Woonplaats", "Land", "Geboortedatum", "Telefoonnummer", "E-mailadres", "Kledingmaat", "Schoenmaat", "Bijzonderheden",
          "Afronden"];
     } elseif ($taal == "ENG"){
          $labels = ["Reisgegevens van ", "Begindatum", "Einddatum", "Aantal personen", "Vervoer van luchthaven Lissabon", "Vervoer naar luchthaven Lissabon", "Opmerkingen", "Vakantienaam",
          "Persoonlijke gegevens", "Persoon ", "Voornaam", "Achternaam", "Adres", "Postcode", "Woonplaats", "Land", "Geboortedatum", "Telefoonnummer", "E-mailadres", "Kledingmaat", "Schoenmaat", "Bijzonderheden",
          "Afronden"];
     } elseif ($taal == "DEU"){
          $labels = ["Reisgegevens van ", "Begindatum", "Einddatum", "Aantal personen", "Vervoer van luchthaven Lissabon", "Vervoer naar luchthaven Lissabon", "Opmerkingen", "Vakantienaam",
          "Persoonlijke gegevens", "Persoon ", "Voornaam", "Achternaam", "Adres", "Postcode", "Woonplaats", "Land", "Geboortedatum", "Telefoonnummer", "E-mailadres", "Kledingmaat", "Schoenmaat", "Bijzonderheden",
          "Afronden"];
     }
     return $labels;
}
function boekenTaal4() {
     $taal = selecteerTaal();
     if ($taal == "NLD"){
          $labels = ["Uw boeking is succesvol verwerkt.<br>U kunt ", "hier ", "uw reisinformatie inzien met uw ingevoerde vakantienaam: ", " en weeknummer: "];
     } elseif ($taal == "ENG"){
          $labels = ["Travel information request"];
     } elseif ($taal == "DEU"){
          $labels = ["Reiseinformationen aufrufen"];
     }
     return $labels;
}
function agendaTaal() {
     $taal = selecteerTaal();
     if ($taal == "NLD"){
          $labels = ["Vorige", "Januari", "Februari", "Maart", "April", "Mei", "Juni", "Juli", "Augustus", "September", "Oktober", "November", "December", "Volgende",
     "Zo", "Ma", "Di", "Wo", "Do", "Vr", "Za"];
     } elseif ($taal == "ENG"){
          $labels = ["Travel information request"];
     } elseif ($taal == "DEU"){
          $labels = ["Reiseinformationen aufrufen"];
     }
     return $labels;
}
?>
