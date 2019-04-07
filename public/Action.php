<?php
namespace Application\Action; 

    require 'vendor/autoload.php';
    use Application\Config\Config;

    class Action 
    {
        public function GetPath($url)
        {
            $this->_url = $url;
            switch($this->_url)
            {
                case 'add':
                    print "<meta http-equiv='refresh' content='3; url=".Config::config()['WEBSITE_PATH']."'>";
                    print "Ogłoszenie dodane prawidłowo, za chwilę zostaniesz przekierowany na stronę główną";
                    break;
                case 'register':
                    print "<meta http-equiv='refresh' content='3; url=".Config::config()['WEBSITE_PATH']."login.php'>"; 
                    print "Konto założone prawidłowo, za chwilę zostaniesz przekierowany na stronę główną";
                    break;
                case 'logout':
                    print "<meta http-equiv='refresh' content='3; url=".Config::config()['WEBSITE_PATH']."'>"; 
                    print "Wylogowano poprawnie, za chwilę zostaniesz przekierowany na stronę główną";
                    break;
                case 'login':
                    print "<meta http-equiv='refresh' content='3; url=".Config::config()['WEBSITE_PATH']."'>"; 
                    print "Zalogowano poprawnie, za chwilę zostaniesz przekierowany na stronę główną";
                    break;
                default:
                    print "<meta http-equiv='refresh' content='1; url=".Config::config()['WEBSITE_PATH']."'>";
                    break;
            }
        }
    }