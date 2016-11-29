<!DOCTYPE html>
<html>
<head>
  <?php include 'head.php';?>
        <title>Motorcross</title>
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
          <?php
                include 'header.php';
            ?>
            <div id="content">
                <?php
                      include 'functions.php';
                      session_start();



                    //   $test = checkLogin($_POST['naam'], $_POST['wachtwoord']);
                    //   print_r($test);
                    //   if ($test['klopt']) {
                    //       print "ja";
                    //   }
                    //   else {
                    //       print "nee";
                    //   }
                    if (isset($_SESSION['user_session'])) {
                        include 'moetnogeennaamverzinnen.php';
                    }
                    else {
                        print 'DAS IST VERBOTEN';
                    }

                  ?>
            </div>
            <?php include 'footer.php';?>
        </div>
    </body>
</html>
