<?php

    require 'vendor/autoload.php';

    use Application\Session\Session;

    Session::SessionCreate();

    Session::SessionDestroy();

    header('Location: action.php?name=logout');

?>