<?php
    include 'functions.php';
    $knopjes = knopjes();
?>
<div id="banner">
  <a href="index.php"><h2> Offroad Compass Portugal </h2></a>

  <span id="talenknoppen">
  <form method="GET" action=<?php print "\"".$_SERVER['PHP_SELF']."\""?>>
      <input class="taalbutton" id="NLD" type="submit" name="lang" value="NLD">
      <input class="taalbutton" id="ENG" type="submit" name="lang" value="ENG">
      <input class="taalbutton" id="DEU" type="submit" name="lang" value="DEU">
  </form>
  </span>

  <ul class="rslides">
  <li><img src=<?php print "\"http://".$_SERVER['HTTP_HOST']."/GFY1-03/images/1.jpg\"";?> alt=""></li>
  <li><img src=<?php print "\"http://".$_SERVER['HTTP_HOST']."/GFY1-03/images/2.jpg\"";?> alt=""></li>
  <li><img src=<?php print "\"http://".$_SERVER['HTTP_HOST']."/GFY1-03/images/3.jpg\"";?> alt=""></li>
  </ul>
</div>
<nav>
<ul>
    <!-- ik heb de linkjes vervangen met absolute linkjes, zodat ze blijven werken ookal
    include je de header in een bestand in een andere map-->
    <a href=<?php print "\"http://".$_SERVER['HTTP_HOST']."/GFY1-03/index.php\"";?>><li><?php print $knopjes[0]; ?></li></a>
    <a href=<?php print "\"http://".$_SERVER['HTTP_HOST']."/GFY1-03/informatie.php\"";?>><li><?php print $knopjes[1]; ?></li></a>
    <a href=<?php print "\"http://".$_SERVER['HTTP_HOST']."/GFY1-03/prijzen.php\"";?>><li><?php print $knopjes[2]; ?></li></a>
    <a href=<?php print "\"http://".$_SERVER['HTTP_HOST']."/GFY1-03/contact.php\"";?>><li><?php print $knopjes[3]; ?></li></a>
    <a href=<?php print "\"http://".$_SERVER['HTTP_HOST']."/GFY1-03/login.php\"";?>><li><?php print $knopjes[4]; ?></li></a>
    <a href=<?php print "\"http://".$_SERVER['HTTP_HOST']."/GFY1-03/galerij.php\"";?>><li><?php print $knopjes[5]; ?></li></a>
</ul>
</nav>
