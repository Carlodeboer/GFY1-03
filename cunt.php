<?php
/*******************************************************************************
 * Copyright (c) 2017 Carlo de Boer, Floris de Grip, Thijs Marschalk,
 * Ralphine de Roo, Sophie Roos and Ian Vredenburg
 *
 * This Source Code Form is subject to the terms of the MIT license.
 * If a copy of the MIT license was not distributed with this file. You can
 * obtain one at https://opensource.org/licenses/MIT
 *******************************************************************************/
?>
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
