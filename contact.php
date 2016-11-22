<!DOCTYPE html>
<html>
    <head>
        <title>Motocross</title>
        <link type="text/css" rel="stylesheet" href="style.css">
    </head>
    <body>
        <div id="container">
            <nav>
                <div id="banner">
                </div>
                <ul>
                    <a href="index.php"><li>Home</li></a>
                    <a href="informatie.php"><li>Informatie</li></a>
                    <a href="boeken.php"><li>Boeken</li></a>
                    <a href="contact.php"><li>Contact</li></a>
                    <a href="login.php"><li>Login</li></a>
                </ul>
hoi floris
            </nav>

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

              <textarea  name="comments" maxlength="1000" cols="25" rows="6"></textarea>

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
    </body>
</html>
