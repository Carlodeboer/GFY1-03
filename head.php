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
session_start();
include 'functions.php';
$knopjes = knopjes();
$tijd = time();
if (isset($_SESSION['geldigeSession'])){
    if ($_SESSION['geldigeSession'] && isset($_SESSION['expire']) && $tijd > $_SESSION['expire']){
        $_SESSION['geldigeSession'] = false;
        header('Location: http://localhost/GFY1-03/admin/adminlogout.php');
        exit();
    }
}
$_SESSION['geldigeSession'] = true;
?>
<!-- Bootstrap material design -->
<link type="text/css" rel="stylesheet" href=<?php print "\"http://".$_SERVER['HTTP_HOST']."/GFY1-03/style/bootstrap.css\"";?>>
<link type="text/css" rel="stylesheet" href=<?php print "\"http://".$_SERVER['HTTP_HOST']."/GFY1-03/style/bootstrap-material-design.css\"";?>>
<link type="text/css" rel="stylesheet" href=<?php print "\"http://".$_SERVER['HTTP_HOST']."/GFY1-03/style/material.css\"";?>>
<link type="text/css" rel="stylesheet" href=<?php print "\"http://".$_SERVER['HTTP_HOST']."/GFY1-03/style/snackbar.min.css\"";?>>

<link type="text/css" rel="stylesheet" href=<?php print "\"http://".$_SERVER['HTTP_HOST']."/GFY1-03/style/style.css\"";?>>
<link type="text/css" rel="stylesheet" href=<?php print "\"http://".$_SERVER['HTTP_HOST']."/GFY1-03/style/responsiveslides.css\"";?>>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script src=<?php print "\"http://".$_SERVER['HTTP_HOST']."/GFY1-03/js/responsiveslides.js\"";?>></script>
<script src='https://www.google.com/recaptcha/api.js'></script>
<script>
  $(function() {
    $(".rslides").responsiveSlides();
  });
</script>

    <script src=<?php print "\"http://".$_SERVER['HTTP_HOST']."/GFY1-03/js/material.js\"";?>></script>
    <script src=<?php print "\"http://".$_SERVER['HTTP_HOST']."/GFY1-03/js/ripples.min.js\"";?>></script>

<script>
  $.material.init();
</script>
<script src=<?php print "\"http://".$_SERVER['HTTP_HOST']."/GFY1-03/js/snackbar.min.js\"";?>></script>
