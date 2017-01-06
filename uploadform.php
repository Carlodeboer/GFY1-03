


<html>
<head><title>Bestand uploaden naar Database</title></head>
<body>
  <div id="contentwrapper">
    <h2>Afbeelding uploaden </h2>
    <form enctype="multipart/form-data" method="post">
      <input type="hidden" name="MAX_FILE_SIZE" value="99999999" />
      <div><input name="userfile" type="file" /></div>
      <div><input type="submit" value="Submit" class="btn btn-raised btn-primary"></div>
    </form>


    <?php
//checken of er werkelijk een file is 'gesubmit'
    if(!isset($_FILES['userfile']))
    {
      echo '<p>Kies een bestand</p>';
    }
    else
    {
      try    {
        upload();
        echo '<p>Toegevoegd</p>';
      }
      catch(Exception $e)
      {
        echo '<h4>'."mislukt".'</h4>';
      }
    }
    ?>
  </div>
</body></html>
<?php
/**
*
* the upload function
*
* @access public
*
* @return void
*
*/
function upload(){
//checkt of er een werkelijk een file is geuploadd
  if(is_uploaded_file($_FILES['userfile']['tmp_name']) && getimagesize($_FILES['userfile']['tmp_name']) != false)
  {
//haal de foto data op:
    $size = getimagesize($_FILES['userfile']['tmp_name']);
//variabelen toewijzen
    $type = $size['mime'];
    $imgfp = fopen($_FILES['userfile']['tmp_name'], 'rb');
    $size = $size[3];
    $name = $_FILES['userfile']['name'];
    $maxsize = 99999999;


  if($_FILES['userfile']['size'] < $maxsize )
    {
      /*** connect to db ***/
      $pdo = newPDO();
      /*** set the error mode ***/
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      /*** our sql query ***/
      $stmt = $pdo->prepare("INSERT INTO fotos (image_type ,image, image_size, image_name) VALUES (? ,?, ?, ?)");

      /*** bind the params ***/
      $stmt->bindParam(1, $type);
      $stmt->bindParam(2, $imgfp, PDO::PARAM_LOB);
      $stmt->bindParam(3, $size);
      $stmt->bindParam(4, $name);

      /*** execute the query ***/
      $stmt->execute();
    }
    else
    {
      /*** throw an exception is image is not of type ***/
      throw new Exception("File Size Error");
    }
  }
  else
  {
    // if the file is not less than the maximum allowed, print an error
    throw new Exception("Unsupported Image Format!");
  }
}
?>
