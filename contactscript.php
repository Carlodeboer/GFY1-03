<?php

if(empty($_POST['submit']))
{
    echo "Form is not submitted!";
    exit;
}
if(empty($_POST["fullname"]) ||
    empty($_POST["email"]))
    {
        echo "Please fill the form";
        exit;
    }

$name = $_POST["fullname"];
$email = $_POST["email"];

mail( 'thijs.marschalk@gmail.com' , 'New form submission' ,
"New form submission: Name: $name, Email:$email"  );

header('Location: thank-you
<?php
if(!isset($_POST['submit']))
{
    //This page should not be accessed directly. Need to submit the form.
    echo "error; you need to submit the form!";
}
$name = $_POST['name'];
$visitor_email = $_POST['email'];
$message = $_POST['message'];

//Validate first
if(empty($name)||empty($visitor_email))
{
    echo "Name and email are mandatory!";
    exit;
}

$email_from = 'tom@amazing-designs.com';//<== Put your email address here
$email_subject = "New Form submission";
$email_body = "You have received a new message from the user $name.\n".
    "email address: $visitor_email\n".
    "Here is the message:\n $message".

$to = "tom@amazing-designs.com";//<== Put your email address here
$headers = "From: $email_from \r\n";

//Send the email!
mail($to,$email_subject,$email_body,$headers);
//done. redirect to thank-you page.
header('Location: thank-you.html');

?>
