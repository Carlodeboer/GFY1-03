<?php define("toegang", true); ?>
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
                    $content = laadContent("","");
                    print "<h2>".$content['title']."</h2>";
                    print "<p>".$content['bodytext']."</p>";
                ?>
                <form method="POST" action="boeken.php">
                    <input type="submit" value="Boeken" class="btn btn-raised btn-primary">
                </form>
              </div>
            </div>
            <?php include 'footer.php'; ?>
        </div>
    </body>
</html>
