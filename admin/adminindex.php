<?php
    if(!defined('toegang')) {
        function abspath()
        {
            return $_SERVER['HTTP_HOST'];
        }
       header("Location:" .abspath()."/GFY1-03/404.php");
       exit();
    }
?>
<form class="stip" method="GET" action="beheerpaneel.php">
    <input type="submit" name="beheer" value="Content" class="btn btn-raised btn-primary">
    <input type="submit" name="beheer" value="Agenda" class="btn btn-raised btn-primary">
    <input type="submit" name="beheer" value="Afbeelding" class="btn btn-raised btn-primary">
    <input type="submit" name="beheer" value="Berichtopvraag" class="btn btn-raised btn-primary">
    <input type="submit" name="beheer" value="Nieuws" class="btn btn-raised btn-primary">
</form>
