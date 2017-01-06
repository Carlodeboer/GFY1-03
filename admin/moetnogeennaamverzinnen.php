<?php
include "../toegang.php";
?>
<br><br>
<div id="contentwrapper">
    <form method="POST" action="beheerpaneel.php?beheer=Content">
        <div class="form-group">
            <label for="inputtitel" class="col-md-2 control-label">Titel</label>
            <div class="col-md-10">
                <input type="text" name="titel" value =<?php print "\"".$content[0]."\""; ?> class="form-control" id="inputtitel">
            </div>
        </div>
        <div class="form-group is-empty">
            <label for="textArea" class="col-md-2 control-label">Inhoud</label>
            <div class="col-md-10">
                <textarea class="form-control" rows="20" name="inhoud" id="textArea"><?php print $content[1]; ?></textarea>
            </div>
        </div>
        <input type="submit" name="verzenden" value="Bewerken" class="btn btn-raised btn-primary">
    </form>
    <form method="POST" action=<?php print("\"http://".$_SERVER['HTTP_HOST']."/GFY1-03/admin/beheerpaneel.php?beheer=Content\"");?>>
         <input type="submit" name="terug" value="Terug" class="btn btn-raised btn-primary">
    </form>
</div>
