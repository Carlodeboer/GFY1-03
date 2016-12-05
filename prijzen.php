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
                <?php
                    include "functions.php";
                    $content = laadContent("","");
                    print "<h2>".$content['title']."</h2>";
                    print "<p>".$content['bodytext']."</p>";
                ?>
                <form method="POST" action="boeken.php">
                    <input type="submit" value="Boeken">
                </form>
            </div>
            <?php include 'footer.php'; ?>
        </div>
    </body>
</html>
