<!DOCTYPE html>
<?php
include "functions.php";
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Galerij</title>
        <?php include 'head.php';?>
        <link href="style/lightbox.css" rel="stylesheet">

    </head>
    <body>
        <div id="container">
            <?php include 'header.php'; ?>
            <div id="content">
                <h2> Galerij </h2>
                <?php
                $folder_path = 'portugalpicture/'; //map van de afbeelding(en)

                $num_files = glob($folder_path . "*.{JPG,jpg,gif,png,bmp}", GLOB_BRACE); //telt de bestanden

                $folder = opendir($folder_path);

                if ($num_files > 0) {
                    while (false != ($file = readdir($folder))) { //dit leest de map door en $file wordt het eerst
                        //volgende bestand die te vinden is
                        $file_path = $folder_path . $file; //dit is de map waar het bestand in staat
                        $extension = strtolower(pathinfo($file, PATHINFO_EXTENSION)); //haalt info uit de map
                        if ($extension == 'jpg' || $extension == 'png' || $extension == 'gif' || $extension == 'bmp' || $extension == 'jpeg') {
                            ?>
                            <a href="<?php echo $file_path; ?>"><img src="<?php echo $file_path; ?>" class="galerij"  /></a>
                            <?php
                        }
                    }
                } else {
                    echo "the folder was empty !";
                }
                closedir($folder);
                ?>
            </div>
            <?php include 'footer.php';?>
        </div>
      <script src="js/lightbox.js"></script>  
    </body>
</html>
