<?php
namespace Application\Upload;

    require 'vendor/autoload.php';
    use Application\Database\Database;
    
    class Upload extends Database
    {
        private function reArrayFiles(&$file_post) 
        {
            $file_ary = array();
            $file_count = count($file_post['name']);
            $file_keys = array_keys($file_post);
        
            for ($i=0; $i<$file_count; $i++) 
            {
                foreach ($file_keys as $key) 
                {
                    $file_ary[$i][$key] = $file_post[$key][$i];
                }
            }
        
            return $file_ary;
        }
        
        public function UploadImage(array $var)
        {
            if(isset($_POST['submit']))
            {
                $syntax = 'SELECT id FROM notices ORDER BY id DESC LIMIT 1';
                $sth = $this->Db->prepare($syntax);
                $sth->execute();
                $result = $sth->fetch();
                if($result > 0)
                {
                    $lastID = $result['id'];
                }

                $array = $this->reArrayFiles($var);
                $user_directory = wordwrap(hash('md5', "$%!.&@".$_SESSION['Username']), 4, '-', true);
                $target_dir = "static/".$user_directory."/";

                if (!file_exists($target_dir)) 
                {
                    mkdir($target_dir, 0777, true);
                }
                $i = 0;
                foreach($array as $key)
                {
                    $target_file = $target_dir . basename($key['name']);
                    $uploadOk = 1;
                    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                    if(isset($_POST["submit"])) 
                    {
                        $check = getimagesize($key["tmp_name"]);
                        if($check !== false) 
                        {
                            echo "File is an image - " . $check["mime"] . ".";
                            $uploadOk = 1;
                        } 
                        else 
                        {
                            echo "File is not an image.";
                            $uploadOk = 0;
                        }
                    }
                    if (file_exists($target_file)) 
                    {
                        echo "Sorry, file already exists.";
                        $uploadOk = 0;
                    }

                    if ($key["size"] > 5000000) {
                        echo "Sorry, your file is too large.";
                        $uploadOk = 0;
                    }
                    
                    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                                && $imageFileType != "gif" ) 
                    {
                        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                        $uploadOk = 0;
                    }

                    if ($uploadOk == 0) 
                    {
                        echo "Sorry, your file was not uploaded.";
                    }
                    else 
                    {
                        $temp = explode(".", $key["name"]);
                        $newfilename = round(microtime(true) * 1000) . '.' . end($temp);
                        
                        if (move_uploaded_file($key["tmp_name"], $target_dir.$newfilename))
                        {
                            echo "The file ". basename($key["name"]). " has been uploaded.";

                            $data = [
                                'images_id' => (int) ($lastID),
                                'images_href' => $target_dir.$newfilename,
                            ];
                            $syntax = 'INSERT INTO images (images_id, images_href)
                                       VALUES (:images_id, :images_href)';
                            $sth = $this->Db->prepare($syntax);
                            $sth->execute($data);
                        } 
                        else 
                        {
                            echo "Sorry, there was an error uploading your file.";
                        }
                    }
                }
            }
        }    
    }