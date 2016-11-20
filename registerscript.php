
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
if(isset($_POST['username'])){
$username = $_POST['username'];
$password1 = $_POST['password1'];
$password2 = $_POST['password2'];
$email = $_POST['email'];
}

if(isset($_POST['password1'])){
if($password1 != $password2) {
    print("Passwords must be equal");
}
}



if(isset($_POST['password1'])) {
    $newpass = password_hash($_POST['password1'], PASSWORD_DEFAULT);
}


// print($newpass);

    ?>






    </body>
</html>

