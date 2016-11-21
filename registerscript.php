
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
    <h2>Register</h2>
    Username: <input type="text" name="username"><br>
    Email: <input type="text" name="email"><br>    
    Password: <input type="password" name="password1"><br>
    Verify password: <input type="password" name="password2"><br>
              <input type="submit" name="register" value="Register">
    </form>

    <?php




if(isset($_POST['register'])){
$username = $_POST['username'];
$password1 = $_POST['password1'];
$password2 = $_POST['password2'];
$email = $_POST['email'];
$passwordhash = password_hash($password1, PASSWORD_DEFAULT)."\n";



if($username == ""){
    print("Vul een gebruikersnaam in.");
}
else if ($password1 == "") {
    print("Vul een wachtwoord in.");
}
else if($password1 != $password2) {
    print("Beide wachtwoorden moeten gelijk zijn.");
} 
else if($email == "") {
    print("Vul een emailadres in.");
}
else if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    print("Vul een valide emailadres in.");
}
    else {
$stmt = $pdo->prepare("SELECT username FROM users WHERE username=?");
$stmt->execute(array($username));
$res = $stmt->rowCount();
if($res != 0) {
    print("De gebruikersnaam bestaat al.");
} else {


      $stmt = $pdo->prepare("INSERT INTO users (username,email,password) VALUES (?,?,?)");
  $stmt->execute(array($username,$email,$passwordhash));
$res = $stmt->rowCount();
if($res > 0) {

print("De user " . $username ." is toegevoegd.");

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

