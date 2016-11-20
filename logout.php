<?php
 session_start();
 if (!isset($_SESSION['user_session'])) {
  header("Location: loginscript.php");
 } else if(isset($_SESSION['user_session'])!="") {
  header("Location: loginscript.php");
 }
 
 if (isset($_GET['logout'])) {
  unset($_SESSION['user']);
  session_unset();
  session_destroy();
  header("Location: loginscript.php");
  exit;
 }