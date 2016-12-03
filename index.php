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
          <?php include 'header.php';?>

            <div id="content">
                <?php
                    include "functions.php";
                    $pagina = "index";
                    $taal = "NLD";
                    $content = laadContent($pagina, $taal);

                    print "<h2>".$content['title']."</h2>";
                    print "</p>".$content['bodytext']."</p>";


?>

            </div>

            <?php include 'footer.php';?>
        </div>
    </body>
</html>
