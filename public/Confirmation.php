<?php
namespace Application\Confirmation;

    require 'vendor/autoload.php';
    use Application\Database\Database;
    
    class Confirmation extends Database
    {
        public function ConfirmMail()
        {
            if(isset($_GET['gid']))
            {
                $this->_GID = $_GET['gid'];
                $data = [
                    'GID' => $this->_GID,
                    'Status' => 'false'
                ];
                $syntax = 'SELECT key, is_confirmed FROM accounts WHERE key = :GID AND is_confirmed = :Status';
                $sth = $this->Db->prepare($syntax);
                $sth->execute($data);
                $result = $sth->fetch();
                if($result > 0)
                {
                    $data = [
                        'Status' => 'true',
                        'GID' => $this->_GID
                    ];
                    $syntax = 'UPDATE accounts SET is_confirmed = :Status WHERE key = :GID';
                    $sth = $this->Db->prepare($syntax);
                    $sth->execute($data);
                    print "Konto zostało zarejestrowane";
                    print "<a href='login.php'>Zaloguj się</a>";
                }
                else
                {
                    print "Niepoprawny kod aktywacyjny";
                }
            }
            else
            {
                print "Niepoprawny kod aktywacyjny";
            }
        }
    }