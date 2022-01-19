<?php
interface Sms {
    public function setConfig($apiKey, $deviceId);
    public function send_Sms($reciever, $message_body);
}