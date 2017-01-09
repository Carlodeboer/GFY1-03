<?php
/*******************************************************************************
 * Copyright (c) 2017 Carlo de Boer, Floris de Grip, Thijs Marschalk,
 * Ralphine de Roo, Sophie Roos and Ian Vredenburg
 *
 * This Source Code Form is subject to the terms of the MIT license.
 * If a copy of the MIT license was not distributed with this file. You can
 * obtain one at https://opensource.org/licenses/MIT
 *******************************************************************************/
?>
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
              <div id="row">
                <?php
                    // Vraagt de pagina-inhoud met de juiste taal op via de functie
                    // laadContent en print dit vervolgens op de pagina.
                    $content = laadContent("","");
                    print "<h2>".$content['title']."</h2>";
                    print "<p>".$content['bodytext']."</p>";
                ?>
                <form method="POST" action="boeken.php">
                    <input type="submit" value="Boeken" class="btn btn-raised btn-primary">
                </form>
              </div>
            </div>
            </div>
            <?php include 'footer.php'; ?>
        </div>
    </body>
</html>
