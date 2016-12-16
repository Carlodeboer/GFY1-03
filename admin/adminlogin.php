<?php define("toegang", true); ?>
<!DOCTYPE html>
<html>
    <head>
        <?php include '../head.php'; ?>
    </head>
    <body>
        <div id="container">
            <div id="content">
                <div id="contentwrapper">
                    <?php
                    include '../header.php';
                    // Controleert of de gebruiker al is ingelogd als admin. Zo ja,
                    // dan wordt de gebruiker meteen doorverwezen naar het beheerpaneel.
                    if (isset($_SESSION['admin_session'])) {
                        header("Location: beheerpaneel.php");
                    // Zo niet, dan wordt gecontroleert of de gebruiker het inlogformulier
                    // heeft ingevuld. Zo ja, dan wordt gecontroleerd of de gegevens
                    // correct zijn ingevuld.
                    } elseif (isset($_POST['naam'])) {
                        $check = checkLogin($_POST['naam'], $_POST['wachtwoord']);
                        // Als dat het geval is, dan wordt gecontroleerd of het account
                        // ook de juiste rechten heeft om aan te melden als admin.
                        // Zo ja, dan logt de gebruiker in en wordt doorverwezen
                        // naar het beheerpaneel.
                        if ($check['klopt']) {
                            if (checkPrivileges($_POST['naam']) >= 2) {
                                $_SESSION['admin_session'] = $_POST['naam'];
                                header("Location: beheerpaneel.php");
                                exit;
                            // Als het acount niet de juiste rechten heeft, dan krijgt
                            // de gebruiker een foutmelding te zien.
                            } else {
                                include 'loginformulier.php';
                                print "<h1>Deze gebruikers heeft niet voldoende privileges.</h1>";
                            }
                        // Als de gebruiker niet de juiste inloggegevens heeft ingevuld,
                        // dan krijgt hij/zij een passende foutmelding te zien.
                        } else {
                            include 'loginformulier.php';
                            print "<h1>" . $check['foutmelding'] . "</h1>";
                        }
                    } else {
                        include 'loginformulier.php';
                    }
                    ?>
                </div>
            </div>
            <?php include '../footer.php'; ?>
        </div>
    </body>
</html>
