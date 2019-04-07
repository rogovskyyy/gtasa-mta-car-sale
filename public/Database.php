<?php
namespace Application\Database;

    require 'vendor/autoload.php';
    use PDO;
    use Application\Config\Config;
    
    class Database extends Config
    {
        protected $Db;
        protected $host;
        protected $username;
        protected $password;
        protected $table;

        public function __construct()
        {
            
            $this->host = Config::config()['DATABASE_HOST'];
            $this->username = Config::config()['DATABASE_USERNAME'];
            $this->password = Config::config()['DATABASE_PASSWORD'];
            $this->table = Config::config()['DATABASE_TABLE'];

            try
            {
                $this->Db = new PDO("pgsql:host=".$this->host.";port=5432;dbname=".$this->table.";user=".$this->username.";password=".$this->password."");
            }
            catch(PDOException $e)
            {
                print $e->getMessage();

            }
        }
        public function closeConnection()
        {
            $this->Db = null;
        }
    }