<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        if (isset($_POST["verzenden"])) {
            $week = $_POST["vakantieweek"];
            $naam = $_POST["vakantienaam"];

            // Verbinding maken
            $db = "mysql:host=localhost;dbname=motorcrossdb;port=3307";
            $user = "root";
            $pass = "usbw";
            $pdo = new PDO($db, $user, $pass);
            
            // Voorbereiden
            $stmt = $pdo->prepare("SELECT weeknummer, vakantienaam FROM klantenbestand WHERE weeknummer = ? AND vakantienaam = ?");

            // Uitvoeren

            $stmt->execute(array($week, $naam));
            
            // Loop langs alle rijen
            while ($row = $stmt->fetch()) {
                // haal de kolom ‘naam’ op
                $week = $row["weeknummer"];
                $naam = $row["vakantienaam"];
                print("<h1>Reisinfo voor " . $naam . " in week " . substr($code, 0, 2) . "<h1>");
            }

            // Verbinding opruimen
            $pdo = NULL;
        }
        ?>
    </body>
</html>
