<?php define("toegang", true); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Accommodatie</title>
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
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d12486.016844422375!2d-9.106586769673552!3d38.445485174283974!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd19518b4a6daf8d%3A0xd16dc61d905e068b!2sSesimbra%2C+Portugal!5e0!3m2!1snl!2snl!4v1483805616779" width="400" height="300" frameborder="0" style="border:0" allowfullscreen></iframe>
              </div>
          </div>
          <?php include 'footer.php';?>
        </div>
    </body>
</html>
