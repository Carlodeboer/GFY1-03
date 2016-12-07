<?php
    session_start();
?>
<!DOCTYPE html>
<html>
<head>
  <?php include 'head.php';?>
</head>
    <body>
        <div id="container">
          <?php include 'header.php';?>
            <div id="content">
              <div id="contentwrapper">
                <?php
                    //include "functions.php";
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
