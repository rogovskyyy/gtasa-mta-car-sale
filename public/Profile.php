<?php
namespace Application\Profile; 

    require 'vendor/autoload.php';
    use Application\Database\Database;

    class Profile extends Database
    {
        public function ChangePassword($oldPass, $newPass, $confNewPass)
        {
            if(isset($_POST['chg-passwd']))
            {
                if (!empty($oldPass) && !empty($newPass) && !empty($confNewPass))
                {
                    $data = [
                        'username' => $_SESSION['Username']
                    ];
                    $syntax = 'SELECT password FROM accounts WHERE username = :username';
                    $sth = $this->Db->prepare($syntax);
                    $sth->execute($data);
                    $result = $sth->fetch();
                    
                    if($result > 0)
                    {
                        $newPasswordValidate = hash('sha256', "$%!.&@".$newPass);

                        $bool = $result['password'] != $newPasswordValidate ? true : false;

                        if ($bool == true)
                        {
                            if($newPass == $confNewPass)
                            {
                                $data = [
                                    'username' => $_SESSION['Username'],
                                    'password' => hash('sha256', "$%!.&@".$newPass)
                                ];
                                $syntax = 'UPDATE accounts SET password = :password WHERE username = :username';
                                $sth = $this->Db->prepare($syntax);
                                $sth->execute($data);
                            }
                            else
                            {
                                print "Hasła nie są identyczne";
                            }
                        }
                        else
                        {
                            print "Hasła nie mogę być identyczne";
                        }
                    }
                    else
                    {
                        print "Nieprawidłowe hasło!";
                    }
                }
                else
                {
                    print "Wypełnij wymagane pola!";
                }
            }
        }
        public function FetchCars()
        {
            $data = [
                'username' => $_SESSION['Username']
            ];
            $syntax = 'SELECT id, username, model, price, course, headlights, wheels, mk1, mk2, mk3, rh1, taxi FROM notices WHERE username = :username';
            $sth = $this->Db->prepare($syntax);
            $sth->execute($data);
            $result = $sth->fetchAll();
            foreach($result as $values)
            {
                print "<div class='ad'>";
                    $data = [
                        'id' => $values['id'],
                    ];
                    $syntax = 'SELECT images_href FROM images WHERE images_id = :id ORDER BY images_href ASC LIMIT 1';
                    $sth = $this->Db->prepare($syntax);
                    $sth->execute($data);
                    $result = $sth->fetch();
                    print "<img class='ad-img' src='".$result['images_href']."'>
                        <div class='ad-container'>
                            <p class='ad-title'>".$values['model']."</p>
                            <div class='ad-info'>
                                <div class='ad-info-box course'>Przebieg: ".$values['course']."</div>
                                <div class='ad-info-box lights'>Światła: ".$values['headlights']."</div>
                                <div class='ad-info-box wheels'>Felgi: ".$values['wheels']."</div>";
                                if($values['mk1'] == 'true')
                                {
                                    print "<div class='ad-info-box MK1'>MK1</div>";
                                }
                                if($values['mk2'] == 'true')
                                {
                                    print "<div class='ad-info-box MK2'>MK2</div>";
                                }
                                if($values['mk3'] == 'true')
                                {
                                    print "<div class='ad-info-box MK3'>MK3</div>";
                                }
                                if($values['rh1'] == 'true')
                                {
                                    print "<div class='ad-info-box RH1'>RH1</div>";
                                }
                                if($values['taxi'] == 'true')
                                {
                                    print "<div class='ad-info-box Taxi'>Taxi</div>";
                                }
                           print "</div>
                        </div>
                        <div class='ad-container'>
                            <p class='ad-price'>".$values['price']."</p>
                            <p class='ad-buy'>Kontakt</p>
                        </div>
                    </div>";
            }
        }
    }