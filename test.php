<!DOCTYPE html>
<html>
<head>
        <title>Motorcross</title>
        <?php include 'head.php';?>

</head>
    <body>
        <div id="container">
          <?php include 'header.php';?>

          <div id="content">
              <h2> Berichten opvragen </h2>

              <form action="berichtopvraag.php" method="post">
              E-mail: <input type="text" name="email"><br>
              <input type="submit">
              </form>
          </div>

          <?php include 'footer.php';?>

        </div>
    </body>
</html>
