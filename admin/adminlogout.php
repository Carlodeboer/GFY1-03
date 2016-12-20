<?php
session_start();
session_unset();
session_destroy();
header("Location: ../index.php");
exit();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Motorcross</title>
</head>
    <body>
        <p>bezig met uitloggen...</p>
    </body>
</html>
