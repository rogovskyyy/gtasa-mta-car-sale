<?php
namespace Application\Register;

    require 'vendor/autoload.php';
    use Application\Database\Database;
    use Application\Mailer\Mailer;

    class Register extends Database
    {
        protected $username;

        protected $password;

        protected $passwordConf;

        protected $email;

        protected $key;

        public $Db;

        protected function UsernameValid($username)
        {
            $data = [
                'username' => $username
            ];
            $syntax = 'SELECT username FROM accounts WHERE username = :username';
            $sth = $this->Db->prepare($syntax);
            $sth->execute($data);
            $result = $sth->fetch();
            if($result == 0)
            {
               return true;
            }
            else
            {
                print "Taki nick już istnieje!";
            }
        }

        protected function EmailValid($email)
        {
            $data = [
                'email' => $this->email
            ];
            $syntax = 'SELECT email FROM accounts WHERE email = :email';
            $sth = $this->Db->prepare($syntax);
            $sth->execute($data);
            $result = $sth->fetch();
            if($result == 0)
            {
               return true;
            }
            else
            {
                print "Taki email już istnieje!";
            }
        }
        
        public function Register($Username, $Password, $PasswordConfirmation, $Email)
        {
            $this->username = $Username;
    
            $this->password = $Password;
                
            $this->passwordConf = $PasswordConfirmation;
    
            $this->email = $Email;

            if(!empty($this->username) && !empty($this->password) && !empty($this->passwordConf) && !empty($this->email))
            {
                if($this->UsernameValid($this->username) == true && $this->EmailValid($this->email) == true)
                {
                    if($this->password == $this->passwordConf)
                    {
                        $this->key = wordwrap(hash('md5', "$%!.&@".$this->username), 4, '-', true);
                        $data = [
                            'username' => $this->username,
                            'password' => hash('sha256', "$%!.&@".$this->password),
                            'email' => $this->email,
                            'ip' => $_SERVER['REMOTE_ADDR'],
                            'key' => $this->key,
                            'register_date' => date('d/m/Y H:i:s')
                    ];
                    $syntax = 'INSERT INTO accounts (username, password, email, ip, key, register_date)
                               VALUES (:username, :password, :email, :ip, :key, :register_date)';
                    $sth = $this->Db->prepare($syntax);
                    $sth->execute($data);
                    $Mailer = new Mailer();
                    $Mailer->SendVerificationMail($this->email, $this->key, $this->username);
                    print "<script> location.replace('action.php?name=register'); </script>";
                    }
                }
            }
        }
    }