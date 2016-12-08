<?php
    if(!defined('adminToegang')) {
       header("Location: ../index.php");
       exit();
    }
?>
<form class="stip" method="GET" action="beheerpaneel.php">
    <input type="submit" name="beheer" value="Content" class="btn-main">
    <input type="submit" name="beheer" value="Agenda" class="btn-main">
    <input type="submit" name="beheer" value="Afbeelding" class="btn-main">
    <input type="submit" name="beheer" value="Berichtopvraag" class="btn-main">
    <input type="submit" name="beheer" value="Nieuws" class="btn-main">
</form>
