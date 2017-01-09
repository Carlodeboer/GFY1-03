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

// Controleert eerst op welke taal de website is ingesteld en returnt vervolgens
// de bijbehorende array met waardes voor de galerij.
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

// Controleert eerst op welke taal de website is ingesteld en returnt vervolgens
// de bijbehorende array met waardes voor de nieuwsberichten.
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

// Controleert eerst op welke taal de website is ingesteld en returnt vervolgens
// de bijbehorende array met waardes voor het eerste formulier om een reis te boeken.
function boekenTaal() {
     $taal = selecteerTaal();
     if ($taal == "NLD"){
          $labels = ["Boeken", "Begindatum", "Klik in de kalender uw gewenste begindatum aan.", "Einddatum", "Klik in de kalender uw gewenste einddatum aan.", "Aantal personen", "Geen motoren beschikbaar", "Vervoer van luchthaven Lissabon", "Ja", "Nee", "Vervoer naar luchthaven Lissabon", "Ja", "Nee", "Opmerkingen", "Vakantienaam", "Deze naam gebruikt u later om uw reisgegevens in te zien. Deze gegevens zou u ook eventueel kunnen delen met reisgenoten.",
          "Volgende"];
     } elseif ($taal == "ENG"){
          $labels = ["Book", "Starting date", "Select in the calendar your preffered starting date.", "Enddate", "Select in the calendar your preffered end date.", "Number of person", "No motorcycles available", "Transport from airport of Lissabon", "Yes", "No","Transport to airport of Lissabon", "Yes", "No","Comments", "???", "This name can be used to login to check your travel information. You can perhaps share this name with you travel partners.",
          "Volgende"];
     } elseif ($taal == "DEU"){
          $labels = ["Buchen", "Startdatum", "Klik in de kalender uw gewenste begindatum aan.", "Enddatum", "Klik in de kalender uw gewenste einddatum aan.", "Aantal personen", "Geen motoren beschikbaar", "Vervoer van luchthaven Lissabon", "Ja", "Nee", "Vervoer naar luchthaven Lissabon", "Ja", "Nee", "Opmerkingen", "Vakantienaam", "Deze naam gebruikt u later om uw reisgegevens in te zien. Deze gegevens zou u ook eventueel kunnen delen met reisgenoten.",
          "Volgende"];
     }
     return $labels;
}

// Controleert eerst op welke taal de website is ingesteld en returnt vervolgens
// de bijbehorende array met waardes voor het tweede formulier om een reis te boeken.
function boekenTaal2() {
     $taal = selecteerTaal();
     if ($taal == "NLD"){
          $labels = ["Gegevens", "Persoon ", "Voornaam", "Voer hier uw voornaam in", "Achternaam", "Voer hier uw achternaam in", "Straatnaam", "Voer hier uw straatnaam in", "Huisnummer", "Voer hier uw huisnummer in", "Postcode", "Voer hier uw postcode in", "Woonplaats","Voer hier uw woonplaats in",  "Land","Voer hier uw land in",
          "Geboortedatum", "Voer hier uw geboortedatum in", "Telefoonnummer", "Voer hier uw telefoonnummer in", "E-mailadres", "Voer hier uw e-mailadres in", "Kledingmaat", "Anders", "Schoenmaat", "Anders", "Ziekten en allergieën", "Hier kunt u aangeven of u allergieën of ziektes heeft, zodat daar rekening mee kan worden gehouden.",
          "Volgende"];
     } elseif ($taal == "ENG"){
          $labels = ["Personal information", "Person", "First name", "Enter your first name", "Surname", "Enter your surname", "Street", "Enter the name of your street", "House number", "Enter your house number", "ZIP code", "Enter your ZIP code", "City", "Enter your city", "Country","Enter your country",
          "Date of birth", "Enter your date of birth", "Telephone number", "Enter your telephone number", "E-mail address", "Enter you e-mail address", "Size", "Else", "Shoe size", "Else", "Diseases and allergies", "Enter whether you have any allergies or diseases, so that can be taken into account.",
          "Next"];
     } elseif ($taal == "DEU"){
          $labels = ["Gegevens", "Persoon ", "Voornaam", "Voer hier uw voornaam in", "Achternaam", "Voer hier uw achternaam in", "Straatnaam", "Voer hier uw straatnaam in", "Huisnummer", "Voer hier uw huisnummer in", "Postcode", "Voer hier uw postcode in", "Woonplaats","Voer hier uw woonplaats in",  "Land","Voer hier uw land in",
          "Geboortedatum", "Voer hier uw geboortedatum in", "Telefoonnummer", "Voer hier uw telefoonnummer in", "E-mailadres", "Voer hier uw e-mailadres in", "Kledingmaat", "Anders", "Schoenmaat", "Anders", "Ziekten en allergieën", "Hier kunt u aangeven of u allergieën of ziektes heeft, zodat daar rekening mee kan worden gehouden.",
          "Volgende"];
     }
     return $labels;
}

