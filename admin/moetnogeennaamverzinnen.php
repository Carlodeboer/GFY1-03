<?php
    if(!defined('adminToegang')) {
       header("Location: ../index.php");
       exit();
    }
?>
<br><br>
<table>
    <form method="POST" action="beheerpaneel.php?beheer=content">
        <tr>
            <td>Titel:</td>
            <td><input type="text" name="titel" value =<?php print "\"".$content[0]."\""; ?>></td>
        </tr><tr>
            <td>Inhoud:</td>
            <td><textarea name="inhoud" rows="4" cols="60"><?php print $content[1]; ?></textarea></td>
        </tr><tr>
            <td><input type="submit" name="verzenden" value="Verzenden" class="btn-main"></td>
        </tr>
    </form>
</table>
<br>
<?php print "<a href=\"http://".$_SERVER['HTTP_HOST']."/GFY1-03/admin/beheerpaneel.php?beheer=content\">Terug</a><br>"; ?>
