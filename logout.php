<?php require 'vendor/autoload.php'; $View = new View();
    $View->Route('header'); 
?>
        <body>

            <?php $View->Route('logout'); ?>

        </body>

    <?php $View->Route('footer'); ?>

</html>