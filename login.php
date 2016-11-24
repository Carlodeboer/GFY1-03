<!DOCTYPE html>
<html>
    <?php
    include "dbconnect.php"
    ?>
    <head>
            <title>Motorcross</title>
            <?php include 'head.php';?>
    </head>
    <body>
        <div id="container">
          <?php include 'header.php';?>

            <div id="content">
                <h2> Login </h2>
                <form method="POST" action="login.php">
                    Vakantieweek: <input type="text" name="vakantieweek"><br><br>
                    Vakantienaam: <input type="text" name="vakantienaam"><br>
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
            <?php include 'footer.php';?>
        </div>
    </body>
