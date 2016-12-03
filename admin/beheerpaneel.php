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
            ?>
            <div id="content">
                <?php
                    include '../functions.php';
                    $succes = false;
                    if(isset($_POST['verzenden'])){
                        $succes = editContent($_SESSION['paginaEdit'],$_SESSION['taalEdit'],$_POST['titel'],$_POST['inhoud'],$_SESSION['admin_session']);
                        print "<p>toegevoegd!</p>";
                        unset($_SESSION['paginaEdit']);
                        unset($_SESSION['taalEdit']);
                    }
                    if (isset($_SESSION['admin_session'])) {
                        include 'adminindex.php';
                        if (isset($_GET['beheer'])){
                            $_SESSION['beheer'] = $_GET['beheer'];
                            if ($_GET['beheer'] == "content"){
                                include $_SERVER['DOCUMENT_ROOT'].'/GFY1-03/admin/contentbeheer.php';
                            } elseif ($_GET['beheer'] == "agenda"){
                                include $_SERVER['DOCUMENT_ROOT'].'/GFY1-03/beheeragenda.php';
                            } elseif ($_GET['beheer'] == "afbeelding"){
                                include $_SERVER['DOCUMENT_ROOT'].'/GFY1-03/imageupload.php';
                            } elseif ($_GET['beheer'] == "berichtopvraag"){
                                include $_SERVER['DOCUMENT_ROOT'].'/GFY1-03/admin/berichtopvraagsubmit.php';
                            }
                        } elseif (isset($_SESSION['beheer']) && isset($_GET['selecteer'])) {
                            $_SESSION['paginaEdit'] = $_GET['pagina'];
                            $_SESSION['taalEdit'] = $_GET['taal'];
                            $content = laadContent($_SESSION['paginaEdit'], $_SESSION['taalEdit']);
                            include $_SERVER['DOCUMENT_ROOT'].'/GFY1-03/admin/moetnogeennaamverzinnen.php';
                        }
                    }
                    else {
                        print 'DAS IST VERBOTEN';
                    }
                  ?>
            </div>
            <?php include '../footer.php';?>
        </div>
    </body>
</html>
