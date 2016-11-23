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
                <?php
                      include 'functions.php';

                      session_start();

                      if (!isset($_POST['username'])) {
                          include "adminlogin.php";
                      }
                      else {

                          if(checkLogin($_POST['naam'], $_POST['wachtwoord'])) {
                              include 'moetnogeennaamverzinnen.php'
                          }
                      }
                  ?>

            </div>
            <?php include 'footer.php';?>
        </div>
    </body>
</html>
