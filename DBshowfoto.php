<?php
define("toegang", true);

include 'functions.php';
/*** some basic sanity checks ***/
if(filter_has_var(INPUT_GET, "imageid") !== false && filter_input(INPUT_GET, 'imageid', FILTER_VALIDATE_INT) !== false)
    {
    /*** assign the image id ***/
    $image_id = filter_input(INPUT_GET, "imageid", FILTER_SANITIZE_NUMBER_INT);
    try     {
        /*** connect to the database ***/
        $pdo = newPDO();

        /*** set the PDO error mode to exception ***/
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        /*** The sql statement ***/
//<<<<<<< Updated upstream:showfile.php
//=======
        $sql = "SELECT image, image_type FROM fotos WHERE image_id=?";
// >>>>>>> Stashed changes:DBshowfoto.php

        /*** prepare the sql ***/
        $stmt = $pdo->prepare($sql);

        /*** exceute the query ***/
        $stmt->execute(array($image_id));

        /*** set the fetch mode to associative array ***/
        $stmt->setFetchMode(PDO::FETCH_ASSOC);

        /*** set the header for the image ***/
        $array = $stmt->fetch();

        /*** check we have a single image and type ***/
        if(sizeof($array) == 2)
            {
            /*** set the headers and display the image ***/
            header("Content-type: ".$array['image_type']);

            /*** output the image ***/
            echo $array['image'];
            }
        else
            {
            throw new Exception("Please use a existing imageID");
            }
        }
    catch(PDOException $e)
        {
        echo $e->getMessage();
        }
    catch(Exception $e)
        {
        echo $e->getMessage();
        }
        }
  else
        {
        echo 'Please use a real id number';
        }
?>
