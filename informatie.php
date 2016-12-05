<?php
    session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Motorcross</title>
    <?php include 'head.php';?>
</head>
    <body>
        <div id="container">
          <?php include 'header.php';?>
          <div id="content">
            <?php
                include "functions.php";
                $content = laadContent("","");
                print "<h2>".$content['title']."</h2>";
                print "<p>".$content['bodytext']."</p>";
                ?>
          </div>
          <?php include 'footer.php';?>
        </div>
    </body>
</html>
