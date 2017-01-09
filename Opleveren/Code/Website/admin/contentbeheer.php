<?php
/*******************************************************************************
 * Copyright (c) 2017 Carlo de Boer, Floris de Grip, Thijs Marschalk,
 * Ralphine de Roo, Sophie Roos and Ian Vredenburg
 *
 * This Source Code Form is subject to the terms of the MIT license.
 * If a copy of the MIT license was not distributed with this file. You can
 * obtain one at https://opensource.org/licenses/MIT
 *******************************************************************************/
?>
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
