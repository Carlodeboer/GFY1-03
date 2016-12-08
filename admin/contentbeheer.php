<?php
if (!defined('adminToegang')) {
    header("Location: ../index.php");
    exit();
}
?>
<br><br>

<div id="contentwrapper">
    <table>
        <form method="get" action="beheerpaneel.php?beheer=content">
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
                <td><br><input type="submit" name="selecteerContent" value="Verzenden" class="btn-main"></td>
            </tr>
        </form>
    </table>

</div>
