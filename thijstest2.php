
<?php
/*
//include database connection
include 'dbconnect.php';
//select the image
$query = "SELECT * from upload WHERE id = ?";
$stmt = $pdo->prepare( $query );
//bind the id of the image you want to select
$stmt->bindParam(1, $_GET['id']);
$stmt->execute();
//to verify if a record is found
$num = $stmt->rowCount();
if( $num ){
    //if found
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    //specify header with content type,
    //you can do header(“Content-type: image/jpg”); for jpg,
    //header(“Content-type: image/gif”); for gif, etc.
    header("Content-type: image/jpeg");

    //display the image data
    print $row['name'];
    exit;
}else{
    //if no image found with the given id,
    //load/query your default image here
}
$pdo=NULL
*/


include 'dbconnect.php';
$stmt = $pdo->prepare("SELECT type, content from upload where id=?");
$stmt->execute(array("1"));
$stmt->bindColumn(1, $type, PDO::PARAM_STR, 256);
$stmt->bindColumn(2, $lob, PDO::PARAM_LOB);
$stmt->fetch(PDO::FETCH_BOUND);

header("Content-Type: $type");
fpassthru($lob);
?>
?>
