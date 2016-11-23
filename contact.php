<!DOCTYPE html>
<html>
<head>
        <title>Motorcross</title>
        <link type="text/css" rel="stylesheet" href="style/style.css">
        <link type="text/css" rel="stylesheet" href="style/responsiveslides.css">
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
        <script src="js/responsiveslides.js"></script>
        <script>
          $(function() {
            $(".rslides").responsiveSlides();
          });
        </script>
</head>
    <body>
        <div id="container">
          <?php include 'header.php';?>


            <form name="contactform" method="post" action="contactscript.php">

            <table width="450px">

            <tr>

             <td valign="top">

              <label for="first_name">First Name *</label>

             </td>

             <td valign="top">

              <input  type="text" name="first_name" maxlength="50" size="30">

             </td>

            </tr>

            <tr>

             <td valign="top">

              <label for="last_name">Last Name *</label>

             </td>

             <td valign="top">

              <input  type="text" name="last_name" maxlength="50" size="30">
            </td>
          </tr>
          <tr>
            <td valign="top">

             <label for="subject">Subject *</label>

            </td>

            <td valign="top">

             <input  type="text" name="subject" maxlength="50" size="30">

             </td>

            </tr>

            <tr>

             <td valign="top">

              <label for="email">Email Address *</label>

             </td>

             <td valign="top">

              <input  type="text" name="email" maxlength="80" size="30">

             </td>

            </tr>

            <tr>

             <td valign="top">

              <label for="telephone">Telephone Number</label>

             </td>

             <td valign="top">

              <input  type="text" name="telephone" maxlength="30" size="30">

             </td>

            </tr>

            <tr>

             <td valign="top">

              <label for="comments">Message *</label>

             </td>

             <td valign="top">

              <textarea  name="comments" maxlength="2000" cols="25" rows="6"></textarea>

             </td>

            </tr>

            <tr>

             <td colspan="2" style="text-align:center">

              <input type="submit" value="Submit">

             </td>

            </tr>

            </table>

            </form>
        <?php include 'footer.php';?>
        </div>
    </body>
</html>
