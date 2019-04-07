<?php require 'vendor/autoload.php'; $View = new View();
    $View->Route('header'); 
?>
        <body>

            <?php $View->Route('register'); ?>

        </body>

    <?php $View->Route('footer'); ?>

</html>