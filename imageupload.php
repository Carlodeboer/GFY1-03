<br><br>

<div id="contentwrapper">
    <form method="post" enctype="multipart/form-data">
        <table width="350" border="0" cellpadding="1" cellspacing="1" class="box">
            <tr>
                <td width="246">
                    <input type="hidden" name="MAX_FILE_SIZE" value="2000000">
                    <input name="userfile" type="file" id="userfile">
                </td>
                <td width="80"><input name="upload" type="submit" class="box" id="upload" value=" Upload "></td>
            </tr>
        </table>
    </form>
</div> 





<?php
if (isset($_POST['upload']) && $_FILES['userfile']['size'] > 0) {
    $fileName = $_FILES['userfile']['name'];
    $tmpName = $_FILES['userfile']['tmp_name'];
    $fileSize = $_FILES['userfile']['size'];
    $fileType = $_FILES['userfile']['type'];

    $fp = fopen($tmpName, 'r');
    $content = fread($fp, filesize($tmpName));
    $content = addslashes($content);
    fclose($fp);

    $fileName = addslashes($fileName);

    include 'dbconnect.php';

    $query = $pdo->prepare("INSERT INTO upload (name, size, type, content )
VALUES (?, ?, ?, ?)");
    $query->execute(array($fileName, $fileSize, $fileType, $content)) or die('Error, query failed');

    echo "<br>File $fileName uploaded<br>";
}
?>