// Controleert eerst op welke taal de website is ingesteld en returnt vervolgens
// de bijbehorende array met waardes voor het derde formulier om een reis te boeken.
function boekenTaal3() {
     $taal = selecteerTaal();
     if ($taal == "NLD"){
          $labels = ["Reisgegevens van ", "Begindatum", "Einddatum", "Aantal personen", "Vervoer van luchthaven Lissabon", "Ja", "Nee", "Vervoer naar luchthaven Lissabon", "Ja", "Nee", "Opmerkingen", "Vakantienaam",
          "Persoonlijke gegevens", "Persoon ", "Voornaam", "Achternaam", "Adres", "Postcode", "Woonplaats", "Land", "Geboortedatum", "Telefoonnummer", "E-mailadres", "Kledingmaat", "Schoenmaat", "Bijzonderheden",
          "Afronden"];
     } elseif ($taal == "ENG"){
          $labels = ["Travel information of ", "Starting date", "End date", "Number of person", "Transport of airport Lissabon", "Transport to airport Lissabon", "Comments", "Name for your trip",
          "Personal information", "Person ", "First name", "Firstname", "Surname", "Address", "ZIP code", "City", "Country", "Date of birth", "Telephone number", "E-mail address", "Size", "Shoe size", "Diseases and allergies",
          "Complete"];
     } elseif ($taal == "DEU"){
          $labels = ["Reisgegevens van ", "Begindatum", "Einddatum", "Aantal personen", "Vervoer van luchthaven Lissabon", "Ja", "Nee", "Vervoer naar luchthaven Lissabon", "Ja", "Nee", "Opmerkingen", "Vakantienaam",
          "Persoonlijke gegevens", "Persoon ", "Voornaam", "Achternaam", "Adres", "Postcode", "Woonplaats", "Land", "Geboortedatum", "Telefoonnummer", "E-mailadres", "Kledingmaat", "Schoenmaat", "Bijzonderheden",
          "Afronden"];
     }
     return $labels;
}

// Controleert eerst op welke taal de website is ingesteld en returnt vervolgens
// de bijbehorende array met waardes voor de bevestigingspagina die verschijnt
// na het boeken van een reis.
function boekenTaal4() {
     $taal = selecteerTaal();
     if ($taal == "NLD"){
          $labels = ["Uw boeking is succesvol verwerkt.<br>U kunt ", "hier ", "uw reisinformatie inzien met uw ingevoerde vakantienaam: ", " en weeknummer: "];
     } elseif ($taal == "ENG"){
          $labels = ["Your reservation has been processed successfully.<br>You can check you travel information ", "here ", "with the name you gave to your trip: ", " and the number of the week: "];
     } elseif ($taal == "DEU"){
          $labels = ["Uw boeking is succesvol verwerkt.<br>U kunt ", "hier ", "uw reisinformatie inzien met uw ingevoerde vakantienaam: ", " en weeknummer: "];
     }
     return $labels;
}

