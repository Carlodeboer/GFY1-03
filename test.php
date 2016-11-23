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
        <?php print phpversion(); ?>
        <form method="post">
            <h2>Registreren</h2>
            Gebruikersnaam: <input type="text" name="username"><br>
            Wachtwoord: <input type="password" name="password1"><br>
            Bevestig wachtwoord: <input type="password" name="password2"><br>
            <input type="submit" name="register" value="Register">
        </form>

        <?php
        //foutmeldingen voorkomen wanneer fomulier nog niet is ingevuld bij het laden van de pagina
        if (isset($_POST['register'])) {
            $username = $_POST['username'];
            $password1 = $_POST['password1'];
            $password2 = $_POST['password2'];
            //wachtwoord hashen
            $passwordhash = password_hash($password1, PASSWORD_DEFAULT);
            //kijken of gebruiker aan alle voorwaarden voordoet voordat nieuwe gebruiker aangemaakt wordt.
            if ($username == "") {
                print("Vul een gebruikersnaam in.");
            } else if ($password1 == "") {
                print("Vul een wachtwoord in.");
            } else if ($password1 != $password2) {
                print("Beide wachtwoorden moeten gelijk zijn.");
            } else {
                //kijken of ingevoerde gebruiker in de database voorkomt. Als er een value groter dan 0 uitkomt, staat deze naam al in de database.
                $stmt = $pdo->prepare("SELECT gebruikersnaam FROM gebruikers WHERE gebruikersnaam=?");
                $stmt->execute(array($username));
                $res = $stmt->rowCount();
                if ($res != 0) {
                    print("De gebruikersnaam bestaat al.");
                } else {
                    // als aan alle voorwaarden wordt voldaan kan de gebruiker in de database worden toegevoegd
                    $stmt = $pdo->prepare("INSERT INTO gebruikers (gebruikersnaam,wachtwoord,privilegeniveau) VALUES (?,?,3)");
                    $stmt->execute(array($username, $passwordhash));
                    $res = $stmt->rowCount();
                    if ($res > 0) {
                        //feedback aan gebruiker geven
                        print("De user " . $username . " is toegevoegd.");
                        // $userRow=$stmt->fetch(PDO::FETCH_ASSOC);
                    }
                }
            }
        }
//!!checken of user al in database bestaat
//hash gebruiken
//wachtwoordveld 60 characters!
        ?>
    </body>
</html>
