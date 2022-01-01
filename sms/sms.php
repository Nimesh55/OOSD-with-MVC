<?php
require_once "vendor/autoload.php";

class Sms_Tracker{

	private $basic;
    private $client ;
    public function __construct()
    {
        $this->basic = new \Vonage\Client\Credentials\Basic("77165db4", "634IoDWe5L5dcswL");
        $this->client = new \Vonage\Client($this->basic);
    }


    function sendmsg($recipient_no, $from, $message)
    {
        $response = $this->client->sms()->send(
            new \Vonage\SMS\Message\SMS("{$recipient_no}", "{$from}", "{$message}"));
        $message = $response->current();
        if ($message->getStatus() == 0) {
            return "The message was sent successfully\n";
        } else {
            return "The message failed with status: " . $message->getStatus() . "\n";
        }
    }
}
 ?>