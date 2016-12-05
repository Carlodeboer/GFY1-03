<?php
    session_start();
?>
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
              <div id="contentwrapper">
                <?php
                    include "functions.php";
                    $content = laadContent("","");
                    print "<h2>".$content['title']."</h2>";
                    print "<p>".$content['bodytext']."</p>";
                ?>
              
           

            <div id="nieuws">
            <?php


if(!isset($_GET['lang'])){
$_GET['lang'] = 'NLD';
}

if(isset($_GET['lang'])){
  $lang = $_GET['lang'];


            $nieuws = laadNieuws(1,$lang);
            $nieuws = laadNieuws(2,$lang);
            $nieuws = laadNieuws(3,$lang);
            $nieuws = laadNieuws(4,$lang);

}

            ?>
            </div>
             </div>
            </div>
            <?php include 'footer.php';?>
        </div>
    </body>
</html>
