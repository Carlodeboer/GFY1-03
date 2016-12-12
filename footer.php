<footer>
  <div id="footerwrapper">
    <div id="googlemaps">
      <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2428.853044415557!2d6.079371215736348!3d52.49989967981054!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47c7ded4f4f95b31%3A0xb1a2f2cf9bba075!2sCampus+1%2C+8017+Zwolle!5e0!3m2!1snl!2snl!4v1481550637316"
      width="300" height="200" frameborder="0" style="border:0" allowfullscreen></iframe>
    </div>

    <h4> CONTACTGEGEVENS </h4>
    <!-- ik heb de linkjes vervangen met absolute linkjes, zodat ze blijven werken ookal
    include je de header in een bestand in een andere map-->

    <ul id="contactgegevens">
      <li>Michael Mairhofer</li>
      <li>Wegstraat 12A</li>
      <li>7391 AB   Apeldoorn</li>
      <li>06-12345678</li>
      <li>055-123456</li>
      <li><a href="mailto:info@offroadcompassportugal.nl">info@offroadcompassportugal.nl</a></li>
    </ul>

  </div>


  <?php
    if(isset($_SESSION['admin_session']) && strpos($_SERVER['PHP_SELF'], "admin") != false){
        print "<p>Welkom {$_SESSION['admin_session']} <br><a href=\"http://".$_SERVER['HTTP_HOST']."/GFY1-03/admin/adminlogout.php\">logout</a></p><br>";
    } else {
        print "<a href=\"http://".$_SERVER['HTTP_HOST']."/GFY1-03/admin/adminlogin.php\">admin</a><br>";
    }
    ?>
</footer>
