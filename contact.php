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
            <form name="contactform" method="post" action="contactscript.php">
            <table width="450px">

            <tr>
             <td valign="top">
              <label for="first_name">Voornaam *</label>
             </td>
             <td valign="top">
              <input  type="text" name="first_name" maxlength="50" size="30">
             </td>
            </tr>

            <tr>
             <td valign="top">
              <label for="last_name">Achternaam *</label>
             </td>
             <td valign="top">
              <input  type="text" name="last_name" maxlength="50" size="30">
            </td>
          </tr>

          <tr>
            <td valign="top">
             <label for="subject">Onderwerp *</label>
            </td>
            <td valign="top">
             <input  type="text" name="subject" maxlength="50" size="30">
             </td>
            </tr>

           <tr>
             <td valign="top">
              <label for="email">Email Adres *</label>
             </td>
             <td valign="top">
              <input  type="text" name="email" maxlength="80" size="30">
             </td>
            </tr>

            <tr>
             <td valign="top">
              <label for="telephone">Telefoonnummer</label>
             </td>
             <td valign="top">
              <input  type="text" name="telephone" maxlength="30" size="30">
             </td>
            </tr>

            <tr>
             <td valign="top">
              <label for="comments">Bericht *</label>
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

          </div>
        <?php include 'footer.php';?>
        </div>
    </body>
</html>
