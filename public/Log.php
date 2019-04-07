<?php
namespace Application\Log;

    require 'vendor/autoload.php';
    use Application\Database\Database;

    class Log extends Database
    {
        public $username;

        public function InsertStatus(string $username, string $status)
        {
            $this->username = $username;
            $this->status = $status;

            $data = [
                'username' => $this->username,
                'ip' => $_SERVER['REMOTE_ADDR'],
                'if_logged' => $this->status,
                'date' => date('d/m/Y H:i:s')
            ];
            $syntax = 'INSERT INTO logs (username, ip, if_logged, date) VALUES (:username, :ip, :if_logged, :date)';
            $sth = $this->Db->prepare($syntax);
            $sth->execute($data);
        }
    }