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
             $opgevraagd = $_POST['email'];
          /*   // voorbereiden
             $opvraag = $pdo->prepare("SELECT * FROM contactformulier WHERE email=?");
             $opvraag->execute($opgevraagd);
 // uitvoeren
              print("<ul>");
              while ($row = $opvraag->fetch()){
                $idbericht    = $row["idbericht"];
                $voornaam = $row["voornaam"];
                $achternaam = $row["achternaam"];
                $email = $row["email"];
                $telefoonnummer = $row["telefoonnummer"];
                $onderwerp = $row["onderwerp"];
                $bericht = $row["bericht"];
                $datum = $row["datum"];




                print("<li>" . $voornaam . "  " . $achternaam . "</li>");
              }
              print("</ul>");
 
*/
$sql = "SELECT * FROM contactformulier WHERE email =$opgevraagd";
$result = $pdo->query($sql);

if ($result->num_rows > 0) {
     // output data of each row
     while($row = $result->fetch_assoc()) {
         echo "<br> id: ". $row["idbericht"]. " - Name: ". $row["voornaam"]. " " . $row["achternaam"] . "<br>";
     }
} else {
     echo "0 results";
}

$pdo = NULL;

?>

            ?>






          </div>

          <?php include 'footer.php';?>

        </div>
    </body>
</html>
