<?php
interface Sms {
    public function send_Sms($reciever, $message_body);
}