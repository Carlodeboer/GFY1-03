<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
  <?php include '../head.php';?>
        <title>Motorcross</title>
        <link type="text/css" rel="stylesheet" href="../style/style.css">
        <link type="text/css" rel="stylesheet" href="../style/responsiveslides.css">
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
        <script src="../js/responsiveslides.js"></script>
        <script>
          $(function() {
            $(".rslides").responsiveSlides();
          });
        </script>
</head>
    <body>
        <div id="container">
          <?php
                include '../header.php';
                include '../functions.php';
                if (isset($_SESSION['admin_session'])){
                    header("Location: beheerpaneel.php");
                } elseif (isset($_POST['naam'])) {
                    $check = checkLogin($_POST['naam'], $_POST['wachtwoord']);
                    if ($check['klopt']){
                        if (checkPrivileges($_POST['naam']) >= 2) {
                            $_SESSION['admin_session'] = $_POST['naam'];
                            header("Location: beheerpaneel.php");
                            exit;
                        } else {
                            print "Deze gebruikers heeft niet voldoende privileges.";
                        }
                    } else {
                        include 'loginformulier.php';
                        print "<h1>".$check['foutmelding']."</h1>";
                    }
                } else {
                    include 'loginformulier.php';
                }
            include '../footer.php';?>
        </div>
    </body>
</html>
