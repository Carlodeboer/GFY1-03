<!DOCTYPE html>
<html>
    <?php
    include "dbconnect.php"
    ?>
    <head>
            <title>Motorcross</title>
            <link type="text/css" rel="stylesheet" href="style/style.css">
            <link type="text/css" rel="stylesheet" href="style/responsiveslides.css">
            <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
            <script src="js/responsiveslides.js"></script>
            <script>
              $(function() {
                $(".rslides").responsiveSlides();
              });
            </script>
    </head>    <body>
        <div id="container">
          <?php include 'header.php';?>

            <div id="content">
                <h2> content </h2>
                <form method="POST" action="login.php">
                    Vakantieweek: <input type="text" name="vakantieweek"><br>
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
