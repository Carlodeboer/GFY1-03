
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
              <input type="submit" name="submit"value="Login">
    </form>


<?php
session_start();
    if(isset($_POST['submit'])){
        $errMsg = '';
        //username and password sent from Form
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);
        
        if($username == '')
            $errMsg .= 'You must enter your Username<br>';
        
        if($password == '')
            $errMsg .= 'You must enter your Password<br>';
        
        
        if($errMsg == ''){
            $records = $pdo->prepare('SELECT id,username,password FROM  users WHERE username = :username');
            $records->bindParam(':username', $username);
            $records->execute();
            $results = $records->fetch(PDO::FETCH_ASSOC);
            if(count($results) > 0 && password_verify($password, $results['password'])){
                $_SESSION['username'] = $results['username'];
                header('location:index.php');
                exit;
            }else{
                $errMsg .= 'Username and Password are not found<br>';
            }
        }
                        if(isset($errMsg)){
                    print($errMsg);
                }
    }
 



            


?>







    </body>
</html>

