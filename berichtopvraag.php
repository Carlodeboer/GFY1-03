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
             <?php


             include 'dbconnect.php';


             //idbericht, voornaam, achternaam, email, telefoonnummer, onderwerp, bericht, datum
             //$berichten = $pdo->prepare("SELECT * FROM contactformulier WHERE email = $_POST['email']");
             //$result = mysql_query($berichten);
             if (isset($_POST["email"])&&$_POST["email"]!="") {
               $email = $_POST['email'];
               if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                 print($emailErr = "Invalid email format, <a href=\"test.php\">retry</a>");
               }


             $stmt = $pdo->prepare("SELECT * FROM contactformulier WHERE email=?");
             $stmt->execute(array($email));


             while ($row = $stmt->fetch()){
               $voornaam = $row["voornaam"];
               $achternaam = $row["achternaam"];
               $email = $row["email"];
               $telefoonnummer = $row["telefoonnummer"];
               $onderwerp = $row["onderwerp"];
               $bericht = $row["bericht"];
               $datum = $row["datum"];

               if $telefoonnummer != ""{

              echo("<strong>Berichten:</strong> <br> $voornaam  $achternaam <br> $email <br> $telefoonnummer <br> $datum <br> <strong>$onderwerp</strong> <br> $bericht<br> <br>");

            }
            else {
              echo("<strong>Berichten:</strong> <br> $voornaam  $achternaam <br> $email <br> $datum <br> <strong>$onderwerp</strong> <br> $bericht<br> <br>");

            }
            }
          }

            ?>








          </div>

          <?php include 'footer.php';?>

        </div>
    </body>
</html>
