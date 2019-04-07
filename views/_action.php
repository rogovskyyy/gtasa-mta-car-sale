<?php

    require 'vendor/autoload.php';

    use Application\Action\Action;

    $Action = new Action();

    print $Action->GetPath($_GET['name']);

    
?>