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
<html>
<head>
     <title>Berichtgegevens</title>
</head>
<body>
     <div id="container">
          <div id="contentwrapper">
               <?php
               if (isset($_GET['berichtID'])) {
                    $berichtID = $_GET['berichtID']; //maakt een variabele van het ID van de klant

                    $pdo = newPDO();
                    $stmt1 =  $pdo->prepare("SELECT idbericht, gelezen
                    FROM contactformulier
                    WHERE idbericht = ?");
                    $stmt1->execute(array($berichtID));
                    $row1 = $stmt1->fetch();
                    $idbericht = $row1["idbericht"];
                    $gelezen = $row1["gelezen"];

                    if (isset($_GET["is-gelezen"])) {
                         $stmt2 = $pdo -> prepare("UPDATE contactformulier
                         SET gelezen = 1
                         WHERE idbericht = ?");
                         $stmt2->execute(array($berichtID));
                         ?>
                         <script>
                         function popUpBevestigd() {
                              $("#bevestigd").snackbar("show");
                         }
                         </script>
                         <span data-toggle=snackbar id="bevestigd" data-content="Dit bericht is gemarkeerd als gelezen."></span>
                         <script>window.onload = popUpBevestigd;</script>
                         <?php
                    }

                    if (isset($_GET["is-niet-gelezen"])) {
                         $stmt3 = $pdo -> prepare("UPDATE contactformulier
                         SET gelezen = 0
                         WHERE idbericht = ?");
                         $stmt3->execute(array($berichtID));
                         ?>
                         <script>
                         function popUpBevestigd() {
                              $("#bevestigd").snackbar("show");
                         }
                         </script>
                         <span data-toggle=snackbar id="bevestigd" data-content="Dit bericht is gemarkeerd als ongelezen."></span>
                         <script>window.onload = popUpBevestigd;</script>
                         <?php
                    }

                    $stmt4 = $pdo->prepare("SELECT idbericht, voornaam, achternaam, email, telefoonnummer, datum, onderwerp, bericht, gelezen
                         FROM contactformulier
                         WHERE idbericht = ?"); //haalt de gegevens uit de database
                         $stmt4->execute(array($berichtID));
                         $row4 = $stmt4->fetch();

                         $idbericht = $row4["idbericht"];
                         $voornaam = $row4["voornaam"];
                         $achternaam = $row4["achternaam"];
                         $email = $row4["email"];
                         $telnr = $row4["telefoonnummer"];
                         $datum = $row4["datum"];
                         $onderwerp = $row4["onderwerp"];
                         $bericht = $row4["bericht"];
                         $gelezen = $row4["gelezen"]; //maakt variabelen van de gegevens uit de database

                         ?>
                         <div id="centercontent">
                              <div id="reisgegevens">
                                   <h2>Bericht van <?php print($voornaam . " " . $achternaam); ?>:</h2>
                                   <table>
                                        <!-- in deze tabel komen de reisgegevens te staan -->
                                        <tr>
                                             <td><?php print($voornaam . " " . $achternaam); ?></td>
                                        </tr><tr>
                                             <td><?php print($email); ?></td>
                                        </tr><tr>
                                             <td><?php print($telnr); ?></td>
                                        </tr><tr>
                                             <td><?php print ($datum) ?></td>
                                        </tr><tr>
                                             <td><?php print("<br>"); ?></td>
                                        </tr><tr>
                                             <td><?php print ("<b>" . $onderwerp . "</b>") ?></td>
                                        </tr><tr>
                                             <td><?php print ($bericht) ?></td>
                                        </tr>
                                   </table>

                                   <form method='GET' action='beheerpaneel.php'>
                                        <input type='hidden' name='beheer' value='Berichten'>
                                        <input type='hidden' name='berichtID' value="<?php print($berichtID);?>">
                                        <?php
                                        if (!$gelezen) {
                                             print("<input type='submit' name='is-gelezen' value='Markeren als gelezen' class='btn btn-raised btn-primary'>");
                                             //als de boeking nog niet bevestigd is, is er een knop waarmee de boeking wel wordt bevestigd
                                        } else {
                                             print("<input type='submit' name='is-niet-gelezen' value='Markeren als ongelezen' class='btn btn-raised btn-primary'>");
                                             //als de boeking al bevestigd is, is er een knop waarmee de bevestiging ongedaan gemaakt kan worden
                                        }
                                        ?>
                                   </form>


                              </div>
                         </div>
                         <?php
                         $pdo = NULL;
                    }
                    ?>
               </div>
          </div>

     </body>
     </html>
