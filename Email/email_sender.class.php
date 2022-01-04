<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';



class Email_Sender{
    private $mail;

    public function __construct($username,$password,$port)
    {
        $this->mail = new PHPMailer();
        $this->mail->IsSMTP();
        $this->mail->Mailer = "smtp";
        $this->mail->SMTPDebug  = 1;
        $this->mail->SMTPAuth   = TRUE;
        $this->mail->SMTPSecure = "tls";
        $this->mail->Port       = $port;
        $this->mail->Host       = "smtp.gmail.com";
        $this->mail->Username   = "$username";
        $this->mail->Password   = "$password";
        $this->mail->IsHTML(true);
    }

    public function sendEmail(Email_Handler $email){



        $this->mail->IsHTML(true);
        $this->mail->AddAddress("{$email->getTo()}", "");
        $this->mail->SetFrom("{$this->mail->Username}", "safetransit");
        $this->mail->Subject = "{$email->getSubject()}";
        $content = "{$email->getBody()}";

        $this->mail->MsgHTML($content);
        if(!$this->mail->Send()) {
            echo "Error while sending Email.";
            var_dump($this->mail);
        } else {
            echo "Email sent successfully";
        }
    }


}
;

