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
            if (isset($_GET['lang'])){
                $_SESSION['lang'] = $_GET['lang'];
                $taal = $_SESSION['lang'];
            } elseif (isset($_SESSION['lang'])){
                $taal = $_SESSION['lang'];
            } else {
                $taal = "NLD";
          }

            if ($taal == "NLD"){
              include 'ContactNL.php';
            }
            if ($taal == "DEU"){
              include 'ContactDU.php';
            }
            elseif($taal == "ENG"){
              include 'ContactEN.php';
            }


                ?>
              </div>
          </div>
          <?php include 'footer.php';?>
        </div>
    </body>
</html>
