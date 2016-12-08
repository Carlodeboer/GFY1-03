<?php


        /*** connect to the database ***/
include 'dbconnect.php';
        /*** set the PDO error mode to exception ***/
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        /*** The sql statement ***/
        $sql = "SELECT image, image_type FROM testblob WHERE image_id=3";

        /*** prepare the sql ***/
        $stmt = $pdo->prepare($sql);

        /*** exceute the query ***/
        $stmt->execute();

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
            throw new Exception("Out of bounds Error");
            }
