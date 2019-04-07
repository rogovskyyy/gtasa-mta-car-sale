<?php
namespace Application\Session; 

    require 'vendor/autoload.php';
    use Application\Database\Database;

    class Session extends Database
    {
        public static function SessionCreate()
        {
            return session_start();
        }
        public function SessionStart($Username, $Id)
        {
            $this->SessionCreate();
            $_SESSION['Username'] = $Username;
            $_SESSION['gid'] = $Id;
        }
        public static function IfLogged()
        {
            if(isset($_SESSION['Username']))
            {
                header('Location: action.php?name=logout');
            }
        }
        public static function IfNotLogged()
        {
            if(!isset($_SESSION['Username']))
            {
                header('Location: action.php?name=logout');
            }
        }
        public static function SessionDestroy()
        {
            session_unset();
            session_destroy(); 
        }
    }
