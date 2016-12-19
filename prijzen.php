<?php define("toegang", true); ?>
<!DOCTYPE html>
<html>
    <head>
        <title>Prijzen</title>
        <?php include 'head.php'; ?>

    </head>
    <body>
        <div id="container">
            <?php include 'header.php'; ?>

            <div id="content">
              <div id="contentwrapper">
              <div id="row">
              <div class="col-md-4">
                <?php
                    $content = laadContent("","");
                    print "<h2>".$content['title']."</h2>";
                    print "<p>".$content['bodytext']."</p>";
                ?>
                <form method="POST" action="boeken.php">
                    <input type="submit" value="Boeken" class="btn btn-raised btn-primary">
                </form>
              </div>
            </div>
         
            <div class="col-md-8">
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut tempor justo et gravida pellentesque. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Vestibulum ex velit, faucibus in nunc porttitor, blandit vehicula sapien. Cras rutrum aliquam turpis, vitae varius quam. Maecenas sit amet lorem libero. Mauris nec aliquet urna. Vestibulum scelerisque diam a magna consequat faucibus. Aenean scelerisque suscipit purus in viverra. Duis at laoreet mi, quis imperdiet dolor.</p>

<p> Quisque faucibus orci accumsan arcu laoreet, sed rutrum neque euismod. Praesent nec nisl vitae purus finibus hendrerit in eu nisl. Curabitur sodales in tellus et lobortis. Vestibulum interdum pretium nibh condimentum efficitur. Nam malesuada fringilla turpis, eget semper elit rutrum sit amet. Donec sit amet lorem eget nunc tempor imperdiet.</p>
            </div>
            </div>
            </div>
            <?php include 'footer.php'; ?>
        </div>
    </body>
</html>
