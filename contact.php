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
<div class="row">
<div class="col-md-6">
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

                <div class="col-md-2">
                </div>


<div class="col-md-4">
    <div id="googlemaps">
      <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2428.853044415557!2d6.079371215736348!3d52.49989967981054!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47c7ded4f4f95b31%3A0xb1a2f2cf9bba075!2sCampus+1%2C+8017+Zwolle!5e0!3m2!1snl!2snl!4v1481550637316"
      width="400" height="300" frameborder="0" style="border:0" allowfullscreen></iframe>
    </div>
    </div>
  </div>

                </div>
              </div>
          </div>
          <?php include 'footer.php';?>
        </div>
    </body>
</html>
