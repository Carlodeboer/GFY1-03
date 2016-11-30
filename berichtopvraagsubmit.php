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
              <h2> Contact </h2>
            <form name="contactform" method="post" action="berichtopvraag.php">
            <table width="450px">



           <tr>
             <td valign="top">
              <label for="email">Email Adres *</label>
             </td>
             <td valign="top">
              <input  type="text" name="email" maxlength="80" size="30">
             </td>
            </tr>

            <tr>
             <td colspan="2" style="text-align:center">
              <input type="submit" value="Submit">
             </td>
            </tr>
            </table>
            </form>

          </div>
        <?php include 'footer.php';?>
        </div>
    </body>
</html>
