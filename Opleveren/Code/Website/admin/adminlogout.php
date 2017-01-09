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
// Vernietigt alle sessies en stuurt de gebruiker terug naar de thuispagina/
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
