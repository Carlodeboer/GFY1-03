<?php
    include "../toegang.php";
?>
<br><br>
<div id="contentwrapper">
    <form method="get" action="beheerpaneel.php?beheer=Content">
    <div class="form-group">
        <label for="select111" class="col-md-2 control-label">Pagina</label>
        <div class="col-md-10">
            <select name="pagina" id="select111" class="form-control">
            <option value="index">Thuispagina</option>
                <option value="informatie">Accommodatie</option>
                <option value="prijzen">Prijzen</option>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label for="select111" class="col-md-2 control-label">Taal</label>
        <div class="col-md-10">
            <select name="taal" id="select111" class="form-control">
                <option value="NLD">Nederlands</option>
                <option value="ENG">Engels</option>
                <option value="DEU">Duits</option>
            </select>
         </div>
    </div>
    <input type="submit" name="selecteerContent" value="Kies" class="btn btn-raised btn-primary">
    </form>
</div>
