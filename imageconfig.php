<?php

$db ="mysql:host=carlodb.nl;dbname=carlodb_database;port=3306";
$user = "carlodb_school";
$pass = "GFY1-03";
$pdo = new PDO($db, $user, $pass);

 try{
  $DB_con = new PDO("mysql:host={$DB_HOST};dbname={$DB_NAME}",$DB_USER,$DB_PASS);
  $DB_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 }
 catch(PDOException $e){
  echo $e->getMessage();
 }



 ?>
