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
<?php define("toegang", true); ?>
<!DOCTYPE html>
<html>
    <head>
        <title>Contact</title>
        <?php include 'head.php'; ?>
    </head>
    <body>
        <div id="container">
            <?php include 'header.php'; ?>
            <div id="content">
                <div id="contentwrapper">
                    <div class="row">

                    <?php
                    // haalt ingestelde taal op
                            $labels = contactformulierTaal();

                            ?>
                    <h2><?php print $labels[0]; ?></h2>

<?php // contactformulier met submit naar contactscript via post ?>
                        <div class="col-md-6">


                            <form name="contactform" method="post" action="contactscript.php">



                                <div class="form-group label-static is-empty">
                                    <label for="inputvoornaam" class="control-label"><?php print $labels[1]; ?></label>
                                    <!-- <div class="col-md-10"> -->
                                        <input type="text" name="first_name" class="form-control" id="inputvoornaam" required>
                                    <!-- </div> -->
                                </div>

                                <div class="form-group label-static is-empty">
                                    <label for="inputachternaam" class="control-label"><?php print $labels[2]; ?></label>

                                        <input type="text" name="last_name" class="form-control" id="inputachternaam" required>

                                </div>

                                <div class="form-group label-static is-empty">
                                    <label for="inputemail" class="control-label"><?php print $labels[4]; ?></label>
                                        <input type="email" name="email" class="form-control" id="inputemail" required>

                                </div>

                                <div class="form-group label-static is-empty">
                                    <label for="inputtelefoon" class="control-label"><?php print $labels[5]; ?></label>

                                        <input type="text" name="telephone" class="form-control" id="inputtelefoon" required>

                                </div>

                                <div class="form-group label-static is-empty">
                                    <label for="inputonderwerp" class="control-label"><?php print $labels[3]; ?></label>

                                        <input type="text" name="subject" class="form-control" id="inputachternaam" required>

                                </div>

                                <div class="form-group label-static is-empty">
                                    <label for="textArea" class="control-label"><?php print $labels[6]; ?></label>


                                        <textarea class="form-control" name="comments" rows="3" id="textArea" required></textarea>
                                        <!-- <span class="help-block">Max 2000 characters.</span> -->

                                </div>

                                <div class="g-recaptcha" data-sitekey="6LdvmA0UAAAAANG5pBHPYoqw1-MTYUJRngrA88zK"></div><br>
                                <input type="submit" value=<?php print "\"" . $labels[7] . "\""; ?> class="btn btn-raised btn-primary contactformulierverzendenknop">

                            </form>
                        </div>

                        <div class="col-md-2">
                        </div>


                     </div>

                </div>
            </div>
        </div>
        <?php include 'footer.php'; ?>
    </div>
</body>
</html>
