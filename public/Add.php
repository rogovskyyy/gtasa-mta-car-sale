<?php
namespace Application\Add; 

    require 'vendor/autoload.php';
    use Application\Database\Database;

    class Add extends Database
    {
        public function PrepareNoticeCar()
        {
            $syntax = 'SELECT model FROM vehicles ORDER BY model ASC';
            $sth = $this->Db->prepare($syntax);
            $sth->execute();
            $result = $sth->fetchAll();
            foreach($result as $key)
            {
                print "<option value='".$key['model']."'>".$key['model']."</option>";
            }
        }
        public function PrepareNoticeHeadLights()
        {
            $syntax = 'SELECT headlights FROM headlights ORDER BY headlights ASC';
            $sth = $this->Db->prepare($syntax);
            $sth->execute();
            $result = $sth->fetchAll();
            foreach($result as $key)
            {
                print "<option value='".$key['headlights']."'>".$key['headlights']."</option>";
            }
        }
        public function PrepareNoticeWheels()
        {
            $syntax = 'SELECT wheels FROM wheels ORDER BY wheels ASC';
            $sth = $this->Db->prepare($syntax);
            $sth->execute();
            $result = $sth->fetchAll();
            foreach($result as $key)
            {
                print "<option value='".$key['wheels']."'>".$key['wheels']."</option>";
            }
        }
        public function AddNotice($Model, $Price, $Course, $Headlights, $Wheels, $Mk1, $Mk2, $Mk3, $Rh1, $Taxi)
        {
            $this->mk1 = $_POST['mk1'] == "true" ? "true" : "false";
            $this->mk2 = $_POST['mk2'] == "true" ? "true" : "false";
            $this->mk3 = $_POST['mk3'] == "true" ? "true" : "false";
            $this->rh1 = $_POST['rh1'] == "true" ? "true" : "false";
            $this->taxi = $_POST['taxi'] == "true" ? "true" : "false";
            if(isset($_POST['submit']))
            {
                $data = [
                    'username' => $_SESSION['Username'],
                    'date' => date('d/m/Y H:i:s'),
                    'model' => $Model,
                    'price' => $Price,
                    'course' => $Course,
                    'headlights' => $Headlights,
                    'wheels' => $Wheels,
                    'mk1' => $this->mk1,
                    'mk2' => $this->mk2,
                    'mk3' => $this->mk3,
                    'rh1' => $this->rh1,
                    'taxi' => $this->taxi,
                ];
                $syntax = 'INSERT INTO notices (username, date, model, price, course, headlights, wheels, mk1, mk2, mk3, rh1, taxi) 
                            VALUES (:username, :date, :model, :price, :course, :headlights, :wheels, :mk1, :mk2, :mk3, :rh1, :taxi)';
                $sth = $this->Db->prepare($syntax);
                $sth->execute($data);
            }
        }
    }