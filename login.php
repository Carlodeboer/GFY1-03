<!DOCTYPE html>
<html>
    <?php
    include "dbconnect.php"
    ?>
    <head>
        <title>Motorcross</title>
        <link type="text/css" rel="stylesheet" href="style.css">
    </head>
    <body>
        <div id="container">
            <nav>
                <div id="banner">
                    <h2> header </h2>
                </div>
                <ul>
                    <a href="index.php"><li>Home</li></a>
                    <a href="informatie.php"><li>Informatie</li></a>
                    <a href="boeken.php"><li>Boeken</li></a>
                    <a href="contact.php"><li>Contact</li></a>
                    <a href="login.php"><li>Login</li></a>
                </ul>
            </nav>

            <div id="content">
                <h2> content </h2>
                <form method="POST" action="login.php"> 
                    Vakantieweek: <input type="text" name="vakantieweek">
                    Vakantienaam: <input type="text" name="vakantienaam">
                    <input type="submit" name="verzenden" value="Reisinfo">
                </form>
                <?php
                if (isset($_POST["verzenden"])) {
                    $week = $_POST["vakantieweek"];
                    $naam = $_POST["vakantienaam"];

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
            </div>
            <footer>
                <h2> footer </h2>
            </footer>
        </div>
    </body>