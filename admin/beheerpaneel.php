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
<?php
define("toegang", true); // In het bestand toegang.php wordt toegelicht wat dit doet
?>
<!DOCTYPE html>
<html>
<head>
     <title>Beheerpaneel</title>
     <?php include '../head.php';?>
</head>
<body>
     <div id="container">
          <?php include '../header.php'; ?>
          <div id="content">
               <?php
               // Controleert of de gebruiker als admin is aangemeld
               if (isset($_SESSION['admin_session'])) {
                    $succes = false;
                    // Controleert of een pagina geupdate moet worden
                    if(isset($_POST['verzenden'])){
                         $succes = editContent($_SESSION['paginaEdit'],$_SESSION['taalEdit'],$_POST['titel'],$_POST['inhoud'],$_SESSION['admin_session']);
                         ?>
                         <script>
                         function popUpBevestigd() {
                              $("#bevestigd").snackbar("show");
                         }
                         </script>
                         <span data-toggle=snackbar id="bevestigd" data-content="De pagina <?php print($_SESSION['paginaEdit']); ?> is bewerkt."></span>
                         <script>window.onload = popUpBevestigd;</script>
                         <?php
                         unset($_SESSION['paginaEdit']);
                         unset($_SESSION['taalEdit']);
                    }
                    elseif(isset($_POST['nieuwaccount'])){
                         $succes = nieuwAccount($_POST['naam'], $_POST['wachtwoord'], $_POST['wachtwoord2']);
                         //print "<p>{$succes[1]}</p>";
                    }
                    include 'adminindex.php';
                    // Controleert of de gebruiker heeft aangegeven wat hij wil beheren
                    // zo ja, dan wordt de bijbehorende pagina geladen
                    if (isset($_GET['beheer'])){
                         $_SESSION['beheer'] = $_GET['beheer'];
                         switch ($_GET['beheer']){
                              case "Content":
                                include $_SERVER['DOCUMENT_ROOT'].'/GFY1-03/admin/contentbeheer.php';
                                break;
                              case "Nieuws":
                                include $_SERVER['DOCUMENT_ROOT'].'/GFY1-03/admin/nieuws.php';
                                break;
                              case "Agenda":
                                include $_SERVER['DOCUMENT_ROOT'].'/GFY1-03/admin/beheeragenda.php';
                                break;
                              case "Boekingen":
                                include $_SERVER['DOCUMENT_ROOT'].'/GFY1-03/admin/boekopvraag.php';
                                break;
                              case "Boekingenopvragen":
                                include $_SERVER['DOCUMENT_ROOT'].'/GFY1-03/admin/boekopvraagscript.php';
                                break;
                              case "Afbeelding":
                                include $_SERVER['DOCUMENT_ROOT'].'/GFY1-03/admin/uploadform.php';
                                break;
                              case "Berichten opvragen":
                                include $_SERVER['DOCUMENT_ROOT'].'/GFY1-03/admin/berichtopvraagsubmit.php';
                                break;
                              case "Nieuwsbewerken":
                                include $_SERVER['DOCUMENT_ROOT'].'/GFY1-03/admin/nieuwsbewerken.php';
                                break;
                              case "Nieuw account":
                                include $_SERVER['DOCUMENT_ROOT'].'/GFY1-03/admin/nieuwaccount.php';
                                break;
                              case "Instellingen":
                                include $_SERVER['DOCUMENT_ROOT'].'/GFY1-03/admin/instellingen.php';
                                break;
                         }
                    }
                    // Controleert of de gebruiker in 'contentbeheer' een pagina heeft geselecteerd
                    // die hij wil bewerken. Zo ja, dan wordt de bijbehorende pagina geladen en kan
                    // hij hem bewerken
                    if (isset($_SESSION['beheer']) && isset($_GET['selecteerContent'])) {
                         $_SESSION['paginaEdit'] = $_GET['pagina'];
                         $_SESSION['taalEdit'] = $_GET['taal'];
                         $content = laadContent($_SESSION['paginaEdit'], $_SESSION['taalEdit'], true);
                         include $_SERVER['DOCUMENT_ROOT'].'/GFY1-03/admin/contentformulier.php';
                    }
                    // Controleert of de gebruiker in 'berichtopvraagsubmit' een email-adres heeft
                    // geselecteerd die hij wil bewerken. Zo ja, dan worden de bijbehorende
                    // berichten geladen.
                    elseif (isset($_SESSION['beheer']) && isset($_POST['zoekBerichten'])) {
                         $_SESSION['email'] = $_POST['email'];
                         include $_SERVER['DOCUMENT_ROOT'].'/GFY1-03/admin/berichtopvraag.php';
                    }
               }
               // Als de gebruiker niet als admin is aangemeld, krijgt hij dit bericht te zien
               else {
                    header('Location: ../403.php');
               }
               ?>
          </div>
          <?php include '../footer.php';?>
     </div>
</body>
</html>
