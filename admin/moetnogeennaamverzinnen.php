<?php
    include "../toegang.php";
?>
<br><br>
<div id="contentwrapper">
<table>
    <form method="POST" action="beheerpaneel.php?beheer=content">
        <tr>
            <td>Titel:</td>
            <td><input type="text" name="titel" value =<?php print "\"".$content[0]."\""; ?>></td>
        </tr><tr>
            <td>Inhoud:</td>
            <td><textarea name="inhoud" rows="4" cols="60"><?php print $content[1]; ?></textarea></td>
        </tr><tr>
            <td><input type="submit" name="verzenden" value="Verzenden" </td>
        </tr>
    </form>
</table>

<br>
<?php print "<p><a href=\"http://".$_SERVER['HTTP_HOST']."/GFY1-03/admin/beheerpaneel.php?beheer=content\">Terug</a></p><br>"; ?>
</div>
