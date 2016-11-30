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
                    session_start();
                    $succes = false;
                    if(isset($_POST['verzenden'])){
                        $succes = toevoegenContent($_POST['titel'],$_POST['pagina'],$_POST['taal'],$_POST['inhoud'],$_SESSION['admin_session']);
                    }
                    if (isset($_SESSION['admin_session'])) {
                        include 'adminindex.php';
                        if (isset($_GET['beheer'])){
                            if ($_GET['beheer'] == "content"){
                                include $_SERVER['DOCUMENT_ROOT'].'/GFY1-03/admin/moetnogeennaamverzinnen.php';
                            } elseif ($_GET['beheer'] == "agenda"){
                                include $_SERVER['DOCUMENT_ROOT'].'/GFY1-03/beheeragenda.php';
                            } elseif ($_GET['beheer'] == "afbeelding"){
                                include $_SERVER['DOCUMENT_ROOT'].'/GFY1-03/imageupload.php';
                            }
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
