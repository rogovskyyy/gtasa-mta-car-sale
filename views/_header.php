<?php 
require 'vendor/autoload.php'; 
use Application\Config\Config; 
?>
<!DOCTYPE HTML>
    <html>
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge" />
            <title><?php print Config::config()['WEBSITE_TITLE']; ?></title>
            <meta name="description" content="Najlepsze oferty pojazdów!" />
            <meta name="keywords" content="otomoto, mta, serwer" />
            <meta name="author" content="Michał Michasiów" />
            <meta name="subject" content="Otomoto">
            <meta name="copyright" content="Spyze">
            <meta name="language" content="PL">
            <meta name="robots" content="index,follow" />

            <link rel="stylesheet" href="css/style.css" type="text/css">
            <link rel="stylesheet" href="css/fontello.css" type="text/css">

            <meta name="viewport" content="width=device-width, initial-scale=1.0">

            
        </head>