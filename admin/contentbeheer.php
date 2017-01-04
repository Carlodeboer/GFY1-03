<?php
    include "../toegang.php";
?>
<br><br>
<div id="contentwrapper">
  <h2>Content </h2>
    <table>
        <form method="get" action="beheerpaneel.php?beheer=Content">
            <tr>
                <td>Pagina:</td>
                <td><select name="pagina">
                        <option value="index">Thuispagina</option>
                        <option value="informatie">Informatie</option>
                        <option value="prijzen">Prijzen</option></td>
            </tr><tr>
                <td>Taal:</td>
                <td><select name="taal">
                        <option value="NLD">Nederlands</option>
                        <option value="ENG">Engels</option>
                        <option value="DEU">Duits</option></td>
            </tr><tr>
                <td><br><input type="submit" name="selecteerContent" value="Verzenden" class="btn btn-raised btn-primary"></td>
            </tr>
        </form>
    </table>
</div>
