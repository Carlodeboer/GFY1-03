
<table>
    <form method="POST" action="beheerpaneel.php?beheer=content">
        <tr>
            <td>Titel:</td>
            <td><input type="text" name="titel"></td>
        </tr><tr>
            <td>Pagina:</td>
            <td><select name="pagina"><option value="index">Thuispagina</option><option value="info">Informatie</option></td>
        </tr><tr>
            ><tr>
                <td>Taal:</td>
                <td><select name="taal">
                        <option value="NLD">Nederlands</option>
                        <option value="ENG">Engels</option>
                        <option value="DEU">Duits</option></td>
            </tr><tr>
            <td>Inhoud:</td>
            <td><textarea name="inhoud" rows="4" cols="60"></textarea></td>
        </tr><tr>
            <td><input type="submit" name="verzenden" value="Verzenden"></td>
        </tr>
    </form>
    <?php
        if ($succes){
            print "<p>toegevoegd!</p>";

            include '../dbconnect.php';


            $titel = $_POST['titel'];
            $inhoud = $_POST['inhoud'];
            $taal = $_POST['taal'];

            $pagina = $_POST['pagina'];


                  $stmt = $pdo->prepare("UPDATE content
                  SET title=?, bodytext=?
                  WHERE lang = ?
                  AND pagina =?");
                  $stmt->execute(array($titel, $inhoud, $taal, $pagina));

                  $pdo=NULL;

        }
    ?>
</table>
