<?php
namespace Application\Mailer; 

    require 'vendor/autoload.php';
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    class Mailer
    {
        public function SendVerificationMail($Email, $Key, $Username)
        {
            $this->_Email = $Email;
            $this->_Key = $Key;
            $this->_Username = $Username;
            $mail = new PHPMailer(true);
            try {
                //Server settings
                $mail->SMTPOptions = array(
                    'ssl' => array(
                        'verify_peer' => false,
                        'verify_peer_name' => false,
                        'allow_self_signed' => true
                    )
                );
                $mail->CharSet = 'UTF-8';
                $mail->SMTPDebug = 0;                                 // Enable verbose debug output
                $mail->isSMTP();                                      // Set mailer to use SMTP
                $mail->Host = '';  // Specify main and backup SMTP servers
                $mail->SMTPAuth = true;                               // Enable SMTP authentication
                $mail->Username = '';                 // SMTP username
                $mail->Password = '';                           // SMTP password
                $mail->SMTPSecure = 'tsl';                            // Enable TLS encryption, `ssl` also accepted
                $mail->Port = 25;                                    // TCP port to connect to
            
                $mail->setFrom('noreply@vaside.com.pl', 'Giełda PYLIFE');
                $mail->addAddress($this->_Email);     // Add a recipient
        
                $mail->isHTML(true);                                  // Set email format to HTML
                $mail->Subject = 'Potwierdzenie rejestracji konta';
                $mail->Body    = "Cześć ".$this->_Username."! <br />
                                Dziękujemy za rejestrację konta w serwisie Giełda PYLIFE, aby dokończyć rejestrację - kliknij w link aktywacyjny poniżej <br /><br />
                                ".PATH."confirmation.php?gid=".$this->_Key." <br /><br />
                                Pozdrawiamy <br />
                                Administracja serwisu";
                $mail->AltBody = 'Użyj przeglądarki wpierającej HTML5, aby wyświetlić treść.';
                $mail->send();
            } 
            catch (Exception $e) {
                echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
            }
        }
    }