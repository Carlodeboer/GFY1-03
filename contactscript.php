<?php define("toegang", true); ?>
<html>
<head>
     <title>Motocross</title>
     <?php include 'head.php';?>
</head>
<body>
     <div id="container">
          <?php include 'header.php';?>


          <div id="content">
               <?php

               if(isset($_POST['email'])) {



                    // hier word de ontvanger vastegesteld en het onderwerp (bijv info@offroadcompassportgual.nl)


                    $email_to = "thijs.marschalk@gmail.com";

                    $email_subject = "Bericht verstuurd via contactformulier";





                    function died($error) {


                         echo "<br> We are very sorry, but there were error(s) found with the form you submitted. ";

                         echo "These errors appear below.<br /><br />";

                         echo $error."<br /><br />";

                         echo "Please go back and fix these errors.<br /><br />";

                         die();

                    }



                    // checkt of er werkelijk wat ingevuld is, zoniet dan -> died

                    if(!isset($_POST['first_name']) ||

                    !isset($_POST['last_name']) ||

                    !isset($_POST['subject']) ||

                    !isset($_POST['email']) ||

                    !isset($_POST['telephone']) ||

                    !isset($_POST['comments'])) {

                         died('We are sorry, but there appears to be a problem with the form you submitted.');

                    }


                    //zet de gegevens uit post in $.... weg.

                    $first_name = $_POST['first_name']; // required

                    $last_name = $_POST['last_name']; // required

                    $subject = $_POST['subject']; // required

                    $email_from = $_POST['email']; // required

                    $telephone = $_POST['telephone']; // not required

                    $comments = $_POST['comments']; // required


                    $error_message = "";

                    //checkt of de ingevulde email, naam, achternaam en onderwerp voldoen aan de eisen gesteld in $email_exp (komen de variabelen overeen?)
                    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';

                    if(!preg_match($email_exp,$email_from)) {

                         $error_message .= 'The Email Address you entered does not appear to be valid.<br />';

                    }

                    $string_exp = "/^[A-Za-z .'-]+$/";

                    if(!preg_match($string_exp,$first_name)) {

                         $error_message .= 'The First Name you entered does not appear to be valid.<br />';

                    }

                    if(!preg_match($string_exp,$last_name)) {

                         $error_message .= 'The Last Name you entered does not appear to be valid.<br />';

                    }

                    if(!preg_match($string_exp,$subject)) {

                         $error_message .= 'The Subject you entered does not appear to be valid.<br />';

                    }

                    //checkt of er minimaal 2 tekens in de comments zijn geplaatst
                    if(strlen($comments) < 2) {

                         $error_message .= 'The Comments you entered do not appear to be valid.<br />';

                    }

                    if(strlen($error_message) > 0) {

                         died($error_message);

                    }

                    $email_message = "Formuliergegevens hieronder.\n\n";



                    function clean_string($string) {

                         $bad = array("content-type","bcc:","to:","cc:","href");

                         return str_replace($bad,"",$string);

                    }



                    $email_message .= "Voornaam: ".clean_string($first_name)."\n";

                    $email_message .= "Achternaam: ".clean_string($last_name)."\n";

                    $email_message .= "Email: ".clean_string($email_from)."\n";

                    $email_message .= "Telefoonnummer: ".clean_string($telephone)."\n";

                    $email_message .= "Bericht: ".clean_string($comments)."\n";





                    // email headers maken

                    $headers = 'From: '.$email_from."\r\n".

                    'Reply-To: '.$email_from."\r\n" .

                    'X-Mailer: PHP/' . phpversion();

                    //versturen van de mail
                    @mail($email_to, $email_subject, $email_message, $headers);

                    $pdo=newPDO();
                    //idbericht, voornaam, achternaam, email, telefoonnummer, onderwerp, bericht, datum  TOEVOEGEN AAN CONTACTFORMULIER DATABASE TABEL
                    $stmt = $pdo->prepare("INSERT INTO contactformulier (voornaam, achternaam, email, telefoonnummer, onderwerp, bericht, datum) VALUES (?, ?, ?, ?, ?, ?, ?)");
                    $stmt->execute(array($first_name, $last_name, $email_from, $telephone, $subject, $comments, date("Y/m/d" . "  " . "H:i:sa")));

                    $pdo = NULL;


                    ?>
                    <br>
                    <?php
                    $labels = contactformulierTaal();
                    print($labels[8]);
                    ?>


                    <?php
               }

               ?>
          </div>
          <?php include 'footer.php';?>
     </div>
</body>
</html>
