<?php
    session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Prijzen</title>
        <?php include 'head.php'; ?>

    </head>
    <body>
        <div id="container">
            <?php include 'header.php'; ?>

            <div id="content">
              <div id="contentwrapper">
                <?php
                    //include "functions.php";
                    $content = laadContent("","");
                    print "<h2>".$content['title']."</h2>";
                    print "<p>".$content['bodytext']."</p>";
                ?>
                <form method="POST" action="boeken.php">
                    <input type="submit" value="Boeken" class="btn-main">
                </form>
              </div>
            </div>
            <?php include 'footer.php'; ?>
        </div>
    </body>
</html>
