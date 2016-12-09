<!DOCTYPE html>
<html>
<?php
include "dbconnect.php"
?>
<head>
     <title>Motorcross</title>
     <?php include 'head.php';?>
</head>
<body>
     <div id="container">
          <?php include 'header.php';?>
          <div id="content">
               <div id="contentwrapper">
                    <h2>Login</h2>
                    <form method="POST" action="reisinformatie.php">
                         <table>
                              <tr>
                                   <td>Vakantienaam:</td>
                                   <td><input type="text" name="vakantienaam"></td>
                              </tr><tr>
                                   <td>Vakantieweek:</td>
                                   <td><input type="text" name="vakantieweek"></td>
                              </tr><tr>
                                   <td><input type="submit" name="verzenden" value="Reisinformatie ophalen" class="btn-main"></td>
                              </tr>
                         </table>
                    </form>
               </div>
          </div>
     </div>
     <?php include 'footer.php';?>
</body>
</html>
