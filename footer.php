<footer>
    <h3> Footer </h3>
    <!-- ik heb de linkjes vervangen met absolute linkjes, zodat ze blijven werken ookal
    include je de header in een bestand in een andere map-->
    <?php
    if(isset($_SESSION['admin_session']) && strpos($_SERVER['PHP_SELF'], "admin") != false){
        print "<a href=\"http://".$_SERVER['HTTP_HOST']."/GFY1-03/admin/adminlogout.php\">logout</a><br>";
    } else {
        print "<a href=\"http://".$_SERVER['HTTP_HOST']."/GFY1-03/admin/adminlogin.php\">admin</a><br>";
    }
    ?>

</footer>
