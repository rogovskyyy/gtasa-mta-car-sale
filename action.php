<?php require 'vendor/autoload.php'; $View = new View();
    $View->Route('header'); 
?>
        <body>

            <?php $View->Route('action'); ?>

        </body>

    <?php $View->Route('footer'); ?>

</html>