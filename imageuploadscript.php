<?php


 try{
  $DB_con = new PDO("mysql:host={$DB_HOST};dbname={$DB_NAME}",$DB_USER,$DB_PASS);
  $DB_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 }
 catch(PDOException $e){
  echo $e->getMessage();
 }



 error_reporting( ~E_NOTICE ); // avoid notice
  require_once 'dbconfig.php';

  if(isset($_POST['btnsave']))
  {
   $username = $_POST['user_name'];// user name
   $userjob = $_POST['user_job'];// user email

   $imgFile = $_FILES['user_image']['name'];
   $tmp_dir = $_FILES['user_image']['tmp_name'];
   $imgSize = $_FILES['user_image']['size'];


   if(empty($username)){
    $errMSG = "Please Enter Username.";
   }
   else if(empty($userjob)){
    $errMSG = "Please Enter Your Job Work.";
   }
   else if(empty($imgFile)){
    $errMSG = "Please Select Image File.";
   }
   else
   {
    $upload_dir = 'user_images/'; // upload directory

    $imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION)); // get image extension

    // valid image extensions
    $valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions

    // rename uploading image
    $userpic = rand(1000,1000000).".".$imgExt;

    // allow valid image file formats
    if(in_array($imgExt, $valid_extensions)){
     // Check file size '5MB'
     if($imgSize < 5000000)    {
      move_uploaded_file($tmp_dir,$upload_dir.$userpic);
     }
     else{
      $errMSG = "Sorry, your file is too large.";
     }
    }
    else{
     $errMSG = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    }
   }


   // if no error occured, continue ....
   if(!isset($errMSG))
   {
    $stmt = $DB_con->prepare('INSERT INTO tbl_users(userName,userProfession,userPic) VALUES(:uname, :ujob, :upic)');
    $stmt->bindParam(':uname',$username);
    $stmt->bindParam(':ujob',$userjob);
    $stmt->bindParam(':upic',$userpic);

    if($stmt->execute())
    {
     $successMSG = "new record succesfully inserted ...";
     header("refresh:5;index.php"); // redirects image view page after 5 seconds.
    }
    else
    {
     $errMSG = "error while inserting....";
    }
   }
  }
 ?>

?>
