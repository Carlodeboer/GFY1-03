<!DOCTYPE html>
<html>
<head>
  <?php include 'head.php';?>
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
</head>
    <body>
        <div id="container">
          <?php
                include 'header.php';
            ?>
            <div id="content">
                <form method="post" action="beheerpaneel.php">
                    <h2>Inloggen</h2>
                    Gebruikersnaam: <input type="text" name="naam"><br>
                    Wachtwoord: <input type="password" name="wachtwoord"><br><br>
                    <input type="submit" name="submit" value="Login">
                </form>
            </div>
            <?php include 'footer.php';?>
        </div>
    </body>
</html>
