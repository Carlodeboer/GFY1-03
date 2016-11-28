<footer>
    <h3> Contactgegevens </h3>
<<<<<<< HEAD
    <a href="adminlogin.php">admin</a><br>
    <a href="imageupload.php">image uploader</a>
=======
    <?php
    if(isset($_SESSION['user_session'])){
        print "<a href=\"adminlogout.php\">logout</a>";
    }
    else {
        print "<a href=\"adminlogin.php\">admin</a>";
    }
    ?>
>>>>>>> origin/master
</footer>
