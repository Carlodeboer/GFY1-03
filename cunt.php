<?php
$email_to = "thijs.marschalk@gmail.com";

$email_from = "info@offroadcompassportugal.nl";
$email_subject = "Bericht verstuurd via contactformulier";
$email_message = "Formuliergegevens hieronder.\n\n";







'Reply-To: '.$email_from."\r\n" .

'X-Mailer: PHP/' . phpversion();

//versturen van de mail
@mail($email_to, $email_subject, $email_message, $headers);
?>
