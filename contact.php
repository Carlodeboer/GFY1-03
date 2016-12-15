<?php define("toegang", true); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Motorcross</title>
    <?php include 'head.php';?>
</head>
    <body>
        <div id="container">
          <?php include 'header.php';?>
          <div id="content">
            <div id="contentwrapper">
<div class="row">
<div class="col-md-6">
            <?php
            $labels = contactformulierTaal();
            ?>
            <h2><?php print $labels[0]; ?></h2>
          <form name="contactform" method="post" action="contactscript.php">
          <table width="450px">

          <tr>
           <td valign="top">
            <label for="first_name"><?php print $labels[1]; ?></label>
           </td>
           <td valign="top">
            <input  type="text" name="first_name" maxlength="50" size="30">
           </td>
          </tr>

          <tr>
           <td valign="top">
            <label for="last_name"><?php print $labels[2]; ?></label>
           </td>
           <td valign="top">
            <input  type="text" name="last_name" maxlength="50" size="30">
          </td>
        </tr>

        <tr>
          <td valign="top">
           <label for="subject"><?php print $labels[3]; ?></label>
          </td>
          <td valign="top">
           <input  type="text" name="subject" maxlength="50" size="30">
           </td>
          </tr>

         <tr>
           <td valign="top">
            <label for="email"><?php print $labels[4]; ?></label>
           </td>
           <td valign="top">
            <input  type="text" name="email" maxlength="80" size="30">
           </td>
          </tr>

          <tr>
           <td valign="top">
            <label for="telephone"><?php print $labels[5]; ?></label>
           </td>
           <td valign="top">
            <input  type="text" name="telephone" maxlength="30" size="30">
           </td>
          </tr>

          <tr>
           <td valign="top">
            <label for="comments"><?php print $labels[6]; ?></label>
           </td>
           <td valign="top">
            <textarea  name="comments" maxlength="2000" cols="25" rows="6"></textarea>
           </td>
          </tr>

          <tr>
           <td colspan="2" style="text-align:center">
            <input type="submit" value=<?php print "\"".$labels[7]."\""; ?> class="btn-main">
           </td>
          </tr>
          </table>
          <div class="g-recaptcha" data-sitekey="6LdvmA0UAAAAANG5pBHPYoqw1-MTYUJRngrA88zK"></div>

                </div>

                <div class="col-md-2">
                </div>


<div class="col-md-5">
    <div id="googlemaps">
      <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2428.853044415557!2d6.079371215736348!3d52.49989967981054!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47c7ded4f4f95b31%3A0xb1a2f2cf9bba075!2sCampus+1%2C+8017+Zwolle!5e0!3m2!1snl!2snl!4v1481550637316"
      width="450" height="375" frameborder="0" style="border:0" allowfullscreen></iframe>
    </div>
    </div>
  </div>

                </div>
              </div>
          </div>
          <?php include 'footer.php';?>
        </div>
    </body>
</html>
