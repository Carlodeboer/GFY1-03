<?php
include "dbconnect.php";
?>
<html>
    <head>
        <title>TODO supply a title</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <form method="post">
            <h2>Inloggen</h2>
            Gebruikersnaam: <input type="text" name="username"><br>
            Wachtwoord: <input type="password" name="password"><br><br>
            <input type="submit" name="submit" value="Login">
        </form>
        <?php
        session_start();
        // Hiermee kun je passwords hashen
        // echo password_hash("123456", PASSWORD_DEFAULT)."\n";
        // voorkomen van foutmelding indien er nog geen username en wachtwoord is ingevoerd bij het laden van de pagina
        if (isset($_POST['username'])) {
            $username = $_POST["username"];
            $password = $_POST["password"];
        // feedback geven wanneer er geen gegevens zijn ingevoerd
            if ($username == "") {
                print("Vul een gebruikersnaam in<br><br>");
            } elseif ($password == "") {
                print("Vul een wachtwoord in<br><br>");
            } else {
                $stmt = $pdo->prepare("SELECT * FROM users WHERE username=:uname");
                $stmt->execute(array(':uname' => $username));
                $userRow = $stmt->fetch(PDO::FETCH_ASSOC);
                if (password_verify($password, $userRow['password'])) {
                    $_SESSION['user_session'] = $userRow['username'];
                } else {
                    print("Wachtwoord of inlognaam onjuist. <br><br>");
                }
            }
        }

        if (isset($_SESSION['user_session'])) {
            echo 'Welcome ' . $_SESSION['user_session'];
            echo '<br><a href="index.php">Return to homepage</a>';
        } else {
            print("Log eerst in of <a href=\"registerscript.php\">registreer</a>");
        }

        if (isset($_SESSION['user_session'])) {
            print("<br><br><a href=\"logout.php?logout\">Sign Out</a>");
        }
        ?>
    </body>
</html>
