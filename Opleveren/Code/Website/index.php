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
  <?php include 'head.php';?>
        <title>Motorcross</title>
</head>
    <body>
        <div id="container">
          <?php include 'header.php';?>
            <div id="content">
              <div id="contentwrapper">
                <?php
                $pdo = newPDO();
                // Vraagt de pagina-inhoud met de juiste taal op via de functie
                // laadContent en print dit vervolgens op de pagina.
                $content = laadContent("","");
                print "<h2>".$content['title']."</h2>";
                print "<p>".$content['bodytext']."</p>";
                ?>
                <div id="nieuws">
                    <?php
                        $lang = selecteerTaal();
                        $labels = nieuwsTaal();
                        $stmt = $pdo->prepare("SELECT id FROM nieuwsbericht WHERE lang=?");
                        $stmt->execute(array($lang));

                        $results = array();
                        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

                        $nieuwearray = array();
                        foreach($results as $item) {
                            $nieuwearray[] = $item['id'];
                        }

                        $stmt = $pdo->prepare("SELECT id, COUNT(lang) AS getal FROM nieuwsbericht WHERE lang=? ORDER BY lang");
                        $stmt->execute(array($lang));

                        $nummer = $stmt->fetch();
                        $id = $nummer['id'];

                        print($nummer['getal'] . $labels[0]);

                        $nummer = $nummer['getal'];

                        $x=0;
                        $nieuwearray = array_reverse($nieuwearray);
                        for ($i=0; $i < $nummer; $i++) {
                            $x++;
                            laadNieuws($nieuwearray[$x-1]);
                        }
                        ?>
                    </div>
                </div>
            </div>
            <?php include 'footer.php';?>
        </div>
    </body>
</html>
