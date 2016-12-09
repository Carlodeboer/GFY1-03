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
                    //include '../functions.php';
                    if (isset($_SESSION['admin_session'])) {
                        header("Location: beheerpaneel.php");
                    } elseif (isset($_POST['naam'])) {
                        $check = checkLogin($_POST['naam'], $_POST['wachtwoord']);
                        if ($check['klopt']) {
                            if (checkPrivileges($_POST['naam']) >= 2) {
                                $_SESSION['admin_session'] = $_POST['naam'];
                                header("Location: beheerpaneel.php");
                                exit;
                            } else {
                                print "Deze gebruikers heeft niet voldoende privileges.";
                            }
                        } else {
                            include 'loginformulier.php';
                            print "<h1>" . $check['foutmelding'] . "</h1>";
                        }
                    } else {
                        include 'loginformulier.php';
                    }
                    ?></div> </div> <?php include '../footer.php'; ?>

        </div>
    </body>
</html>
