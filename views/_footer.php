<?php 

    require 'vendor/autoload.php';

    use Application\Database\Database;

    $Database = new Database();
    
    return $Database->closeConnection();
    
?>