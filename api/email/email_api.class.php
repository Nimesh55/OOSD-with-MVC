<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';



class Email_Api{
    private $mail;
    private static $instance;

    private function __construct($username,$password,$port)
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

    public static function getInstance($username,$password,$port)
    {
        if (self::$instance == null) {
            self::$instance = new Email_Api($username,$password,$port);
        }
        return self::$instance;
    }

    public function sendEmail(Email $email){

        $error = 0;

        $this->mail->IsHTML(true);
        $this->mail->AddAddress("{$email->getTo()}", $email->getRecipientName());
        $this->mail->SetFrom("{$this->mail->Username}",$email->getSenderName());
        $this->mail->Subject = "{$email->getSubject()}";
        $content = nl2br($email->getBody());

        $this->mail->MsgHTML($content);
        if(!$this->mail->Send()) {
            echo "Error while sending Email.";
            $error = -1; // If there is an error -1 is returned
        } else {
            echo "Email sent successfully";
        }
        return $error;
    }
}
;

