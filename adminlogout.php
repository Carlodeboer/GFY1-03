<!DOCTYPE html>
<html>
<head>
    <title>Motorcross</title>
</head>
    <body>
        <p>bezig met uitloggen...</p>
        <?php
            session_start();
            session_unset();
            session_destroy();
            header("Location: index.php");
            exit;
        ?>
    </body>
</html>
