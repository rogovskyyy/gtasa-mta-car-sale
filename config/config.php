<?php
namespace Application\Config;

 class Config 
 {
      protected $config;

      public function config()
      {
            return $config = [
                  "DATABASE_HOST" => "",
                  "DATABASE_USERNAME" => "",
                  "DATABASE_PASSWORD" => "",
                  "DATABASE_TABLE" => "",
                  "WEBSITE_TITLE" => "",
                  "WEBSITE_PATH" => $_SERVER[HTTP_HOST]
           ];
      }
 }