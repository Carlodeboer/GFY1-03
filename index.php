<!DOCTYPE html>
<html>
<head>
  <?php include 'head.php';?>
        <title>Motorcross</title>
        <meta charset="UTF-8">
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
                include "dbconnect.php";
                    // include "functions.php";
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

}





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

    print($nummer['getal'] . " artikelen.");

    $nummer = $nummer['getal'];


$x=0;
$nieuwearray = array_reverse($nieuwearray);

    for ($i=0; $i < $nummer; $i++) {
$x++;
        laadNieuws($nieuwearray[$x-1],$lang);

    }

            ?>
            </div>
             </div>
            </div>
            <?php include 'footer.php';?>
        </div>
    </body>
</html>
