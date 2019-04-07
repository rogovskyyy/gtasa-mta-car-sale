<?php
namespace Application\Login; 

    require 'vendor/autoload.php';
    use Application\Database\Database;
    use Application\Session\Session;
    use Application\Config\Config;
    use Application\Log\Log;
    

    class Login extends Database
    {

        public function Login($Username, $Password)
        {
            $this->username = $Username;
            $this->password = $Password;
            $this->Session = new Session();
            $this->Log = new Log();

            if(isset($_POST['submit']))
            {
                $data = [
                    'username' => $this->username,
                    'password' => hash('sha256', "$%!.&@".$this->password),
                ];
                $syntax = 'SELECT id, username, password, is_banned, is_confirmed FROM accounts WHERE username = :username AND password = :password';
                $sth = $this->Db->prepare($syntax);
                $sth->execute($data);
                $result = $sth->fetch();
                if($result > 0)
                {
                    if($result['is_confirmed'] == "1")
                    {
                        if ($result['is_banned'] == "0")
                        {
                            $this->Session->SessionStart($this->username, $result['id']);
                            $this->Log->InsertStatus($this->username, 't');
                            header("Location: action.php?name=login");
                        }
                        else
                        {
                            $this->Log->InsertStatus($this->username, 'f');
                            print "Twoje konto jest zablokowane";
                        }
                    }
                    else
                    {
                        $this->Log->InsertStatus($this->username, 'f');
                        print "Twoje konto jest nieaktywne";
                    }
                }
                else 
                {
                    $this->Log->InsertStatus($this->username, 'f');
                    print "Niepoprawny login lub hasło";
                }
            } 
        }
    }