<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
  <?php include '../head.php';?>
</head>
    <body>
        <div id="container">
          <?php
                include '../header.php';
            ?>
            <div id="content">
                <?php
                    // Controleert of de gebruiker als admin is aangemeld
                    if (isset($_SESSION['admin_session'])) {
                        define("adminToegang", true);
                        //include '../functions.php';
                        $succes = false;
                        // Controleert of een pagina geupdate moet worden
                        if(isset($_POST['verzenden'])){
                            $succes = editContent($_SESSION['paginaEdit'],$_SESSION['taalEdit'],$_POST['titel'],$_POST['inhoud'],$_SESSION['admin_session']);
                            print "<p>toegevoegd!</p>";
                            unset($_SESSION['paginaEdit']);
                            unset($_SESSION['taalEdit']);
                        }
                        include 'adminindex.php';
                        // Controleert of de gebruiker heeft aangegeven wat hij wil beheren
                        // zo ja, dan wordt de bijbehorende pagina geladen
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
                            } elseif ($_GET['beheer'] == "nieuws"){
                                include $_SERVER['DOCUMENT_ROOT'].'/GFY1-03/admin/nieuws.php';
                            } elseif ($_GET['beheer'] == "nieuwsbewerken"){
                                include $_SERVER['DOCUMENT_ROOT'].'/GFY1-03/admin/nieuwsbewerken.php';
                            }
                        }
                        // Controleert of de gebruiker in 'contentbeheer' een pagina heeft geselecteerd
                        // die hij wil bewerken. Zo ja, dan wordt de bijbehorende pagina geladen en kan
                        // hij hem bewerken
                        if (isset($_SESSION['beheer']) && isset($_GET['selecteerContent'])) {
                            $_SESSION['paginaEdit'] = $_GET['pagina'];
                            $_SESSION['taalEdit'] = $_GET['taal'];
                            $content = laadContent($_SESSION['paginaEdit'], $_SESSION['taalEdit']);
                            include $_SERVER['DOCUMENT_ROOT'].'/GFY1-03/admin/moetnogeennaamverzinnen.php';
                        }
                        // Controleert of de gebruiker in 'berichtopvraagsubmit' een email-adres heeft
                        // geselecteerd die hij wil bewerken. Zo ja, dan worden de bijbehorende
                        // berichten geladen.
                        elseif (isset($_SESSION['beheer']) && isset($_POST['zoekBerichten'])) {
                            print "test";
                            $_SESSION['email'] = $_POST['email'];
                            include $_SERVER['DOCUMENT_ROOT'].'/GFY1-03/admin/berichtopvraag.php';
                        }
                    }
                    // Als de gebruiker niet als admin is aangemeld, krijgt hij dit bericht te zien
                    else {
                        print 'DAS IST VERBOTEN';
                    }
                  ?>
            </div>
            <?php include '../footer.php';?>
        </div>
    </body>
</html>
