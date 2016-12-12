<?php define("toegang", true); ?>
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
            <div id="contentwrapper">

            <?php
                //include "functions.php";
                $content = laadContent("","");
                print "<h2>".$content['title']."</h2>";
                print "<p>".$content['bodytext']."</p>";
                ?>
              </div>
          </div>
          <?php include 'footer.php';?>
        </div>
    </body>
</html>