// Controleert eerst op welke taal de website is ingesteld en returnt vervolgens
// de bijbehorende array met waardes voor de agenda.
function agendaTaal() {
     $taal = selecteerTaal();
     if ($taal == "NLD"){
          $labels = ["Vorige", "Januari", "Februari", "Maart", "April", "Mei", "Juni", "Juli", "Augustus", "September", "Oktober", "November", "December", "Volgende",
          "Zo", "Ma", "Di", "Wo", "Do", "Vr", "Za", " motor(en) beschikbaar"];
     } elseif ($taal == "ENG"){
          $labels = ["Previous", "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December", "Next",
          "Su", "Mo", "Tu", "We", "Th", "Fr", "Sa", " motorcycle(s) available"];
     } elseif ($taal == "DEU"){
          $labels = ["Zurück", "Januar", "Februar", "März", "April", "Mai", "Juni", "Juli", "August", "September", "Oktober", "November", "Dezember", "Weiter",
          "So", "Ma", "Di", "Mi", "Do", "Vr", "Sa",
          " motorrad verfügbar"];
     }
     return $labels;
}

// Controleert eerst op welke taal de website is ingesteld en returnt vervolgens
// de bijbehorende array met waardes voor het loginformulier voor klanten.
function loginTaal(){
     $taal = selecteerTaal();
     if ($taal == "NLD"){
          $labels = ["Reisinformatie opvragen", "Vakantienaam", "Vul hier uw vakantienaam in.", "Weeknummer", "Vul hier uw weeknummer in.", "Verzenden"];
     } elseif ($taal == "ENG"){
          $labels = ["Travel information request", "Name given to your trip", "Enter the name given to your trip.", "Number of the week", "Enter the number of the week.", "Go"];
     } elseif ($taal == "DEU"){
          $labels = ["Reiseinformationen aufrufen", "Name des Urlaubs", "Geben Sie den Namen der Feiertage.", "Wochennummer", "Füllen Sie die Kalenderwoche hier.", "Senden"];
     }
     return $labels;
}


// Controleert eerst op welke taal de website is ingesteld en returnt vervolgens
// de bijbehorende array met waardes voor de agenda.
function reisinformatieTaal() {
     $taal = selecteerTaal();
     if ($taal == "NLD"){
          $labels = ["Reisgegevens van ", " in week ", "Reisgegevens", "Begindatum", "Einddatum", "Aantal personen", "Vervoer van luchthaven Lissabon", "Ja", "Nee", "Vervoer naar luchthaven Lissabon", "Ja", "Nee", "Opmerkingen", "Status", "Betaling",
          "Persoonlijke gegevens", "Persoon ", "Voornaam", "Achternaam", "Adres", "Postcode", "Woonplaats", "Land", "Geboortedatum", "Telefoonnummer", "E-mailadres", "Kledingmaat", "Schoenmaat", "Ziekten en allergieën",
     "Onjuiste vakantienaam of vakantieweek. Ga terug naar de ", "loginpagina"];
     } elseif ($taal == "ENG"){
          $labels = ["Travel information of ", " in week ", "Travel information",  "Starting date", "End date", "Number of person", "Transport of airport Lissabon", "Yes", "No", "Transport to airport Lissabon", "Yes", "No", "Comments", "Status", "Payment",
          "Personal information", "Person ", "First name", "Surname", "Address", "ZIP code", "City", "Country", "Date of birth", "Telephone number", "E-mail address", "Size", "Shoe size", "Diseases and allergies",
          "Incorrect name or number of the week. Back to", "login page"];
     } elseif ($taal == "DEU"){
          $labels = ["Reise Details ", " in Woche ", "Reise", "Startdatum ", "Ende", "Anzahl der Personen", "Transport Flughafen Lissabon", "Ja", "Nein", "Anfahrt zum Flughafen von Lissabon", "Ja", "Nein", "Notes", "Status", "Zahlung",
          "Persönliche Informationen", "Person", "Name", "Nachname", "Adresse", "Zip", "Location", "Land", "Geburt", "Telefon", "E-Mail", "Bekleidung Size", "Schuh", "Krankheiten und Allergien",
     "Falscher Name oder Urlaub Urlaub Woche. Zurück zum ", "Login-Seite"];
     }
     return $labels;
}

?>
