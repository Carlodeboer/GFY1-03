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
                          
                      }

                  ?>
                <table>
                    <form method="GET" action="beheerpaneel.php">
                        <tr>
                            <td>Titel:</td>
                            <td><input type="text" name="titel"></td>
                        </tr><tr>
                            <td>Pagina:</td>
                            <td><select name="pagina"><option value="1">Thuispagina</option><option value="2">Informatie</option></td>
                        </tr><tr>
                            <td>Inhoud:</td>
                            <td><textarea name="titel" rows="4" cols="60"></textarea></td>
                        </tr><tr>
                            <td><input type="submit" name="verzenden" value="Verzenden"></td>
                        </tr>
                    </form>
                </table>
            </div>
            <?php include 'footer.php';?>
        </div>
    </body>
</html>
