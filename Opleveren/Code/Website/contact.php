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

                            <div id="googlemaps">
                                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2443.549416940136!2d5.956437915725985!3d52.233403579760925!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47c7c7a21bf0f591%3A0x7ec280ce253a9027!2sKoninginnelaan+239%2C+7315+DW+Apeldoorn!5e0!3m2!1snl!2snl!4v1483369231647"
                                        width="450" height="375" frameborder="0" style="border:0" allowfullscreen></iframe>
                            </div>
                     </div>

                </div>
            </div>
        </div>
        <?php include 'footer.php'; ?>
    </div>
</body>
</html>
