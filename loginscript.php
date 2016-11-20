
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
    <h2>Login</h2>
    Username: <input type="text" name="username"><br>
    Password: <input type="password" name="password"><br><br>
              <input type="submit" name="submit" value="Login">
    </form>


<?php
    session_start();

//  Hiermee kun je passwords hashen 
// echo password_hash("123456", PASSWORD_DEFAULT)."\n";


if(isset($_POST['username'])) {
$username = $_POST["username"];
$password = $_POST["password"];


$stmt = $pdo->prepare("SELECT * FROM users WHERE username=:uname");
$stmt->execute(array(':uname'=>$username));
          $userRow=$stmt->fetch(PDO::FETCH_ASSOC);

if(password_verify($password,$userRow['password'])){
        $_SESSION['user_session'] = $userRow['username'];
} else {
    print("Wachtwoord of inlognaam onjuist.");
}

}

if(isset($_SESSION['user_session'])){
    echo 'Welcome '.$_SESSION['user_session'];
} else {
    print("Log eerst in.");
}
if(isset($_SESSION['user_session'])){
print("<br><br><a href=\"logout.php?logout\">Sign Out</a>");
}

?>
<br>
<br>



    </body>
</html>

