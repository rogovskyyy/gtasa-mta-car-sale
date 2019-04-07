<?php

    class View 
    {
        private $_paths = array();

        private function ListOfArgs()
        {
            return 
                $this->_paths = [
                    'header' => 'views/_header.php',
                    'footer' => 'views/_footer.php',
                    'index' => 'views/_index.php',
                    'login' => 'views/_login.php',
                    'action' => 'views/_action.php',
                    'ad-panel' => 'views/_ad-panel.php',
                    'confirmation' => 'views/_confirmation.php',
                    'logout' => 'views/_logout.php',
                    'register' => 'views/_register.php',
                    'profile' => 'views/_profile.php',
                    'footer' => 'views/_footer.php'
            ];
        }
        public function Route(string $path)
        {
            $this->_path = $path;

            if (array_key_exists($this->_path, $this->ListOfArgs()))
            {
                require $this->_paths[$this->_path];
            }
        }       
    }