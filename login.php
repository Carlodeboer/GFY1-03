<!DOCTYPE html>
<html>
<head>
  <title>Motorcross</title>
  <link type="text/css" rel="stylesheet" href="style.css">
</head>
<body>
  <div id="container">
      <nav>
        <div id="banner">
          <h2> header </h2>
        </div>
        <ul>
          <a href="index.php"><li>Home</li></a>
          <a href="informatie.php"><li>Informatie</li></a>
          <a href="boeken.php"><li>Boeken</li></a>
          <a href="contact.php"><li>Contact</li></a>
          <a href="login.php"><li>Login</li></a>
        </ul>
      </nav>

      <div id="content">
        <h2> content </h2>
          <?php include 'loginscript.php' ?>

      </div>



      <footer>
        <h2> footer </h2>
      </footer>
  </div>


</body>
</html>
