<footer>
    <h3> Contactgegevens </h3>
    <?php
    if(isset($_SESSION['user_session'])){
        print "<a href=\"adminlogout.php\">logout</a>";
    }
    else {
        print "<a href=\"adminlogin.php\">admin</a>";
    }
    ?>
</footer>
